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
 * @Route("/orders/cancelled")
 */
class CancelledController extends Controller
{

    /**
     * Lists all Order entities.
     *
     * @Route("/", name="orders_cancelled")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $oaktree = $em->getRepository('SMARTONEShippingBundle:Brand')->find(1);
        $middleton = $em->getRepository('SMARTONEShippingBundle:Brand')->find(2);

        $repository = $em->getRepository('SMARTONEOrderBundle:SaleOrder');

        $query = $repository->createQueryBuilder('d')
            ->where('d.orderStatus = :status')
            ->andWhere('d.brand = :brand')
            ->setParameter('brand', $oaktree)
            ->setParameter('status', SaleOrder::Order_Cancelled)
            ->getQuery();

        $oakCancelled = $query->getResult();

        $query = $repository->createQueryBuilder('d')
            ->where('d.orderStatus = :status')
            ->andWhere('d.brand = :brand')
            ->setParameter('brand', $oaktree)
            ->setParameter('status', SaleOrder::Orders_On_Hold)
            ->getQuery();

        $oakHold = $query->getResult();

        $query = $repository->createQueryBuilder('d')
            ->where('d.orderStatus = :status')
            ->andWhere('d.brand = :brand')
            ->setParameter('brand', $middleton)
            ->setParameter('status', SaleOrder::Order_Cancelled)
            ->getQuery();

        $middleCancelled = $query->getResult();

        $query = $repository->createQueryBuilder('d')
            ->where('d.orderStatus = :status')
            ->andWhere('d.brand = :brand')
            ->setParameter('brand', $middleton)
            ->setParameter('status', SaleOrder::Orders_On_Hold)
            ->getQuery();

        $middleHold = $query->getResult();

        return array(
            'oakCancelled' => $oakCancelled,
            'oakHold' => $oakHold,
            'middleCancelled' => $middleCancelled,
            'middleHold' => $middleHold
        );
    }

}