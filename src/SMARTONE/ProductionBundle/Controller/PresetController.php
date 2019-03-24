<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\Preset;
use SMARTONE\ProductionBundle\Form\PresetType;

/**
 * Preset controller.
 *
 * @Route("/preset")
 */
class PresetController extends Controller
{

    /**
     * Lists all Preset entities.
     *
     * @Route("/", name="preset")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:Preset')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Preset entity.
     *
     * @Route("/", name="preset_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:Preset:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Preset();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('preset_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Preset entity.
     *
     * @param Preset $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Preset $entity)
    {
        $form = $this->createForm(new PresetType(), $entity, array(
            'action' => $this->generateUrl('preset_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Preset entity.
     *
     * @Route("/new", name="preset_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Preset();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Preset entity.
     *
     * @Route("/{id}", name="preset_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Preset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preset entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Finds and displays a Preset entity.
     *
     * @Route("/preset/ajax", name="preset_ajax")
     * @Method("GET")
     * @Template()
     */
    public function ajaxAction(Request $request)
    {

        $id = $request->query->get('id');

        $em = $this->getDoctrine()->getManager();

        /** @var Preset $entity */
        $entity = $em->getRepository('SMARTONEProductionBundle:Preset')->findOneByBrand($id);

        if($entity) {
            $a = array(
                'badge' => $entity->getBadge()->getId(),
                'bedAction' => $entity->getBedAction()->getId(),
                'endBar' => $entity->getEndBar()->getId(),
                'feet' => $entity->getFeet()->getId(),
                'comment' => $entity->getComment(),
            );
        }

        if (!$entity) {
            $a = array(
                'badge' => 0,
                'bedAction' => 0,
                'endBar' => 0,
                'feet' => 0,
                'comment' => '',
            );

        }



       return new JsonResponse($a);
    }

    /**
     * Displays a form to edit an existing Preset entity.
     *
     * @Route("/{id}/edit", name="preset_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Preset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preset entity.');
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
    * Creates a form to edit a Preset entity.
    *
    * @param Preset $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Preset $entity)
    {
        $form = $this->createForm(new PresetType(), $entity, array(
            'action' => $this->generateUrl('preset_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Preset entity.
     *
     * @Route("/{id}", name="preset_update")
     * @Method("PUT")
     * @Template("SMARTONEProductionBundle:Preset:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEProductionBundle:Preset')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preset entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('preset_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Preset entity.
     *
     * @Route("/{id}", name="preset_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEProductionBundle:Preset')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Preset entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('preset'));
    }

    /**
     * Creates a form to delete a Preset entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('preset_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
