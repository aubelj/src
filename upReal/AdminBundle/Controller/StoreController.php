<?php

namespace upReal\AdminBundle\Controller;

use upReal\StoreBundle\Entity\Store;
use upReal\CoreBundle\Entity\Address;

use upReal\StoreBundle\Form\StoreAdd;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StoreController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
		$stores = $em->getRepository('URStoreBundle:Store')
        	->findAll();
        return $this->render('URAdminBundle:Stores:list.html.twig', array('stores' => $stores));
    }

    public function addAction(Request $request)
    {
        $store = new Store();
        $addr = new Address();

        $form = $this->get('form.factory')->create(new StoreAdd(), $store);

        if ($form->handleRequest($request)->isValid())
        {
            $addr->setLastUpdate(new \Datetime());

            $em = $this->getDoctrine()->getManager();

            $em->persist($store->getAddress());
            $em->flush();
            $store->setIdAddress($store->getAddress()->getId());

            $em->persist($store->getCompany());
            $em->flush();

            $em->persist($store);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'notice',
                'Magasin ajouté'
            );
            return $this->redirect($this->generateUrl('ur_admin_store_list'));
        }
        return $this->render('URAdminBundle:Stores:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $storeRepository = $em->getRepository('URStoreBundle:Store');

        $store = $storeRepository->findById($id)[0];

        $em->remove($store);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'Magasin supprimé'
        );
        return $this->redirect($this->generateUrl('ur_admin_store_list'));
    }
}
