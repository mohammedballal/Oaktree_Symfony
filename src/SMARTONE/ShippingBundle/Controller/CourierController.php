<?php

namespace SMARTONE\ShippingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ShippingBundle\Entity\Courier;
use SMARTONE\ShippingBundle\Form\CourierType;

/**
 * Courier controller.
 *
 * @Route("/couriers")
 */
class CourierController extends Controller
{

    /**
     * Lists all Courier entities.
     *
     * @Route("/", name="courier")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEShippingBundle:Courier')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Courier entity.
     *
     * @Route("/", name="courier_create")
     * @Method("POST")
     * @Template("SMARTONEShippingBundle:Courier:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Courier();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('courier'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Courier entity.
     *
     * @param Courier $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Courier $entity)
    {
        $form = $this->createForm(new CourierType(), $entity, array(
            'action' => $this->generateUrl('courier_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create', 'attr' => array('class' => 'btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Courier entity.
     *
     * @Route("/new", name="courier_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Courier();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Courier entity.
     *
     * @Route("/{id}", name="courier_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEShippingBundle:Courier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Courier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Courier entity.
     *
     * @Route("/{id}/edit", name="courier_edit")
     * @Method("GET")
     * @Template("SMARTONEShippingBundle:Courier:new.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEShippingBundle:Courier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Courier entity.');
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
    * Creates a form to edit a Courier entity.
    *
    * @param Courier $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Courier $entity)
    {
        $form = $this->createForm(new CourierType(), $entity, array(
            'action' => $this->generateUrl('courier_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update', 'attr' => array('class' => 'btn-success')));

        return $form;
    }
    /**
     * Edits an existing Courier entity.
     *
     * @Route("/{id}", name="courier_update")
     * @Method("PUT")
     * @Template("SMARTONEShippingBundle:Courier:new.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEShippingBundle:Courier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Courier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('courier'));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Courier entity.
     *
     * @Route("/{id}", name="courier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEShippingBundle:Courier')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Courier entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('courier'));
    }

    /**
     * Creates a form to delete a Courier entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('courier_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array('class' => 'btn-danger')))
            ->getForm()
        ;
    }
}
