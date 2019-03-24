<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\Base;
use SMARTONE\ProductionBundle\Form\BaseType;

/**
 * Base controller.
 *
 * @Route("/base")
 */
class BaseController extends Controller
{

    /**
     * Lists all Base entities.
     *
     * @Route("/", name="base")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:BaseCategory')->findAll(array('sortOrder' => 'ASC'));

        return array(
            'categories' => $entities,
        );
    }

    /**
     * Creates a new Base entity.
     *
     * @Route("/", name="base_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:Base:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Base();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('base_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    /**
     * Finds and displays a Preset entity.
     *
     * @Route("/base/ajax", name="base_ajax")
     * @Method("GET")
     */
    public function ajaxAction(Request $request)
    {

        $id = $request->query->get('id');

        $em = $this->getDoctrine()->getManager();

        /** @var Base $entity */
        $entity = $em->getRepository('SMARTONEProductionBundle:Base')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preset entity.');
        }

        $a = array(
            'base' => $entity->getId(),
            'is_drawer' => $entity->getisDrawer(),
        );

        return new JsonResponse($a);
    }

    /**
     * Creates a form to create a Base entity.
     *
     * @param Base $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Base $entity)
    {
        $form = $this->createForm(new BaseType(), $entity, array(
            'action' => $this->generateUrl('base_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Base entity.
     *
     * @Route("/new", name="base_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Base();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Base entity.
     *
     * @Route("/{id}", name="base_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Base')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Base entity.');
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
     * @Route("/{id}/copy", name="base_copy")
     * @Method("GET")
     * @Template("SMARTONEProductionBundle:Base:new.html.twig")
     */
    public function copyAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Base')->find($id);

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
     * Displays a form to edit an existing Base entity.
     *
     * @Route("/{id}/edit", name="base_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Base')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Base entity.');
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
    * Creates a form to edit a Base entity.
    *
    * @param Base $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Base $entity)
    {
        $form = $this->createForm(new BaseType(), $entity, array(
            'action' => $this->generateUrl('base_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Base entity.
     *
     * @Route("/{id}", name="base_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:Base:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Base')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Base entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('base_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Base entity.
     *
     * @Route("/{id}", name="base_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:Base')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Base entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('base'));
    }

    /**
     * Creates a form to delete a Base entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('base_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
