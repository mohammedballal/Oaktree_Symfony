<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\ProductionItemBase;
use SMARTONE\ProductionBundle\Form\ProductionItemBaseType;

/**
 * ProductionItemBase controller.
 *
 * @Route("/productionitembase")
 */
class ProductionItemBaseController extends Controller
{

    /**
     * Lists all ProductionItemBase entities.
     *
     * @Route("/", name="productionitembase")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:ProductionItemBase')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ProductionItemBase entity.
     *
     * @Route("/", name="productionitembase_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:ProductionItem:base/new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ProductionItemBase();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productionitembase_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ProductionItemBase entity.
     *
     * @param ProductionItemBase $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductionItemBase $entity)
    {
        $form = $this->createForm(new ProductionItemBaseType(), $entity, array(
            'action' => $this->generateUrl('productionitembase_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Add Base', 'attr' => array(
            'class' => 'btn-success'
        )));

        return $form;
    }

    /**
     * Displays a form to create a new ProductionItemBase entity.
     *
     * @Route("/new", name="productionitembase_new")
     * @Method("GET")
     * @Template("SMARTONEProductionBundle:ProductionItem:base/new.html.twig")
     */
    public function newAction()
    {
        $entity = new ProductionItemBase();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ProductionItemBase entity.
     *
     * @Route("/{id}", name="productionitembase_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:ProductionItemBase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductionItemBase entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ProductionItemBase entity.
     *
     * @Route("/{id}/edit", name="productionitembase_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:ProductionItemBase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductionItemBase entity.');
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
    * Creates a form to edit a ProductionItemBase entity.
    *
    * @param ProductionItemBase $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductionItemBase $entity)
    {
        $form = $this->createForm(new ProductionItemBaseType(), $entity, array(
            'action' => $this->generateUrl('productionitembase_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductionItemBase entity.
     *
     * @Route("/{id}", name="productionitembase_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:ProductionItemBase:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:ProductionItemBase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductionItemBase entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('productionitembase_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ProductionItemBase entity.
     *
     * @Route("/{id}", name="productionitembase_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:ProductionItemBase')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductionItemBase entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('productionitembase'));
    }

    /**
     * Creates a form to delete a ProductionItemBase entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productionitembase_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
