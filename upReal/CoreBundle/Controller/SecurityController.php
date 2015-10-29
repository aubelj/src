<?php 

namespace upReal\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken,
  Symfony\Component\Security\Core\AuthenticationEvents,
  Symfony\Component\Security\Core\Event\AuthenticationEvent;

class SecurityController extends Controller {
  
  protected $oauthDataKey = 'oAuthData';
  
  public function oauthTargetAction() {
    $user = $this->getUser();
    $this->get('session')->getFlashBag()->set($this->oauthDataKey, $user->getData());
    return $this->redirect($this->generateUrl('oauth_register'));
  }
  
  public function oauthRegisterAction() {
    $oAuthData = $this->get('session')->getFlashBag()->get($this->oauthDataKey);

    if (!$oAuthData || !is_array($oAuthData) || !isset($oAuthData['provider']) || !isset($oAuthData['providerId']))
      return $this->redirect($this->generateUrl('hwi_oauth_connect'));

    // Search for userOauth
    $userOauth = $this->getDoctrine()->getRepository('URCoreBundle:UserOauth')->findOneBy(array(
      'provider'=>$oAuthData['provider'],
      'providerId'=>$oAuthData['providerId'],
    ));
    if ($userOauth) {
      // We found it, update user oauth data
      $this->setUserOauthData($userOauth, $oAuthData);
      $this->getDoctrine()->getManager()->flush();

      // Get the user
      $user = $this->getDoctrine()->getRepository('URUserBundle:User')->findOneBy(array(
        'id'=>$userOauth->getUserId()
      ));

      // $this->setUserData($user, $userOauth);
      $this->getDoctrine()->getManager()->flush();

      // Log the user
      $this->logUser($user, $userOauth);

    } else {
      $user = $this->getUser();

      if ($user && is_object($user)) {
        // User is already connected, just create the User and add the UserOauth

        $newUserId = $this->createUser($oAuthData);

        $userOauth = $this->getNewUserOauth($user, $oAuthData, $newUserId);
        $this->getDoctrine()->getManager()->flush();

        // Get the user
        $user = $this->getDoctrine()->getRepository('URUserBundle:User')->findOneBy(array(
          'id' => $userOauth->getUserId()
        ));
        $this->logUser($user, $userOauth);
      } else {
        // Not logged and not existing, redirect to register page
        $this->get('session')->getFlashBag()->set($this->oauthDataKey, $oAuthData);
        return $this->redirect($this->generateUrl('ur_user_inscription'));
      }
    }
    return $this->redirect($this->generateUrl('ur_core_homepage'));
  }
  
  protected function createUser($oAuth)
  {
    $user = new \upReal\UserBundle\Entity\User();
    $addr = new \upReal\CoreBundle\Entity\Address();
    $karma = new \upReal\UserBundle\Entity\Karma();


    // Set default
    $user->setCreateTime(new \Datetime());
    $addr->setLastUpdate(new \Datetime());

    // Doctrine Manager
    $em = $this->getDoctrine()->getManager();

    // Create and flush Address
    $user->setAddress($addr);
    $em->persist($user->getAddress());
    $em->flush();

    // Set User default values
    $user->setId_address($user->getAddress()->getId());
    $user->setActive(1);
    $user->setRoles(array('ROLE_SUPER_ADMIN'));

    // Set User datas
    $user->setUsername($oAuth['nickname']);
    $user->setLastname($oAuth['realname']);
    $user->setEmail($oAuth['email']);

    // Set User's picture
    $this->setUserData($user, $oAuth);

    $em->persist($user);
    $em->flush();

    $newId = $user->getId();

    // Create the associated Karma table
    $karma->setidUser($newId);
    $karma->setValue(0);
    $em->persist($karma);
    $em->flush();

    return $newId;
  }

  protected function setUserData($user, $userOauth) {
    if ($userOauth['provider'] == "facebook")
      $user->setPicture("http://graph.facebook.com/". $userOauth['providerId'] ."/picture");
    else if ($userOauth['provider'] == "google")
      $user->setPicture($userOauth['profilePicture']);
  }

  /**
   * Get a new UserOauth entity with persisting it
   *
   * @param \upReal\CoreBundle\Entity\User $user
   * @param array $oAuthData
   * @return \upReal\CoreBundle\Entity\UserOauth
   */
  protected function getNewUserOauth($user, $oAuthData, $newUserId) {
    $userOauth = new \upReal\CoreBundle\Entity\UserOauth();
    // $userOauth->setUser($user);
    $this->setUserOauthData($userOauth, $oAuthData);
    $userOauth->setUserId($newUserId);
    $this->getDoctrine()->getManager()->persist($userOauth);
    return $userOauth;
  }
  
  protected function setUserOauthData($userOauth, $oAuthData) {
    foreach($oAuthData as $k=>$v) {
      $fct = 'set'.ucfirst($k);
      $userOauth->$fct($v);
    }
  }
  
  public function logUser(\upReal\UserBundle\Entity\User $user, \upReal\CoreBundle\Entity\UserOauth $userOauth) {
    // Here, "main" is the name of the firewall in your security.yml
    $token = new UsernamePasswordToken($user, null, 'oauth', $user->getRoles());
    $this->get('security.context')->setToken($token);

    $this->get('session')->set('oauthDatas', $userOauth);

    // Fire the login event
    $this->get('event_dispatcher')->dispatch(AuthenticationEvents::AUTHENTICATION_SUCCESS, new AuthenticationEvent($token));
  }
  
  public function registerAction() {
    $user = new \upReal\CoreBundle\Entity\User();
    
    $oAuthData = $this->get('session')->getFlashBag()->get($this->oauthDataKey);
    if ($oAuthData && is_array($oAuthData)) {
      if (isset($oAuthData['email']) && $oAuthData['email'])
        $user->setEmail($oAuthData['email']);
      if (isset($oAuthData['nickname']) && $oAuthData['nickname'])
        $user->setUsername($oAuthData['nickname']);
    } else {
      $oAuthData = false;
    }
    
    $form = $this->createFormBuilder($user)
          // Create your form normally
          ->getForm();
    
    $form->handleRequest($this->getRequest());
    if ($form->isValid()) {
      // Handle the user normally, preparing for persistence
      $this->getDoctrine()->getManager()->persist($user);
      
      if ($oAuthData && is_array($oAuthData))
        $userOauth = $this->getNewUserOauth($user, $oAuthData);
        
      $this->getDoctrine()->getManager()->flush();
      // $this->logUser($user);
      return $this->redirect($this->generateUrl('ur_core_homepage'));
    }
    
    // Keep oAuthData in flashbag
    if ($oAuthData)
      $this->get('session')->getFlashBag()->set($this->oauthDataKey, $oAuthData);
    
        return $this->render(
            'URCoreBundle:Security:register.html.php',
            array(
        'form'=>$form->createView()
      )
        );
  }
  
}