<?php

namespace upReal\CoreBundle\Controller;

use upReal\ProductBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$productRepository = $this->getDoctrine()
		    ->getRepository('URProductBundle:Product');

		$lastProducts = $productRepository->findLasts(6);
        return $this->render('URCoreBundle:Default:index.html.twig', array('lastProducts' => $lastProducts));
    }

    public function contactAction()
    {
        return $this->render('URCoreBundle:Default:contact.html.twig');
    }
}
