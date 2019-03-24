<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\Badge;
use SMARTONE\ProductionBundle\Form\BadgeType;

/**
 * Badge controller.
 *
 * @Route("/badge")
 */
class BadgeController extends Controller
{

    /**
     * Lists all Badge entities.
     *
     * @Route("/", name="badge")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:Badge')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Badge entity.
     *
     * @Route("/", name="badge_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:Badge:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Badge();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('badge_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Badge entity.
     *
     * @param Badge $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Badge $entity)
    {
        $form = $this->createForm(new BadgeType(), $entity, array(
            'action' => $this->generateUrl('badge_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Badge entity.
     *
     * @Route("/new", name="badge_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Badge();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Badge entity.
     *
     * @Route("/{id}", name="badge_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Badge')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Badge entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Badge entity.
     *
     * @Route("/{id}/edit", name="badge_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Badge')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Badge entity.');
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
    * Creates a form to edit a Badge entity.
    *
    * @param Badge $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Badge $entity)
    {
        $form = $this->createForm(new BadgeType(), $entity, array(
            'action' => $this->generateUrl('badge_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Badge entity.
     *
     * @Route("/{id}", name="badge_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:Badge:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Badge')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Badge entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('badge_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Badge entity.
     *
     * @Route("/{id}", name="badge_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:Badge')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Badge entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('badge'));
    }

    /**
     * Creates a form to delete a Badge entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('badge_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
