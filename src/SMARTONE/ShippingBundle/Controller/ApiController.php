<?php

namespace SMARTONE\ShippingBundle\Controller;

use SMARTONE\RoyalmailBundle\Model\CreateShipment;
use SMARTONE\RoyalmailBundle\Model\PrintLabel;
use SMARTONE\RoyalmailBundle\Model\RoyalmailResponse;
use SMARTONE\ShippingBundle\Entity\CourierService;
use SMARTONE\UpsBundle\Model\UpsResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ShippingBundle\Entity\Shipment;
use SMARTONE\ShippingBundle\Form\ShipmentType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Shipment controller.
 *
 * @Route("/api")
 */
class ApiController extends Controller
{

    /**
     * Lists all Shipment entities.
     *
     * @Route("/", name="api_ship")
     * @Method({"GET","POST"})
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

//        $shipment1 = $em->getRepository('SMARTONEShippingBundle:Shipment')->find(693);
////
//        $label = $this->upsAction($shipment1);
//
//        var_dump($label);
//        die();

//        $shipment1->setTrackingNumber($label['trackingNumber']);
//        $em->persist($shipment1);
//        $em->flush();
//
//        return new JsonResponse($label,200);


        $str = stripslashes($request->getContent());

        $e = \GuzzleHttp\json_decode($str);

        $shipment = null;

        $shipment = $em->getRepository('SMARTONEShippingBundle:Shipment')->findOneBy(array('ref1' => $this->xmlSafe($e->Ref1)));

        if(!$shipment) {
            $shipment = new Shipment();
        }
        $shipment->setName($this->xmlSafe($e->Name));
        $shipment->setCompanyName($this->xmlSafe($e->CompanyName));
        $shipment->setAddress($this->xmlSafe($e->Address));
        $shipment->setAddress2($this->xmlSafe($e->Address2));
        $shipment->setCity($this->xmlSafe($e->City));
        $shipment->setPostcode($this->xmlSafe($e->Postcode));
        $shipment->setCountry($this->xmlSafe($e->Country));
        $shipment->setRef1($this->xmlSafe($e->Ref1));
        $shipment->setRef2($this->xmlSafe($e->Ref2));
        $shipment->setWeight($this->xmlSafe($e->Weight));
        $shipment->setPackages($this->xmlSafe($e->Packages));

        $shipment->setShippingDate(new \DateTime('now'));

        $service = $em->getRepository('SMARTONEShippingBundle:CourierService')->findOneByShippingServiceId($e->Service);

        $shipment->setCourierService($service);

        $em->persist($shipment);
        $em->flush();

        $entity = $shipment;

        if($entity->getCourierService()->getCourier()->getCourierName() == 'Royal Mail')
        {
            $label = $this->royalMailAction($entity);
            $entity->setTrackingNumber($label['trackingNumber']);
            $em->persist($shipment);
            $em->flush();



            return new JsonResponse($label,200);
        }

        if($entity->getCourierService()->getCourier()->getCourierName() == 'UPS')
        {
            $label = $this->upsAction($entity);

            //var_dump($label);
            //die();

            $entity->setTrackingNumber($label['trackingNumber']);
            $em->persist($shipment);
            $em->flush();

            return new JsonResponse($label,200);
        }

    }


//    CompanyName = CardName
//    Name = CntctCode
//    Service = TrnspCode
//    TrackingNumber = TrackNo
//    Address = Address2

    public function xmlSafe($str)
    {
        return htmlspecialchars($str, ENT_XML1, 'UTF-8');
    }

    public function royalMailAction($entity)
    {
        $clientId = '33678db5-bb33-46e1-8ede-2fb93fa7b93f';
        $clientSecret = 'dX8tE7jU2cC6oE8rO8eN0pJ1aB0fB3xD3nT0pH4lP5oN1iA3yJ';
        $em = $this->getDoctrine()->getManager();


        $service = $entity->getCourierService();
        $ship = new CreateShipment();
        $ship->setName($entity->getCompanyName());
        $ship->setAddressLine1($entity->getAddress());
        if ($entity->getAddress2()) {
            $ship->setAddressLine2($entity->getAddress2());
        }
        $ship->setPostTown($entity->getCity());
        $ship->setPostcode($entity->getPostcode());
        $ship->setServiceType($service->getServiceType());
        $ship->setServiceOffering($service->getServiceOffering());
        $ship->setServiceFormat($service->getServiceFormatCode());
        $ship->setSignature($service->getSignature());
        $ship->setServiceEnhancementCode($service->getServiceEnhancement());
        $ship->setTelcountryCode($entity->getTel());
        $ship->setShippingDate($entity->getShippingDate()->format('Y-m-d'));
        $ship->setCustomerReference($entity->getRef1());
        $ship->setSenderReference(substr($entity->getRef2(),0,20));
        $ship->setWeightValue($entity->getWeight()*1000);
        $ship->createShipment();
        $resp = $ship->sendRequest();


//        var_dump($resp->completedShipmentInfo->allCompletedShipments->completedShipments->shipments->shipmentNumber);
//        die();

        $label = new PrintLabel();
        $label->setTrackingnumber($resp->completedShipmentInfo->allCompletedShipments->completedShipments->shipments->shipmentNumber);

        $response = new RoyalmailResponse();
        $response->setTrackingNumber($resp->completedShipmentInfo->allCompletedShipments->completedShipments->shipments->shipmentNumber);

        $llabel = $label->sendRequest();

        $response->setLabel(base64_encode($llabel->label));

        return $response->getResponse();

//        $headers = array(
//            'Content-type' => 'application/pdf'
//        );
//        $response = new Response(utf8_decode($response->getLabel()),200,$headers);
//        return $response;
    }

    public function upsAction($entity)
    {
        /** @var Shipment $entity */

