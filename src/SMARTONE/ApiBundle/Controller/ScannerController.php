<?php

namespace SMARTONE\ApiBundle\Controller;

use SMARTONE\ShippingBundle\Entity\Barcode;
use SMARTONE\ShippingBundle\Entity\Scanned;
use SMARTONE\ShippingBundle\Entity\Shipment;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\UserBundle\Entity\User;
use SMARTONE\UserBundle\Form\UserType;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

/**
 * User controller.
 *
 * @Route("/rest/scanner")
 */
class ScannerController extends Controller
{

    /**
     * Lists all User entities.
     *
     * @Route("/", name="rest_scanner")
     * @Method("POST")
     * @Template()
     */
    public function indexAction(Request $request)
    {
       $obj = json_decode($request->getContent(), true);

       if($obj) {
           if (!array_key_exists('courier', $obj) || !array_key_exists('barcode', $obj)) {
               echo 'error 1';
           } else {
               if(!isset($obj['barcode']) || !isset($obj['courier'])) {
                   echo 'error 2';
               } else {
                   $em = $this->getDoctrine()->getManager();
                   $scan = new Scanned();

                   $courier = $em->getRepository('SMARTONEShippingBundle:Courier')->findOneByCourierNumber($obj['courier']);
                   $scan->setBarcode($obj['barcode']);
                   $scan->setCourier($courier);

                   if($scan->getCourier()->getCourierName() == 5) {
                       if (strpos($scan->getBarcode(), 'JJD') !== 0) {
                           throw new InvalidArgumentException();
                       }
                   }

                   if($scan->getCourier()->getCourierName() == 2) {
                       if (strpos($scan->getBarcode(), '1Z') !== 0) {
                           throw new InvalidArgumentException();
                       }
                   }

                   $em->persist($scan);
                   $em->flush();

                   /** @var Barcode $barcode */
                   $barcode = $em->getRepository('SMARTONEShippingBundle:Barcode')->findOneBy(array('barcode' => $obj['barcode']));
echo $obj['barcode'];
                   if($barcode) {
                       $barcode->setScanned(true);
                       $barcode->setCourier($courier->getCourierName());

                       $em->persist($barcode);
                       $em->flush();

                       if($barcode->getShipment()->getBarcodesComplete()) {
                           /** @var Shipment $shipment */
                           $shipment = $barcode->getShipment();

                           $shipment->setCompleted(true);
                           $shipment->setCompleteAt(new \DateTime());

                           $em->flush();
                       }
                   }
               }
           }
       }
       else
       {
           echo 'error 3';
       }

       die();
    }
}
