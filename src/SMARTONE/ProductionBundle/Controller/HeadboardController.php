<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\Headboard;
use SMARTONE\ProductionBundle\Form\HeadboardType;

/**
 * Headboard controller.
 *
 * @Route("/headboard")
 */
class HeadboardController extends Controller
{

    /**
     * Lists all Headboard entities.
     *
     * @Route("/", name="headboard")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:Headboard')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Headboard entity.
     *
     * @Route("/", name="headboard_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:Headboard:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Headboard();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('headboard_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Headboard entity.
     *
     * @param Headboard $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Headboard $entity)
    {
        $form = $this->createForm(new HeadboardType(), $entity, array(
            'action' => $this->generateUrl('headboard_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Headboard entity.
     *
     * @Route("/new", name="headboard_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Headboard();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Headboard entity.
     *
     * @Route("/{id}", name="headboard_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Headboard')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Headboard entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Headboard entity.
     *
     * @Route("/{id}/edit", name="headboard_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Headboard')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Headboard entity.');
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
    * Creates a form to edit a Headboard entity.
    *
    * @param Headboard $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Headboard $entity)
    {
        $form = $this->createForm(new HeadboardType(), $entity, array(
            'action' => $this->generateUrl('headboard_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Headboard entity.
     *
     * @Route("/{id}", name="headboard_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:Headboard:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Headboard')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Headboard entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('headboard_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Headboard entity.
     *
     * @Route("/{id}", name="headboard_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:Headboard')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Headboard entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('headboard'));
    }

    /**
     * Creates a form to delete a Headboard entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('headboard_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