        // Start shipment
        $shipment = new \Ups\Entity\Shipment;


        /** @var CourierService $courierService */
        $courierService = $entity->getCourierService();

        //A8R605

        // Set shipper
        $shipper = $shipment->getShipper();
        $shipper->setShipperNumber('A8R605');
        $shipper->setName($courierService->getShipperName());
        $shipper->setAttentionName($courierService->getShipperAttentionName());
        $shipperAddress = $shipper->getAddress();
        $shipperAddress->setAddressLine1($courierService->getShipperAddress());
        $shipperAddress->setAddressLine2($courierService->getShipperAddress2());
        $shipperAddress->setPostalCode($courierService->getShipperPostcode());
        $shipperAddress->setCity($courierService->getShipperCity());
        $shipperAddress->setCountryCode($courierService->getShipperCountryCode());
        $shipper->setAddress($shipperAddress);
        $shipper->setEmailAddress($courierService->getShipperEmail());
        $shipper->setPhoneNumber($courierService->getShipperPhone());
        $shipment->setShipper($shipper);

        // To address
        $address = new \Ups\Entity\Address();
        $address->setAddressLine1($entity->getAddress());
        $address->setAddressLine2($entity->getAddress2());
        $address->setPostalCode($entity->getPostcode());
        $address->setCity($entity->getCity());
        $address->setCountryCode($entity->getCountry());
        $shipTo = new \Ups\Entity\ShipTo();
        $shipTo->setAddress($address);
        if($courierService->getUseOnlyAddress()) {
            $shipTo->setCompanyName(substr($entity->getName(), 0, 33));
            $shipTo->setAttentionName(substr($entity->getName(), 0, 33));
        } else {
            $shipTo->setCompanyName(substr($entity->getCompanyName(), 0, 33));
            $shipTo->setAttentionName(substr($entity->getCompanyName(), 0, 33));
        }
        $shipTo->setEmailAddress($entity->getEmail());
        $shipTo->setPhoneNumber('01274872822');
        $shipment->setShipTo($shipTo);

        // Set service
        $service = new \Ups\Entity\Service;
        $service->setCode($entity->getCourierService()->getServiceOffering());
        $service->setDescription($service->getName());
        $shipment->setService($service);

        // Set description
        $shipment->setDescription($entity->getRef1());

        // Add Package
        $package = new \Ups\Entity\Package();
        $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
        $package->getPackageWeight()->setWeight($entity->getWeight());
        $unit = new \Ups\Entity\UnitOfMeasurement;
        $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
        $package->getPackageWeight()->setUnitOfMeasurement($unit);

        // Set dimensions
//        $dimensions = new \Ups\Entity\Dimensions();
//        $dimensions->setHeight(50);
//        $dimensions->setWidth(50);
//        $dimensions->setLength(50);
//        $unit = new \Ups\Entity\UnitOfMeasurement;
//        $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_CM);
//        $dimensions->setUnitOfMeasurement($unit);
//        $package->setDimensions($dimensions);

        // Add descriptions because it is a package
        $package->setDescription($entity->getRef2());

        // Add this package
        $shipment->addPackage($package);

        // Set Reference Number
        $referenceNumber = new \Ups\Entity\ReferenceNumber;

        $shipment->setReferenceNumber($referenceNumber);

        // Set payment information
        $shipment->setPaymentInformation(new \Ups\Entity\PaymentInformation('prepaid', (object)array('AccountNumber' => 'A8R605')));

        // Ask for negotiated rates (optional)
        $rateInformation = new \Ups\Entity\RateInformation;
        $rateInformation->setNegotiatedRatesIndicator(1);
        $shipment->setRateInformation($rateInformation);



        // Get shipment info
        //7D351D47367DE748
        try {
            $api = new \Ups\Shipping('0D33DD77B1F5C0BD', 'james@milotools.co.uk', 'Milotools2014', false);

            $confirm = $api->confirm(\Ups\Shipping::REQ_VALIDATE, $shipment);

//            var_dump($confirm); // Confirm holds the digest you need to accept the result

            if ($confirm) {
                $accept = $api->accept($confirm->ShipmentDigest);

               // return $accept;

                $upsResonse = new UpsResponse();
                $upsResonse->setTrackingNumber($accept->ShipmentIdentificationNumber);

                $im = imagecreatefromstring(base64_decode($accept->PackageResults->LabelImage->GraphicImage));




                $size = min(imagesx($im), imagesy($im));
                $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => 1202, 'height' => 800]);
                $im2 = imagerotate($im2, 270, 0);

                ob_start();
                imagepng($im2);
                $contents =  ob_get_contents();
                ob_end_clean();

                $html = $this->renderView('SMARTONEUpsBundle:Default:label.html.twig', array(
                    'image' => base64_encode($contents)
                ));

                $pdf = $this->get('knp_snappy.pdf');

                $image = base64_encode(
                    $pdf->getOutputFromHtml($html,
                        array(
                            'dpi' => 300,
                            'image-dpi' => 300,
                            'images' => true,
                            'margin-top' => 3,
                            'margin-left' => 0,
                            'margin-right' => 0,
                            'margin-bottom' => 0,
                            'image-quality' => 1000,
                            'page-height' => '6in',
                            'page-width'  => '4in',
                            //'default-header' => true
                        )
                    )
                );



                $upsResonse->setLabel($image);

                return $upsResonse->getResponse();
            }
        } catch (\Exception $e) {
            return $e->getMessage();

        }
    }


}
