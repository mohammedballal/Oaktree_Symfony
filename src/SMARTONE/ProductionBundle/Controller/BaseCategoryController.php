<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\BaseCategory;
use SMARTONE\ProductionBundle\Form\BaseCategoryType;

/**
 * BaseCategory controller.
 *
 * @Route("/basecategory")
 */
class BaseCategoryController extends Controller
{

    /**
     * Lists all BaseCategory entities.
     *
     * @Route("/", name="basecategory")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:BaseCategory')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new BaseCategory entity.
     *
     * @Route("/", name="basecategory_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:BaseCategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BaseCategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('basecategory_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a BaseCategory entity.
     *
     * @param BaseCategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BaseCategory $entity)
    {
        $form = $this->createForm(new BaseCategoryType(), $entity, array(
            'action' => $this->generateUrl('basecategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BaseCategory entity.
     *
     * @Route("/new", name="basecategory_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BaseCategory();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a BaseCategory entity.
     *
     * @Route("/{id}", name="basecategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:BaseCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BaseCategory entity.
     *
     * @Route("/{id}/edit", name="basecategory_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:BaseCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseCategory entity.');
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
    * Creates a form to edit a BaseCategory entity.
    *
    * @param BaseCategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BaseCategory $entity)
    {
        $form = $this->createForm(new BaseCategoryType(), $entity, array(
            'action' => $this->generateUrl('basecategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BaseCategory entity.
     *
     * @Route("/{id}", name="basecategory_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:BaseCategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:BaseCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('basecategory_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a BaseCategory entity.
     *
     * @Route("/{id}", name="basecategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:BaseCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BaseCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('basecategory'));
    }

    /**
     * Creates a form to delete a BaseCategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('basecategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
