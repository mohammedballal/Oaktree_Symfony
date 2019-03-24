<?php

namespace SMARTONE\ShippingBundle\Controller;

use SMARTONE\ShippingBundle\Entity\Barcode;
use SMARTONE\ShippingBundle\Form\BarcodeType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ShippingBundle\Entity\Shipment;
use SMARTONE\ShippingBundle\Form\ShipmentType;

/**
 * Shipment controller.
 *
 * @Route("/live")
 */
class LiveController extends Controller
{

    /**
     * Lists all Shipment entities.
     *
     * @Route("/", name="live_screen")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sizes = $em->getRepository('SMARTONEShippingBundle:Size')->findBy(array(),array(
            'sortOrder' => 'ASC'
        ));

        $entities = $em->getRepository('SMARTONEShippingBundle:Shipment')->findBy(array('completed' => false),array('courier' => 'ASC'));

        return array(
            'sizes' => $sizes,
            'title' => 'Shipment List',
            'entities' => $entities,
        );
    }

    /**
     * Lists all Shipment entities.
     *
     * @Route("/ajax", name="live_screen_ajax", options={"expose"=true})
     * @Method("GET")
     * @Template()
     */
    public function ajaxAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sizes = $em->getRepository('SMARTONEShippingBundle:Size')->findBy(array(),array(
            'sortOrder' => 'ASC'
        ));

        $entities = $em->getRepository('SMARTONEShippingBundle:Shipment')->findBy(array('completed' => false),array('courier' => 'ASC'));

        $html = $this->renderView('SMARTONEShippingBundle:Live:ajax.html.twig', array(
                'sizes' => $sizes,
                'title' => 'Shipment List',
                'entities' => $entities,)
        );

        $response = new JsonResponse(array('html' => $html));
        //$response->headers->set('Content-Type', 'application/json');

        return $response;
    }



}
