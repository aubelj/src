<?php

namespace upReal\RateBundle\Controller;

use upReal\RateBundle\Entity\Rate;
use upReal\RateBundle\Entity\RateInfo;
use upReal\UserBundle\Entity\History;
use upReal\ProductBundle\Entity\Product;

use upReal\RateBundle\Form\CommentAdd;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentController extends Controller
{
    public function listAction($idTarget)
    {
        $comments = $this->getDoctrine()->getRepository('URRateBundle:RateInfo')->findCommentsForTarget($idTarget);

        return $this->render('URRateBundle:Default:commentaryModule.html.twig', array('idTarget' => $idTarget, "comments" => $comments));
    }

    public function addCommentWidgetAction(request $request, $idTarget = NULL)
    {
        $history = new History();
        $rate = new Rate();
        $rateInfo = new RateInfo();

        $em = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create(new CommentAdd(), $rate);

        if ($form->handleRequest($request)->isValid())
        {
            $idTarget = $form["idTarget"]->getData();

            $rate->setUser($this->getUser());
            $rate->setDate(new \Datetime());
            $rate->setActive(1);
            $em->persist($rate);
            $em->flush();

            $rateInfo->setType(1);
            $rateInfo->setRate($rate);
            $rateInfo->setIdTarget($idTarget);
            $rateInfo->setIdTargetType(2);
            $em->persist($rateInfo);
            $em->flush();

            $history->setUser($this->getUser());
            $history->setActionType(6);
            $history->setIdType(2);
            $history->setIdTarget($idTarget);
            $history->setDate(new \Datetime());
            $em->persist($history);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                'Commentaire ajouté'
            );
            return $this->redirect($this->generateUrl('ur_product_view', array('id' => $idTarget)));
        }
        return $this->render('URRateBundle:Default:addComment.html.twig', array('form' => $form->createView(), 'idTarget' => $idTarget));
    }

    public function deleteCommentAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $rateinfo = $this->getDoctrine()->getRepository('URRateBundle:RateInfo')->find($id);
        $rate = $rateinfo->getRate();

        $em->remove($rateinfo);
        $em->flush();

        $em->remove($rate);
        $em->flush();

        return new Response("<i>Commentaire supprimé</i>");
    }

    public function editCommentAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $rateinfo = $this->getDoctrine()->getRepository('URRateBundle:RateInfo')->find($id);
        $rate = $rateinfo->getRate();

        $rate->setCommentary($_POST['comment']);
        $rate->setDate(new \Datetime());

        $em->persist($rate);
        $em->flush();

        return new Response("<i>Modifié</i>");
    }
}
