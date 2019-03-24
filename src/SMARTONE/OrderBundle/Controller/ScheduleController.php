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
 * @Route("/schedule")
 */
class ScheduleController extends Controller
{

    /**
     * Lists all Order entities.
     *
     * @Route("/", name="schedule")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('SMARTONEOrderBundle:DocOrder');

        $query = $repository->createQueryBuilder('d')
            ->where('d.docStatus = :status1')
            ->orWhere('d.docStatus = :status2')
            ->andWhere('d.deliveryScheduleDate is NOT NULL')
            ->setParameter('status1', DocOrder::Doc_New)
            ->orderBy('d.deliveryScheduleDate', 'ASC')
            ->setParameter('status2', DocOrder::Doc_In_Production)
            ->getQuery();

        $notNUll = $query->getResult();

        $query = $repository->createQueryBuilder('d')
            ->where('d.docStatus = :status1')
            ->orWhere('d.docStatus = :status2')
            ->andWhere('d.deliveryScheduleDate is NULL')
            ->setParameter('status1', DocOrder::Doc_New)
            ->setParameter('status2', DocOrder::Doc_In_Production)
            ->getQuery();

        $null = $query->getResult();


        $entities = array_merge($notNUll,$null);

        if ($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            return array(
                'entities' => $entities
            );
        }


        return $this->render('SMARTONEOrderBundle:Schedule:user.html.twig', array(
            'entities' => $entities
        ));

    }

    /**
     * @param $id
     * @param $type
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/{id}/mark/complete", name="schedule_complete")
     * @Method("GET")
     */
    public function markAsCompleteAction($id, $type)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        $entity->setDocStatus(DocOrder::Doc_Production_Complete);

        /** @var SaleOrder $order */
        foreach ($entity->getSaleOrder() as $order) {
            $order->setOrderStatus(SaleOrder::Orders_Complete);
        }

        $em->flush();

        return $this->redirectToRoute('schedule');
    }

    /**
     * @param $id
     * @param $type
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/{id}/mark/uncomplete", name="schedule_un_complete")
     * @Method("GET")
     */
    public function markAsUnCompleteAction($id, $type)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        $entity->setDocStatus(DocOrder::Doc_In_Production);

        /** @var SaleOrder $order */
        foreach ($entity->getSaleOrder() as $order) {
            $order->setOrderStatus(SaleOrder::Orders_Scheduled);
        }

        $em->flush();

        return $this->redirectToRoute('schedule');
    }

    /**
     * @param $id
     * @param $type
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/{id}/{type}/production", defaults={"type" = 0}, name="schedule_production")
     * @Method("GET")
     */
    public function putInProductionAction($id, $type)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        $entity->setDocStatus($type);

        $em->flush();

        return $this->redirectToRoute('schedule');
    }

    /**
     * @Route("/{id}/delivery", name="schedule_delivery")
     * @Method("GET")
     * @Template()
     */
    public function deliveryAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        $form = $this->createCreateForm($entity);

        return array(
            'form' => $form->createView(),
            'entity' => $entity
        );
    }

    /**
     * Creates a form to create a DocOrder entity.
     *
     * @param DocOrder $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(DocOrder $entity)
    {
        $form = $this->createForm(new DocDeliveryType(), $entity, array(
            'action' => $this->generateUrl('schedule_delivery_create', array('id' =>  $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Save'));

        return $form;
    }

    /**
     * Creates a new DocOrder entity.
     *
     * @Route("/{id}/delivery", name="schedule_delivery_create")
     * @Method("PUT")
     * @Template("SMARTONEOrderBundle:Schedule:delivery.html.twig")
     */
    public function createAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('schedule'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
}
