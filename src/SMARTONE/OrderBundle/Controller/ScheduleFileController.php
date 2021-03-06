<?php

namespace SMARTONE\OrderBundle\Controller;

use Doctrine\DBAL\Exception\InvalidArgumentException;
use SMARTONE\OrderBundle\Entity\DocOrder;
use SMARTONE\OrderBundle\Form\DocDeliveryType;
use SMARTONE\OrderBundle\Form\DocFileType;
use SMARTONE\OrderBundle\Form\DocWeekType;
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
 * @Route("/schedule/set/manifest")
 */
class ScheduleFileController extends Controller
{

    /**
     * @Route("/{id}/file", name="schedule_file")
     * @Method("GET")
     * @Template()
     */
    public function fileAction($id)
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
        $form = $this->createForm(new DocFileType(), $entity, array(
            'action' => $this->generateUrl('schedule_file_create', array('id' =>  $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Save'));

        return $form;
    }

    /**
     * Creates a new DocOrder entity.
     *
     * @Route("/{id}/file", name="schedule_file_create")
     * @Method("PUT")
     * @Template("SMARTONEOrderBundle:ScheduleFile:file.html.twig")
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
