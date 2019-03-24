<?php

namespace SMARTONE\OrderBundle\Controller;

use Doctrine\DBAL\Exception\InvalidArgumentException;
use SMARTONE\OrderBundle\Entity\DocOrder;
use SMARTONE\OrderBundle\Form\DocDeliveryType;
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
 * @Route("/completed")
 */
class CompletedController extends Controller
{

    /**
     * Lists all Order entities.
     *
     * @Route("/", name="completed")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('SMARTONEOrderBundle:DocOrder');

        $query = $repository->createQueryBuilder('d')
            ->where('d.docStatus = :status1')
            ->setParameter('status1', DocOrder::Doc_Production_Complete)
            ->orderBy('d.deliveryScheduleDate','DESC')
            ->getQuery();

        $entities = $query->getResult();

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return array(
                'entities' => $entities
            );
        }


        return $this->render('SMARTONEOrderBundle:Completed:user.html.twig', array(
            'entities' => $entities
        ));

    }
}
