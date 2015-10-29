<?php

namespace upReal\RateBundle\Controller;

use upReal\RateBundle\Entity\Rate;
use upReal\RateBundle\Entity\RateInfo;
use upReal\UserBundle\Entity\History;
use upReal\UserBundle\Entity\Items;
use upReal\ProductBundle\Entity\Product;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('URRateBundle:Default:index.html.twig', array('name' => $name));
    }

    public function unlikeAction($id)
    {
        $history = new History();

    	if ($user = $this->getUser())
        {
            $em = $this->getDoctrine()->getManager();

            $like = $this->getDoctrine()->getRepository('URRateBundle:RateInfo')->findLikeForUserTarget($user->getId(), $id)[0];
            if (!empty($like))
            {
                $em->remove($like->getRate());
		        $em->flush();

                $em->remove($like);
		        $em->flush();

	            $history->setUser($user);
	            $history->setActionType(4);
	            $history->setIdType(2);
	            $history->setIdTarget($id);
	            $history->setDate(new \Datetime());
	            $em->persist($history);
	            $em->flush();

		        $listRepository = $em->getRepository('URUserBundle:Lists');
		        $list = $listRepository->findOneBy(array('type' => 3, 'idUser' => $user->getId()));
		        $list->setNbItems($list->getNbItems() - 1);
		        $em->persist($list);
		        $em->flush();

		        $item = $em->getRepository('URUserBundle:Items')->findOneBy(array('idList' => $list->getId(), 'idProduct' => $id));
                $em->remove($item);
		        $em->flush();
            }

            return new Response("<div class='alert alert-success alert-dismissible' style='text-align:center;' role='alert'>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            	<span aria-hidden='true'>&times;</span>
            	</button>
            	Vote annulé.
            	</div>");
        }
        else
            return new Response("<div class='alert alert-warning alert-dismissible' style='text-align:center;' role='alert'>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            	<span aria-hidden='true'>&times;</span>
            	</button>
            	Vous devez être connecté pour noter un produit.
            	</div>");

        return new Response("<div class='alert alert-error alert-dismissible' style='text-align:center;' role='alert'>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            	<span aria-hidden='true'>&times;</span>
            	</button>
            	Erreur de connexion avec le serveur.
            	</div>");
    }

    public function likeAction($id)
    {
    	$rate = new Rate();
    	$rateInfo = new RateInfo();
        $history = new History();
		$item = new Items();

    	if ($user = $this->getUser())
        {
            $em = $this->getDoctrine()->getManager();

        	$rate->setUser($user);
        	$rate->setDate(new \Datetime());
        	$rate->setActive(1);
            $em->persist($rate);
            $em->flush();

            // Add Action Like
        	$rateInfo->setType(2);
        	$rateInfo->setRate($rate);
        	$rateInfo->setIdTarget($id);
        	$rateInfo->setIdTargetType(2);
            $em->persist($rateInfo);
            $em->flush();

            // Set Historique
            $history->setUser($user);
            $history->setActionType(2);
            $history->setIdType(2);
            $history->setIdTarget($id);
            $history->setDate(new \Datetime());
            $em->persist($history);
            $em->flush();

	        $productRepository = $em->getRepository('URProductBundle:Product');
	        $product = $productRepository->findById($id)[0];

            // Ajout liste Like
	        $listRepository = $em->getRepository('URUserBundle:Lists');
	        $list = $listRepository->findByTypeUser(3, $user->getId())[0];

	        $item->setProduct($product);
	        $item->setList($list);
	        $em->persist($item);
	        $em->flush();

	        $list->setNbItems($list->getNbItems() + 1);
	        $em->persist($list);
	        $em->flush();

            return new Response("<div class='alert alert-success alert-dismissible' style='text-align:center;' role='alert'>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            	<span aria-hidden='true'>&times;</span>
            	</button>
            	Vote enregistré.
            	</div>");
        }
        else
            return new Response("<div class='alert alert-warning alert-dismissible' style='text-align:center;' role='alert'>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            	<span aria-hidden='true'>&times;</span>
            	</button>
            	Vous devez être connecté pour noter un produit.
            	</div>");

        return new Response("<div class='alert alert-error alert-dismissible' style='text-align:center;' role='alert'>
            	<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            	<span aria-hidden='true'>&times;</span>
            	</button>
            	Erreur de connexion avec le serveur.
            	</div>");
    }

    public function undislikeAction($id)
    {
        // $history = new History();

        if ($user = $this->getUser())
        {
            $em = $this->getDoctrine()->getManager();

            $dislike = $this->getDoctrine()->getRepository('URRateBundle:RateInfo')->findDisLikeForUserTarget($user->getId(), $id)[0];
            if (!empty($dislike))
            {
                $em->remove($dislike->getRate());
                $em->flush();

                $em->remove($dislike);
                $em->flush();

                // $history->setUser($user);
                // $history->setActionType(4);
                // $history->setIdType(2);
                // $history->setIdTarget($id);
                // $history->setDate(new \Datetime());
                // $em->persist($history);
                // $em->flush();

                $listRepository = $em->getRepository('URUserBundle:Lists');
                $list = $listRepository->findOneBy(array('type' => 4, 'idUser' => $user->getId()));
                $list->setNbItems($list->getNbItems() - 1);
                $em->persist($list);
                $em->flush();

                $item = $em->getRepository('URUserBundle:Items')->findOneBy(array('idList' => $list->getId(), 'idProduct' => $id));
                $em->remove($item);
                $em->flush();
            }

            return new Response("<div class='alert alert-success alert-dismissible' style='text-align:center;' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                Vote annulé.
                </div>");
        }
        else
            return new Response("<div class='alert alert-warning alert-dismissible' style='text-align:center;' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                Vous devez être connecté pour noter un produit.
                </div>");

        return new Response("<div class='alert alert-error alert-dismissible' style='text-align:center;' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                Erreur de connexion avec le serveur.
                </div>");
    }

    public function dislikeAction($id)
    {
        $rate = new Rate();
        $rateInfo = new RateInfo();
        $history = new History();
        $item = new Items();

        if ($user = $this->getUser())
        {
            $em = $this->getDoctrine()->getManager();

            $rate->setUser($user);
            $rate->setDate(new \Datetime());
            $rate->setActive(1);
            $em->persist($rate);
            $em->flush();

            // Add Action Dislike
            $rateInfo->setType(3);
            $rateInfo->setRate($rate);
            $rateInfo->setIdTarget($id);
            $rateInfo->setIdTargetType(2);
            $em->persist($rateInfo);
            $em->flush();

            // Set Historique
            $history->setUser($user);
            $history->setActionType(3);
            $history->setIdType(2);
            $history->setIdTarget($id);
            $history->setDate(new \Datetime());
            $em->persist($history);
            $em->flush();

            $productRepository = $em->getRepository('URProductBundle:Product');
            $product = $productRepository->findById($id)[0];

            // Ajout liste Dislike
            $listRepository = $em->getRepository('URUserBundle:Lists');
            $list = $listRepository->findByTypeUser(4, $user->getId())[0];

            $item->setProduct($product);
            $item->setList($list);
            $em->persist($item);
            $em->flush();

            $list->setNbItems($list->getNbItems() + 1);
            $em->persist($list);
            $em->flush();

            return new Response("<div class='alert alert-success alert-dismissible' style='text-align:center;' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                Vote enregistré.
                </div>");
        }
        else
            return new Response("<div class='alert alert-warning alert-dismissible' style='text-align:center;' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                Vous devez être connecté pour noter un produit.
                </div>");

        return new Response("<div class='alert alert-error alert-dismissible' style='text-align:center;' role='alert'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                Erreur de connexion avec le serveur.
                </div>");
    }
}
