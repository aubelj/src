<?php

namespace upReal\UserBundle\Controller;

use upReal\UserBundle\Entity\User;
use upReal\UserBundle\Form\Type\UserType;
use upReal\UserBundle\Entity\Karma;
use upReal\UserBundle\Entity\History;
use upReal\UserBundle\Entity\Lists;

use upReal\CoreBundle\Entity\Address;
use upReal\CoreBundle\Form\Type\AddressType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManageController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('URUserBundle:Default:index.html.twig', array('name' => $name));
    }

    public function loginAction(Request $request)
    {
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
          return $this->redirect($this->generateUrl('ur_core_homepage'));
        }

        $session = $request->getSession();

        // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
          $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
          $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
          $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('URUserBundle:Default:login.html.twig', array(
          // Valeur du précédent nom d'utilisateur entré par l'internaute
          'last_username' => $session->get(SecurityContext::LAST_USERNAME),
          'error'         => $error
        ));
    }

    public function user_newAction(Request $request)
    {
        $user = new User();
        $addr = new Address();
        $karma = new Karma();

        $user->setCreateTime(new \Datetime());
        $addr->setLastUpdate(new \Datetime());

        $user->setAddress($addr);
        $form = $this->get('form.factory')->create(new UserType(), $user);

        if ($form->handleRequest($request)->isValid())
        {
            // $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user->getAddress());
            $em->flush();
            
            $user->setId_address($user->getAddress()->getId());
            $user->setActive(1);
            $toks = explode("@", $user->getEmail());
            
            $user->setUsername($toks[0]);
            $user->setRoles(array('ROLE_USER'));
            $em->persist($user);
            $em->flush();
            
            $karma->setidUser($user->getId());
            $karma->setValue(0);            
            $em->persist($karma);
            $em->flush();

            // Initialisation des listes
            $this->initLists($em, $user);

            $this->get('session')->getFlashBag()->add(
                'success',
                'Inscription effectuée.'
            );

            return $this->redirect($this->generateUrl('ur_user_login'));
        }

        return $this->render('URUserBundle:Default:inscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function initLists($em, $user)
    {
        $list = new Lists();

        $list->setName('Follower');
        $list->setPublic(2);
        $list->setType(1);
        $list->setNbItems(0);
        $list->setUser($user);
        $list->setDate(new \Datetime());
        $em->persist($list);
        $em->flush();

        $list = new Lists();

        $list->setName('Following');
        $list->setPublic(2);
        $list->setType(2);
        $list->setNbItems(0);
        $list->setUser($user);
        $list->setDate(new \Datetime());
        $em->persist($list);
        $em->flush();

        $list = new Lists();

        $list->setName('Like Product');
        $list->setPublic(2);
        $list->setType(3);
        $list->setNbItems(0);
        $list->setUser($user);
        $list->setDate(new \Datetime());
        $em->persist($list);
        $em->flush();

        $list = new Lists();

        $list->setName('Dislike Product');
        $list->setPublic(2);
        $list->setType(4);
        $list->setNbItems(0);
        $list->setUser($user);
        $list->setDate(new \Datetime());
        $em->persist($list);
        $em->flush();

        $list = new Lists();

        $list->setName('Like User');
        $list->setPublic(2);
        $list->setType(5);
        $list->setNbItems(0);
        $list->setUser($user);
        $list->setDate(new \Datetime());
        $em->persist($list);
        $em->flush();

        $list = new Lists();

        $list->setName('Dislike User');
        $list->setPublic(2);
        $list->setType(6);
        $list->setNbItems(0);
        $list->setUser($user);
        $list->setDate(new \Datetime());
        $em->persist($list);
        $em->flush();
    }

    public function user_editAction(Request $request)
    {
        $history = new History();

        if ($user = $this->getUser())
        {
            $user->setAddress($this->getDoctrine()
                ->getRepository('URCoreBundle:Address')
                ->find($user->getId_address()));
            $form = $this->get('form.factory')->create(new UserType(), $user);
 
            if ($form->handleRequest($request)->isValid())
            {
                // $user = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($user->getAddress());
                $em->flush();
                $em->persist($user);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    'Profil mis à jour.'
                );

                $history->setUser($user);
                $history->setActionType(7);
                $history->setDate(new \Datetime());
                $em->persist($history);
                $em->flush();

                return $this->redirect($this->generateUrl('ur_user_me'));
            }
        }
        else
            throw new AccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        return $this->render('URUserBundle:Default:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function user_historyAction()
    {
        if ($user = $this->getUser())
        {
            $events = $this->getDoctrine()->getRepository('URUserBundle:History')->findAllFor($user->getId());
        }
        else
            throw new AccessDeniedException('Vous devez être connecté pour accéder à cette page.');

        return $this->render('URUserBundle:Default:history.html.twig', array(
            'events' => $events
        ));
    }

    public function check_inscription(Request $request)
    {
        $new = new Product();

        return $this->render('URUserBundle:Manage:index.html.twig');
    }

    public function user_deleteAction(Request $request)
    {
        return $this->render('URUserBundle:Default:new.html.twig', array(
            'form' => $form
        ));
    }

    public function user_viewAction($id)
    {
        if ($user = $this->getUser())
        {
            // Récupération de l'utilisateur
            if (empty($profile = $this->getDoctrine()
                ->getRepository('URUserBundle:User')
                ->find($id)))
                throw new NotFoundHttpException('Cet utilisateur n\'existe pas.');

            // Récupération de l'adresse
            $profile->setAddress($this->getDoctrine()
                ->getRepository('URCoreBundle:Address')
                ->find($profile->getId_address()));

            // Récupération du karma
            $karma = $this->getDoctrine()
                ->getRepository('URUserBundle:Karma')
                ->findAllByIdUser($profile->getId())[0];

            // Récupération des achievements
            $achiev = $this->getDoctrine()
                ->getRepository('URUserBundle:Gain')
                ->findAllByIdUser($profile->getId());
          
        }
        else
            throw new AccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        return $this->render('URUserBundle:Default:view.html.twig', array(
            'profile' => $profile,
            'karma' => $karma,
            'achiev' => $achiev
        ));
    }

    public function user_meAction()
    {
        if ($user = $this->getUser())
        {
            // Récupération de l'utilisateur
            $profile = $user;

            // Récupération de l'adresse
            $profile->setAddress($this->getDoctrine()
                ->getRepository('URCoreBundle:Address')
                ->find($profile->getId_address()));

            // Récupération du karma
            $karma = $this->getDoctrine()
                ->getRepository('URUserBundle:Karma')
                ->findAllByIdUser($profile->getId())[0];

            // Récupération des achievements
            $achiev = $this->getDoctrine()
                ->getRepository('URUserBundle:Gain')
                ->findAllByIdUser($profile->getId());
        }
        else
            throw new AccessDeniedException('Vous devez être connecté pour accéder à cette page.');
        return $this->render('URUserBundle:Default:profile.html.twig', array(
            'profile' => $profile,
            'karma' => $karma,
            'achiev' => $achiev
            ));
    }
}
