<?php

namespace SMARTONE\SaleBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use SMARTONE\SaleBundle\Entity\SaleQuestion;
use SMARTONE\SaleBundle\Form\QuestionAddType;
use SMARTONE\SaleBundle\Form\SaleInStageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\SaleBundle\Entity\Sale;

/**
 * Sale controller.
 *
 * @Route("/sale/question")
 */
class SaleQuestionController extends Controller
{


    /**
     * Displays a form to edit an existing Sale entity.
     *
     * @Route("/{id}/add/{type}", name="sale_question_add")
     * @Method("GET")
     */
    public function addAction($id,$type)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SMARTONESaleBundle:Sale')->find($id);

        $sq = new SaleQuestion();

        $sq->setSale($entity);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $form = $this->createEditForm($sq, $type);

        return $this->render('SMARTONESaleBundle:Sale:modal.html.twig', array(
            'title' => 'Add Question',
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }

    /**
    * Creates a form to edit a Sale entity.
    *
    * @param SaleQuestion $entity The entity
    * @param $type
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SaleQuestion $entity, $type)
    {
        $form = $this->createForm(new QuestionAddType(), $entity, array(
            'action' => $this->generateUrl('sale_question_create', array('id' => $entity->getSale()->getId(), 'type' => $type)),
            'method' => 'POST',
            'q_type' => $type
        ));

        return $form;
    }

    /**
     * @Route("/{id}/create/{type}", name="sale_question_create")
     * @Method("POST")
     * @Template("SMARTONESaleBundle:Sale:modal.html.twig")
     * @param Request $request
     * @param $id
     * @param $type
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request, $id, $type)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:Sale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $sq = new SaleQuestion();
        $sq->setSale($entity);
        $form = $this->createEditForm($sq, $type);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $sq->setSale($entity);
            $em->persist($sq);
            $em->flush();

            return $this->redirect($this->generateUrl('sale'));
        }

//        var_dump($form->getErrors());
//
//        return array(
//            'title' => '',
//            'form' => $form->createView()
//        );
        $this->addFlash('danger', 'Sale to be comepleted by date required');

        return $this->redirectToRoute('sale');
    }

    /**
     * Edits an existing Sale entity.
     *
     * @Route("/{id}", name="sale_question_delete")
     * @Method("GET")
     * @Template("SMARTONESaleBundle:Sale:modal.html.twig")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:SaleQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('sale'));



    }
}
