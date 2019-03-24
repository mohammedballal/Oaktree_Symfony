<?php

namespace SMARTONE\SaleBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\SaleBundle\Entity\Info;
use SMARTONE\SaleBundle\Form\InfoType;

/**
 * Info controller.
 *
 * @Route("/info")
 */
class InfoController extends Controller
{

    /**
     * Lists all Info entities.
     *
     * @Route("/", name="info")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONESaleBundle:Info')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Info entity.
     *
     * @Route("/", name="info_create")
     * @Method("POST")
     * @Template("SMARTONESaleBundle:Info:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Info();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('info'));
            }
            catch (UniqueConstraintViolationException $e) {
                $this->addFlash('danger','Heading already used');
            }


        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Info entity.
     *
     * @param Info $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Info $entity)
    {
        $form = $this->createForm(new InfoType(), $entity, array(
            'action' => $this->generateUrl('info_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create','attr' => array(
            'class' => 'btn-success'
        )));

        return $form;
    }

    /**
     * Displays a form to create a new Info entity.
     *
     * @Route("/new", name="info_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Info();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Info entity.
     *
     * @Route("/{id}", name="info_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:Info')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Info entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Info entity.
     *
     * @Route("/{id}/edit", name="info_edit")
     * @Method("GET")
     * @Template("SMARTONESaleBundle:Info:new.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:Info')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Info entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Info entity.
    *
    * @param Info $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Info $entity)
    {
        $form = $this->createForm(new InfoType(), $entity, array(
            'action' => $this->generateUrl('info_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update','attr' => array(
            'class' => 'btn-success'
        )));

        return $form;
    }
    /**
     * Edits an existing Info entity.
     *
     * @Route("/{id}", name="info_update")
     * @Method("PUT")
     * @Template("SMARTONESaleBundle:Info:new.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:Info')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Info entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            try {
                $em->flush();
                return $this->redirect($this->generateUrl('info'));
            }
            catch (UniqueConstraintViolationException $e) {
                $this->addFlash('danger','Heading already used');
            }


        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Info entity.
     *
     * @Route("/{id}", name="info_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONESaleBundle:Info')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Info entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('info'));
    }

    /**
     * Creates a form to delete a Info entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('info_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr' => array(
                'btn-success'
            )))
            ->getForm()
        ;
    }
}
