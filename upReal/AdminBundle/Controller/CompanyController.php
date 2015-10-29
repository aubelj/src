<?php

namespace upReal\AdminBundle\Controller;

use upReal\CompanyBundle\Entity\Company;

use upReal\CompanyBundle\Form\Type\CompanyType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompanyController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
		$companies = $em->getRepository('URCompanyBundle:Company')
        	->findAll();
        return $this->render('URAdminBundle:Companies:list.html.twig', array('companies' => $companies));
    }

    public function addAction(Request $request)
    {
        $company = new Company();
        $form = $this->get('form.factory')->create(new CompanyType(), $company);

        if ($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->getRepository('URCompanyBundle:Company')
                ->addCompany($company);

            $this->get('session')->getFlashBag()->add(
                'notice',
                'Société ajoutée'
            );
            return $this->redirect($this->generateUrl('ur_admin_company_list'));
        }
        return $this->render('URAdminBundle:Companies:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $companyRepository = $em->getRepository('URCompanyBundle:Company');

        $company = $companyRepository->findById($id)[0];

        $em->remove($company);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'Société supprimée'
        );
        return $this->redirect($this->generateUrl('ur_admin_company_list'));
    }
}
