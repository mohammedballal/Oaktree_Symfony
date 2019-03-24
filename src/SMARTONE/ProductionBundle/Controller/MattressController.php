<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\Mattress;
use SMARTONE\ProductionBundle\Form\MattressType;

/**
 * Mattress controller.
 *
 * @Route("/mattress")
 */
class MattressController extends Controller
{

    /**
     * Lists all Mattress entities.
     *
     * @Route("/", name="mattress")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEShippingBundle:Brand')->findAll(array('sortOrder' => 'ASC'));

        return array(
            'categories' => $entities,
        );
    }
    /**
     * Creates a new Mattress entity.
     *
     * @Route("/", name="mattress_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:Mattress:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Mattress();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mattress_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Mattress entity.
     *
     * @param Mattress $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Mattress $entity)
    {
        $form = $this->createForm(new MattressType(), $entity, array(
            'action' => $this->generateUrl('mattress_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Mattress entity.
     *
     * @Route("/new", name="mattress_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Mattress();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Mattress entity.
     *
     * @Route("/{id}", name="mattress_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Mattress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mattress entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Mattress entity.
     *
     * @Route("/{id}/edit", name="mattress_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Mattress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mattress entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Mattress entity.
     *
     * @Route("/{id}/copy", name="mattress_copy")
     * @Method("GET")
     * @Template("SMARTONEProductionBundle:Mattress:new.html.twig")
     */
    public function copyAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Mattress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mattress entity.');
        }

        $entity = clone $entity;

        $editForm = $this->createCreateForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Mattress entity.
    *
    * @param Mattress $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Mattress $entity)
    {
        $form = $this->createForm(new MattressType(), $entity, array(
            'action' => $this->generateUrl('mattress_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Mattress entity.
     *
     * @Route("/{id}", name="mattress_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:Mattress:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Mattress')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mattress entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('mattress_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Mattress entity.
     *
     * @Route("/{id}", name="mattress_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:Mattress')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mattress entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mattress'));
    }

    /**
     * Creates a form to delete a Mattress entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mattress_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
