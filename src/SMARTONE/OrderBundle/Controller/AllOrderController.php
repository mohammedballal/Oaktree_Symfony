<?php

namespace SMARTONE\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\OrderBundle\Entity\SaleOrder;
use SMARTONE\OrderBundle\Form\SaleOrderType;

/**
 * Order controller.
 *
 * @Route("/all/orders")
 */
class AllOrderController extends Controller
{

    /**
     * Lists all Order entities.
     *
     * @Route("/", name="all_order")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $oaktree = $em->getRepository('SMARTONEShippingBundle:Brand')->find(1);
        $middleton = $em->getRepository('SMARTONEShippingBundle:Brand')->find(2);

        $oak = $em->getRepository('SMARTONEOrderBundle:SaleOrder')
            ->findBy(
                array('brand' => $oaktree),
                array('orderReceiveDate' => 'DESC')
            );
        $middle = $em->getRepository('SMARTONEOrderBundle:SaleOrder')
            ->findBy(
                array('brand' => $middleton,),
                array('orderReceiveDate' => 'DESC')
            );

        return array(
            'oaktree' => $oak,
            'middleton' => $middle
        );
    }
}