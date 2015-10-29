<?php

namespace upReal\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
		$users = $em->getRepository('URUserBundle:User')
        	->findAll();
        return $this->render('URAdminBundle:Users:list.html.twig', array('users' => $users));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('URUserBundle:User');
        $addressRepository = $em->getRepository('URCoreBundle:Address');

        $user = $userRepository->findById($id)[0];
		$addr = $addressRepository->findById($user->getId_address())[0];

        $em->remove($user);
        $em->remove($addr);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'Utilisateur supprimée'
        );
        return $this->redirect($this->generateUrl('ur_admin_homepage'));
    }

    public function switchActiveAction($id, $newStatus)
    {
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('URUserBundle:User');

        $user = $userRepository->findById($id)[0];

        $user->setActive($newStatus);
        $em->persist($user);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'Utilisateur mis à jour'
        );
        return $this->redirect($this->generateUrl('ur_admin_homepage'));
    }
}
