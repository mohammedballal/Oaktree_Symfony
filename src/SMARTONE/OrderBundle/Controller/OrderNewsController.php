<?php

namespace SMARTONE\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\OrderBundle\Entity\OrderNews;
use SMARTONE\OrderBundle\Form\OrderNewsType;

/**
 * OrderNews controller.
 *
 * @Route("/ordernews")
 */
class OrderNewsController extends Controller
{

    /**
     * Lists all OrderNews entities.
     *
     * @Route("/", name="ordernews")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEOrderBundle:OrderNews')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new OrderNews entity.
     *
     * @Route("/", name="ordernews_create")
     * @Method("POST")
     * @Template("SMARTONEOrderBundle:OrderNews:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new OrderNews();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ordernews_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a OrderNews entity.
     *
     * @param OrderNews $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OrderNews $entity)
    {
        $form = $this->createForm(new OrderNewsType(), $entity, array(
            'action' => $this->generateUrl('ordernews_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new OrderNews entity.
     *
     * @Route("/new", name="ordernews_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new OrderNews();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a OrderNews entity.
     *
     * @Route("/{id}", name="ordernews_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:OrderNews')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrderNews entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing OrderNews entity.
     *
     * @Route("/{id}/edit", name="ordernews_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:OrderNews')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrderNews entity.');
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
    * Creates a form to edit a OrderNews entity.
    *
    * @param OrderNews $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OrderNews $entity)
    {
        $form = $this->createForm(new OrderNewsType(), $entity, array(
            'action' => $this->generateUrl('ordernews_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing OrderNews entity.
     *
     * @Route("/{id}", name="ordernews_update")
     * @Method("PUT")
     * @Template("SMARTONEOrderBundle:OrderNews:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:OrderNews')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrderNews entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ordernews_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a OrderNews entity.
     *
     * @Route("/{id}", name="ordernews_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEOrderBundle:OrderNews')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OrderNews entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ordernews'));
    }

    /**
     * Creates a form to delete a OrderNews entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ordernews_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
