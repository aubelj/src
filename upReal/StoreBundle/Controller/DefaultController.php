<?php

namespace upReal\StoreBundle\Controller;

use upReal\StoreBundle\Entity\Store;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
		$stores = $em->getRepository('URStoreBundle:Store')
        	->findAll();
        return $this->render('URStoreBundle:Default:index.html.twig', array('stores' => $stores));
    }

    public function viewAction($id)
    {
        $em = $this->getDoctrine();
        if (empty($store = $em->getRepository('URStoreBundle:Store')->find($id)))
        	throw new NotFoundHttpException('Ce magasin n\'existe pas');

        if (!empty($addr = $store->getAddress()))
        	$mapAddress = $addr->getAddress() . ' ' . $addr->getCity() . ' ' . $addr->getPostalCode() . ' ' . $addr->getCountry();

        $sells = $em->getRepository('URStoreBundle:StoreSell')->findLasts(6, $store->getId());

        return $this->render('URStoreBundle:Default:view.html.twig', array('store' => $store, 'mapAddress' => $mapAddress, 'sells' => $sells));
	}

    public function addAction()
    {
        return $this->render('URStoreBundle:Default:add.html.twig');
    }

    public function findStoresForAction($id)
    {
        if (empty($sells = $this->getDoctrine()->getRepository('URStoreBundle:StoreSell')->findStoresForProduct($id)))
            return new Response('Aucun magasin trouvé');
        $specs = $this->getDoctrine()->getRepository('URProductBundle:Specification')->findFor($id);
        // $listController = $this->get('ur_product.user.lists');
        // $lists = $this->forward('URUserBundle:List:indexAction');
        return $this->render('URProductBundle:Default:view.html.twig', array('product' => $product, 'specs' => $specs, ));
    }
}