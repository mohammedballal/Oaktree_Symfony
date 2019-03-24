<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\MattressCover;
use SMARTONE\ProductionBundle\Form\MattressCoverType;

/**
 * MattressCover controller.
 *
 * @Route("/mattresscover")
 */
class MattressCoverController extends Controller
{

    /**
     * Lists all MattressCover entities.
     *
     * @Route("/", name="mattresscover")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:MattressCover')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new MattressCover entity.
     *
     * @Route("/", name="mattresscover_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:MattressCover:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new MattressCover();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mattresscover_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a MattressCover entity.
     *
     * @param MattressCover $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(MattressCover $entity)
    {
        $form = $this->createForm(new MattressCoverType(), $entity, array(
            'action' => $this->generateUrl('mattresscover_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new MattressCover entity.
     *
     * @Route("/new", name="mattresscover_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new MattressCover();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a MattressCover entity.
     *
     * @Route("/{id}", name="mattresscover_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:MattressCover')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MattressCover entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing MattressCover entity.
     *
     * @Route("/{id}/edit", name="mattresscover_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:MattressCover')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MattressCover entity.');
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
    * Creates a form to edit a MattressCover entity.
    *
    * @param MattressCover $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MattressCover $entity)
    {
        $form = $this->createForm(new MattressCoverType(), $entity, array(
            'action' => $this->generateUrl('mattresscover_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing MattressCover entity.
     *
     * @Route("/{id}", name="mattresscover_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:MattressCover:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:MattressCover')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MattressCover entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('mattresscover_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a MattressCover entity.
     *
     * @Route("/{id}", name="mattresscover_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:MattressCover')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MattressCover entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mattresscover'));
    }

    /**
     * Creates a form to delete a MattressCover entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mattresscover_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
