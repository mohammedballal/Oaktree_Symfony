<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\EndBar;
use SMARTONE\ProductionBundle\Form\EndBarType;

/**
 * EndBar controller.
 *
 * @Route("/endbar")
 */
class EndBarController extends Controller
{

    /**
     * Lists all EndBar entities.
     *
     * @Route("/", name="endbar")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:EndBar')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new EndBar entity.
     *
     * @Route("/", name="endbar_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:EndBar:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new EndBar();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('endbar_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a EndBar entity.
     *
     * @param EndBar $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EndBar $entity)
    {
        $form = $this->createForm(new EndBarType(), $entity, array(
            'action' => $this->generateUrl('endbar_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new EndBar entity.
     *
     * @Route("/new", name="endbar_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EndBar();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EndBar entity.
     *
     * @Route("/{id}", name="endbar_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:EndBar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EndBar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EndBar entity.
     *
     * @Route("/{id}/edit", name="endbar_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:EndBar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EndBar entity.');
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
    * Creates a form to edit a EndBar entity.
    *
    * @param EndBar $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(EndBar $entity)
    {
        $form = $this->createForm(new EndBarType(), $entity, array(
            'action' => $this->generateUrl('endbar_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing EndBar entity.
     *
     * @Route("/{id}", name="endbar_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:EndBar:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:EndBar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EndBar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('endbar_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a EndBar entity.
     *
     * @Route("/{id}", name="endbar_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:EndBar')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EndBar entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('endbar'));
    }

    /**
     * Creates a form to delete a EndBar entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('endbar_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
