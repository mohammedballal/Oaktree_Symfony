<?php

namespace SMARTONE\OrderBundle\Controller;

use SMARTONE\OrderBundle\Form\SaleOrderCancelType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\OrderBundle\Entity\SaleOrder;

/**
 * Order controller.
 *
 * @Route("/order/cancel")
 */
class CancelOrderController extends Controller
{

    /**
     * Displays a form to edit an existing Order entity.
     *
     * @Route("/{id}/edit", name="cancel_order_edit")
     * @Method("GET")
     * @Template("SMARTONEOrderBundle:Order:new.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:SaleOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }

        $editForm = $this->createEditForm($entity);
        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Order entity.
    *
    * @param Order $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SaleOrder $entity)
    {
        $form = $this->createForm(new SaleOrderCancelType(), $entity, array(
            'action' => $this->generateUrl('cancel_order_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Cancel Order', 'attr' => array(
            'class' => 'btn-danger'
        )));

        return $form;
    }

    /**
     * Edits an existing Order entity.
     *
     * @Route("/{id}", name="cancel_order_update")
     * @Method("PUT")
     * @Template("SMARTONEOrderBundle:Order:new.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:SaleOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->setOrderStatus(SaleOrder::Order_Cancelled);
            $entity->setDocOrder(null);
            $em->flush();

            return $this->redirect($this->generateUrl('order'));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
    }
}
