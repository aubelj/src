<?php

namespace upReal\UserBundle\Controller;

use upReal\UserBundle\Entity\Loyalty;
use upReal\UserBundle\Entity\Possess;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoyaltyController extends Controller
{
    public function indexAction()
    {
        if ($user = $this->getUser())
        {
		   	$em = $this->getDoctrine()->getManager();
			$loyalty = $em->getRepository('URUserBundle:Possess')
	        	->findMine($this->getUser()->getId());

		}
		else
			throw new AccessDeniedException('Vous devez être connecté pour accéder à cette page.');

        return $this->render('URUserBundle:Loyalty:index.html.twig', array('loyalty' => $loyalty));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $listRepository = $em->getRepository('URUserBundle:Loyalty');

        $list = $listRepository->findById($id)[0];

        $em->remove($list);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'Liste supprimée'
        );
        return $this->redirect($this->generateUrl('ur_user_Loyalty'));
    }

    public function AddListWidgetAction()
	{
		// $template = '<ul>';

		// $json = json_encode($template);
  //  		$response = new Response($json, 200);
  //  		$response->headers->set('Content-Type', 'application/json');
        $list = new Loyalty();

        $form = $this->get('form.factory')->create(new ListNew(), $list, array(
		    'action' => $this->generateUrl('ur_user_list_push_tmp'),
		    'method' => 'POST'
	    ));
		return $this->render('URUserBundle:Loyalty:newListForm.html.twig', array(
            'form' => $form->createView())
		);
		// return $response;
	}

    public function retrieveLoyaltyAction($idProduct = null)
	{
		$em = $this->getDoctrine()->getManager();
		$Loyalty = $em->getRepository('URUserBundle:Loyalty')->findMineMin($this->getUser()->getId());

        return $this->render('URUserBundle:Loyalty:LoyaltyList.html.twig', array('Loyalty' => $Loyalty, 'idProduct' => $idProduct));;
	}


   	public function pushNewListAction(request $request)
	{
		$list = new Loyalty();

		$form = $this->get('form.factory')->create(new ListNew(), $list);
		if ($form->handleRequest($request)->isValid())
        {
        	$list->setUser($this->getUser());
        	$list->setNbItems(0);
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($list);
	        $em->flush();

			return $this->redirect($this->generateUrl('ur_user_Loyalty'));
		}
		return $this->redirect($this->generateUrl('ur_user_Loyalty'));
	}

   	public function pushProductInListAction($idProduct, $idList)
	{
		$item = new Items();

		$em = $this->getDoctrine()->getManager();
        $productRepository = $em->getRepository('URProductBundle:Product');
        $listRepository = $em->getRepository('URUserBundle:Loyalty');

        $product = $productRepository->findById($idProduct)[0];
        $list = $listRepository->findById($idList)[0];

        $item->setProduct($product);
        $item->setList($list);
        $em->persist($item);
        $em->flush();
        if (($nbItem = $list->getNbItems()) == 0)
            $list->setType(1);
        $list->setNbItems($nbItem + 1);
        $em->persist($list);
        $em->flush();

		return new Response('Produit ajouté');
	}

	public function removeItemAction($idItem)
	{
        $em = $this->getDoctrine()->getManager();
        $itemRepository = $em->getRepository('URUserBundle:Items');
        $listRepository = $em->getRepository('URUserBundle:Loyalty');

        $item = $itemRepository->findById($idItem)[0];
        $list = $listRepository->findById($item->getIdList())[0];

        $em->remove($item);
        $em->flush();

        $list->setNbItems($list->getNbItems() - 1);
        $em->persist($list);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add(
            'notice',
            'Element supprimé de la liste'
        );
		return $this->redirect($this->generateUrl('ur_user_Loyalty'));
	}
}
