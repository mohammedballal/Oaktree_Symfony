<?php

namespace SMARTONE\ShippingBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ShippingBundle\Entity\Barcode;
use SMARTONE\ShippingBundle\Form\BarcodeType;

/**
 * Barcode controller.
 *
 * @Route("/shipments/barcode")
 */
class BarcodeController extends Controller
{

    /**
     * Lists all Barcode entities.
     *
     * @Route("/", name="barcode")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEShippingBundle:Barcode')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Barcode entity.
     *
     * @Route("/{id}/add/barcode", name="barcode_create")
     * @Method("POST")
     * @Template("SMARTONEShippingBundle:Barcode:new.html.twig")
     */
    public function createAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $shipment = $em->getRepository('SMARTONEShippingBundle:Shipment')->find($id);

        $entity = new Barcode();
        $entity->setShipment($shipment);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if($entity->getShipment()->getCourier()->getCourierNumber() == 5) {
            if (strpos($entity->getBarcode(), 'JJD') !== 0) {
                $this->addFlash('danger', 'Barcode must start with JD');
                return $this->redirect($this->generateUrl('shipment_show', array('id' => $entity->getShipment()->getId(), 'size' => $entity->getSize()->getId())));
            }
        }

        if($entity->getShipment()->getCourier()->getCourierNumber() == 2) {
            if (strpos($entity->getBarcode(), '1Z') !== 0) {
                $this->addFlash('danger', 'Barcode must start with 1Z');
                return $this->redirect($this->generateUrl('shipment_show', array('id' => $entity->getShipment()->getId(), 'size' => $entity->getSize()->getId())));
            }
        }

        if ($form->isValid()) {
            $entity->setShipment($shipment);
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($entity);
                $em->flush();
            }
            catch(UniqueConstraintViolationException $e) {
                $this->addFlash('danger', 'Barcode already used');
            }

            return $this->redirect($this->generateUrl('shipment_show', array('id' => $entity->getShipment()->getId(),'size' => $entity->getSize()->getId())));
        } else {
            $this->addFlash('danger', 'Barcode length < 12');
            return $this->redirect($this->generateUrl('shipment_show', array('id' => $entity->getShipment()->getId(),'size' => $entity->getSize()->getId())));
        }
    }

    /**
     * Creates a form to create a Barcode entity.
     *
     * @param Barcode $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Barcode $entity)
    {
        $form = $this->createForm(new BarcodeType(), $entity, array(
            'action' => $this->generateUrl('barcode_create', array('id' => $entity->getShipment()->getId())),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Add Barcode'));

        return $form;
    }

    /**
     * Displays a form to create a new Barcode entity.
     *
     * @Route("/new", name="barcode_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Barcode();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Barcode entity.
     *
     * @Route("/{id}/delete/barcode", name="delete_barcode")
     * @Method("GET")
     * @Template()
     */
    public function deleteBarcodeAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEShippingBundle:Barcode')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Courier entity.');
        }

        $form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }



    /**
     * Deletes a Barcode entity.
     *
     * @Route("/{id}", name="barcode_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('SMARTONEShippingBundle:Barcode')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Barcode entity.');
        }

        if ($form->isValid()) {
            if($form->get('passcode')->getData() == "4042" || $form->get('passcode')->getData() == "7528") {
                $em->remove($entity);
                $em->flush();
            }
        }

        return $this->redirect($this->generateUrl('shipment_show',array('id' => $entity->getShipment()->getId())));
    }

    /**
     * Creates a form to delete a Barcode entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->add('passcode','password',array(
                'label' => 'Enter passcode'
            ))
            ->setAction($this->generateUrl('barcode_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr' => array(
                'class' => 'btn-danger'
            )))
            ->getForm()
        ;
    }
}
