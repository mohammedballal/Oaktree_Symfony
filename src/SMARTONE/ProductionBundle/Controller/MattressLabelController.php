<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\MattressLabel;
use SMARTONE\ProductionBundle\Form\MattressLabelType;

/**
 * MattressLabel controller.
 *
 * @Route("/mattresslabel")
 */
class MattressLabelController extends Controller
{

    /**
     * Lists all MattressLabel entities.
     *
     * @Route("/", name="mattresslabel")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:MattressLabel')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new MattressLabel entity.
     *
     * @Route("/", name="mattresslabel_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:MattressLabel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new MattressLabel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mattresslabel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a MattressLabel entity.
     *
     * @param MattressLabel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(MattressLabel $entity)
    {
        $form = $this->createForm(new MattressLabelType(), $entity, array(
            'action' => $this->generateUrl('mattresslabel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MattressLabel entity.
     *
     * @Route("/new", name="mattresslabel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new MattressLabel();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a MattressLabel entity.
     *
     * @Route("/{id}", name="mattresslabel_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:MattressLabel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MattressLabel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing MattressLabel entity.
     *
     * @Route("/{id}/edit", name="mattresslabel_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:MattressLabel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MattressLabel entity.');
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
    * Creates a form to edit a MattressLabel entity.
    *
    * @param MattressLabel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MattressLabel $entity)
    {
        $form = $this->createForm(new MattressLabelType(), $entity, array(
            'action' => $this->generateUrl('mattresslabel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MattressLabel entity.
     *
     * @Route("/{id}", name="mattresslabel_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:MattressLabel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:MattressLabel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MattressLabel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('mattresslabel_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a MattressLabel entity.
     *
     * @Route("/{id}", name="mattresslabel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:MattressLabel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MattressLabel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mattresslabel'));
    }

    /**
     * Creates a form to delete a MattressLabel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mattresslabel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
