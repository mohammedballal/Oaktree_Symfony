<?php

namespace SMARTONE\SaleBundle\Controller;

use SMARTONE\SaleBundle\Form\DeliveryDayStageType;
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
 * @Route("/delivery/day")
 */
class DeliveryDayController extends Controller
{

    /**
     * Displays a form to edit an existing Sale entity.
     *
     * @Route("/{id}/edit", name="delivery_day")
     * @Method("GET")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:Sale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $form = $this->createEditForm($entity);

        return $this->render('SMARTONESaleBundle:Sale:modal.html.twig', array(
            'title' => 'Delivery Day',
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
    private function createEditForm(Sale $entity)
    {
        $form = $this->createForm(new DeliveryDayStageType(), $entity, array(
            'action' => $this->generateUrl('delivery_day_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Sale entity.
     *
     * @Route("/{id}", name="delivery_day_update")
     * @Method("PUT")
     * @Template("SMARTONESaleBundle:Sale:modal.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:Sale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $form = $this->createEditForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->setDeliveryDay(true);
            $em->flush();

            return $this->redirect($this->generateUrl('sale'));
        }

        return array(
            'title' => 'Delivery Day',
            'entity'      => $entity,
            'form'        => $form->createView(),
        );
    }
}
