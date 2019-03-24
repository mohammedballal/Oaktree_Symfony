<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\ProductionItem;
use SMARTONE\ProductionBundle\Form\ProductionItemType;

/**
 * ProductionItem controller.
 *
 * @Route("/productionitem")
 */
class ProductionItemController extends Controller
{

    /**
     * Lists all ProductionItem entities.
     *
     * @Route("/", name="productionitem")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:ProductionItem')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ProductionItem entity.
     *
     * @Route("/", name="productionitem_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:ProductionItem:addSet.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ProductionItem();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productionitem_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ProductionItem entity.
     *
     * @param ProductionItem $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductionItem $entity)
    {
        $form = $this->createForm(new ProductionItemType(), $entity, array(
            'action' => $this->generateUrl('productionitem_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductionItem entity.
     *
     * @Route("/new", name="productionitem_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ProductionItem();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new ProductionItem entity.
     *
     * @Route("/add/set", name="productionitem_add_set")
     * @Method("GET")
     * @Template()
     */
    public function addSetAction()
    {
        $entity = new ProductionItem();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ProductionItem entity.
     *
     * @Route("/{id}", name="productionitem_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:ProductionItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductionItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ProductionItem entity.
     *
     * @Route("/{id}/edit", name="productionitem_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:ProductionItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductionItem entity.');
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
    * Creates a form to edit a ProductionItem entity.
    *
    * @param ProductionItem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductionItem $entity)
    {
        $form = $this->createForm(new ProductionItemType(), $entity, array(
            'action' => $this->generateUrl('productionitem_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductionItem entity.
     *
     * @Route("/{id}", name="productionitem_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:ProductionItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:ProductionItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductionItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('productionitem_edit', array('id' => $id)));
        } else {
            die();
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ProductionItem entity.
     *
     * @Route("/{id}", name="productionitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:ProductionItem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductionItem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('productionitem'));
    }

    /**
     * Creates a form to delete a ProductionItem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productionitem_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
