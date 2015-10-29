<?php

namespace upReal\CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('URCompanyBundle:Default:index.html.twig', array('name' => $name));
    }
}
