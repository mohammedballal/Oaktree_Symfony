<?php

namespace SMARTONE\SaleBundle\Controller;

use SMARTONE\SaleBundle\Entity\SaleQuestion;
use SMARTONE\SaleBundle\Form\AnswerQuestionType;
use SMARTONE\SaleBundle\Form\SaleProdStageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\SaleBundle\Entity\Sale;
use SMARTONE\SaleBundle\Form\SaleType;

/**
 * Sale controller.
 *
 * @Route("/answer/question")
 */
class AnswerQuestionController extends Controller
{


    /**
     * Displays a form to edit an existing Sale entity.
     *
     * @Route("/{id}/edit", name="answer_question")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:SaleQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $form = $this->createEditForm($entity);

        return $this->render('SMARTONESaleBundle:Sale:modal.html.twig', array(
            'title' => 'Answer Question',
            'entity'      => $entity,
            'form'        => $form->createView(),
        ));
    }

    /**
    * Creates a form to edit a Sale entity.
    *
    * @param Sale $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SaleQuestion $entity)
    {
        $form = $this->createForm(new AnswerQuestionType(), $entity, array(
            'action' => $this->generateUrl('answer_question_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Sale entity.
     *
     * @Route("/{id}", name="answer_question_update")
     * @Method("PUT")
     * @Template("SMARTONESaleBundle:Sale:modal.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:SaleQuestion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $form = $this->createEditForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
           $entity->setComplete(true);
            $em->flush();

            return $this->redirect($this->generateUrl('sale'));
        }

        $this->addFlash('danger','Answer can\'t be blank');

        return $this->redirect($this->generateUrl('sale'));
    }
}
