<?php

namespace upReal\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction(request $request)
    {
        $searchTerm = $request->query->get('q');

        $identifyRepository = $this->getDoctrine()->getRepository('URSearchBundle:Identify');

        $categories = $identifyRepository->findCategoryDistributionFor($searchTerm);
    	$identifiers = $identifyRepository->findAllWithNameLike($searchTerm);

        $request->getSession()->set('last_search', $searchTerm);

        return $this->render('URSearchBundle:Default:search.html.twig', array('categories' => $categories, 'results' => $identifiers));
    }

    public function categoryAction($idCategory, $category)
    {
    	$identifiers = $this->getDoctrine()
	    ->getRepository('URSearchBundle:Identify')->findAllWithKeyword($idCategory);

        return $this->render('URSearchBundle:Default:search_category.html.twig', array('products' => $identifiers, 'category' => $category));
    }
}
