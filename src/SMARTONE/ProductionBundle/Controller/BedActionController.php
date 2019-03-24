<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\BedAction;
use SMARTONE\ProductionBundle\Form\BedActionType;

/**
 * BedAction controller.
 *
 * @Route("/bedaction")
 */
class BedActionController extends Controller
{

    /**
     * Lists all BedAction entities.
     *
     * @Route("/", name="bedaction")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:BedAction')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new BedAction entity.
     *
     * @Route("/", name="bedaction_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:BedAction:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BedAction();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bedaction_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a BedAction entity.
     *
     * @param BedAction $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BedAction $entity)
    {
        $form = $this->createForm(new BedActionType(), $entity, array(
            'action' => $this->generateUrl('bedaction_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BedAction entity.
     *
     * @Route("/new", name="bedaction_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BedAction();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a BedAction entity.
     *
     * @Route("/{id}", name="bedaction_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:BedAction')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BedAction entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BedAction entity.
     *
     * @Route("/{id}/edit", name="bedaction_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:BedAction')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BedAction entity.');
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
    * Creates a form to edit a BedAction entity.
    *
    * @param BedAction $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BedAction $entity)
    {
        $form = $this->createForm(new BedActionType(), $entity, array(
            'action' => $this->generateUrl('bedaction_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BedAction entity.
     *
     * @Route("/{id}", name="bedaction_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:BedAction:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:BedAction')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BedAction entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bedaction_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a BedAction entity.
     *
     * @Route("/{id}", name="bedaction_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:BedAction')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BedAction entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bedaction'));
    }

    /**
     * Creates a form to delete a BedAction entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bedaction_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
