<?php

namespace upReal\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use upReal\UserBundle\Entity\History;
use upReal\ProductBundle\Entity\Product;
use upReal\ProductBundle\Form\ProductAdd;

use upReal\UserBundle\Controller\ListsController;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$repository = $this->getDoctrine()
	    ->getRepository('URProductBundle:Product');

        return $this->render('URProductBundle:Default:index.html.twig', array(
        	'products' => $repository->findAll()
        ));
    }

    public function categoryAction()
    {
        $categories = $this->getDoctrine()
        ->getRepository('URSearchBundle:Keyword')->findAll();

        return $this->render('URProductBundle:Default:categories.html.twig', array('categories' => $categories));
    }

    public function addAction(request $request)
    {
        $product = new Product();

        $form = $this->get('form.factory')->create(new ProductAdd(), $product);

        if ($form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $product->setUploadDate(new \Datetime());
            $em->persist($product);
            $em->flush();
            $product->uploadPicture($product->getId());
            $em->persist($product);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                'Le produit a été ajouté.'
            );
			return $this->redirect($this->generateUrl('ur_core_homepage'));
        }

        return $this->render('URProductBundle:Default:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function viewAction($id)
    {
        $history = new History();

        if (empty($product = $this->getDoctrine()->getRepository('URProductBundle:Product')->find($id)))
            throw new NotFoundHttpException('Cet article n\'existe pas');

        // Specifications :
        $specs = $this->getDoctrine()->getRepository('URProductBundle:Specification')->findFor($id);

        // Magasins : 
        $sells = $this->getDoctrine()->getRepository('URStoreBundle:StoreSell')->findStoresForProduct($id);

        // Rates :
        if ($user = $this->getUser())
        {
            $like = $this->getDoctrine()->getRepository('URRateBundle:RateInfo')->findLikeForUserTarget($user->getId(), $id);
            $dislike = $this->getDoctrine()->getRepository('URRateBundle:RateInfo')->findDislikeForUserTarget($user->getId(), $id);

            $history->setUser($user);
            $history->setActionType(1);
            $history->setIdType(2);
            $history->setIdTarget($id);
            $history->setDate(new \Datetime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($history);
            $em->flush();
        }
        return $this->render('URProductBundle:Default:view.html.twig', array(
            'product' => $product,
            'specs' => $specs,
            'sells' => $sells,
            'like' => !empty($like),
            'dislike' => !empty($dislike)
        ));
    }
}
