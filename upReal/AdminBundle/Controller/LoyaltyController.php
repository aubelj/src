<?php

namespace upReal\AdminBundle\Controller;

use upReal\UserBundle\Entity\Loyalty;
use upReal\AdminBundle\Form\LoyaltyAdd;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoyaltyController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
		$loyalty = $em->getRepository('URUserBundle:Loyalty')
        	->findAll();
        return $this->render('URAdminBundle:Loyalty:list.html.twig', array('loyalty' => $loyalty));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $loyaltyRepository = $em->getRepository('URUserBundle:Loyalty');

        $loyaltyCard = $loyaltyRepository->findById($id)[0];

        $em->remove($loyaltyCard);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'Carte de fidélité supprimée'
        );
        return $this->redirect($this->generateUrl('ur_admin_loyalty_list'));
    }

    public function addAction(Request $request)
    {
        $loyaltyCard = new Loyalty();

        $form = $this->get('form.factory')->create(new LoyaltyAdd(), $loyaltyCard)->add('company', 'integer');

        $em = $this->getDoctrine()->getManager();

        if ($form->handleRequest($request)->isValid())
        {
            $loyaltyCard->setCompany($companies = $em->getRepository('URCompanyBundle:Company')
                ->find($loyaltyCard->getCompany()));

            $loyaltyCard->upload();
            $em->persist($loyaltyCard);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'notice',
                'Carte de fidélité ajoutée'
            );
            return $this->redirect($this->generateUrl('ur_admin_loyalty_list'));
        }

        $companies = $em->getRepository('URCompanyBundle:Company')
            ->findAll();

        return $this->render('URAdminBundle:Loyalty:add.html.twig', array(
            'form' => $form->createView(),
            'companies' => $companies
        ));
    }
}
