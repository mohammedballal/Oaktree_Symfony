<?php

namespace SMARTONE\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\OrderBundle\Entity\OrderAddress;
use SMARTONE\OrderBundle\Form\OrderAddressType;

/**
 * OrderAddress controller.
 *
 * @Route("/orderaddress")
 */
class OrderAddressController extends Controller
{

    /**
     * Lists all OrderAddress entities.
     *
     * @Route("/", name="orderaddress")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEOrderBundle:OrderAddress')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new OrderAddress entity.
     *
     * @Route("/", name="orderaddress_create")
     * @Method("POST")
     * @Template("SMARTONEOrderBundle:OrderAddress:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new OrderAddress();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('orderaddress'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a OrderAddress entity.
     *
     * @param OrderAddress $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OrderAddress $entity)
    {
        $form = $this->createForm(new OrderAddressType(), $entity, array(
            'action' => $this->generateUrl('orderaddress_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new OrderAddress entity.
     *
     * @Route("/new", name="orderaddress_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new OrderAddress();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a OrderAddress entity.
     *
     * @Route("/{id}", name="orderaddress_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:OrderAddress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrderAddress entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing OrderAddress entity.
     *
     * @Route("/{id}/edit", name="orderaddress_edit")
     * @Method("GET")
     * @Template("SMARTONEOrderBundle:OrderAddress:new.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:OrderAddress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrderAddress entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a OrderAddress entity.
    *
    * @param OrderAddress $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OrderAddress $entity)
    {
        $form = $this->createForm(new OrderAddressType(), $entity, array(
            'action' => $this->generateUrl('orderaddress_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing OrderAddress entity.
     *
     * @Route("/{id}", name="orderaddress_update")
     * @Method("PUT")
     * @Template("SMARTONEOrderBundle:OrderAddress:new.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:OrderAddress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrderAddress entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('orderaddress'));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a OrderAddress entity.
     *
     * @Route("/{id}", name="orderaddress_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEOrderBundle:OrderAddress')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OrderAddress entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('orderaddress'));
    }

    /**
     * Creates a form to delete a OrderAddress entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('orderaddress_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
