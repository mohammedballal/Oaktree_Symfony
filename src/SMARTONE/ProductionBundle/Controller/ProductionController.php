<?php

namespace SMARTONE\ProductionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\ProductionBundle\Entity\ProductionItem;
use SMARTONE\ProductionBundle\Form\ProductionItemType;

/**
 * ProductionItem controller.
 *
 * @Route("/production")
 */
class ProductionController extends Controller
{

    /**
     * Lists all ProductionItem entities.
     *
     * @Route("/", name="production")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONEProductionBundle:ProductionItem')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ProductionItem entity.
     *
     * @Route("/", name="production_create")
     * @Method("POST")
     * @Template("SMARTONEProductionBundle:ProductionItem:addSet.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ProductionItem();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productionitem_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ProductionItem entity.
     *
     * @param ProductionItem $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductionItem $entity)
    {
        $form = $this->createForm(new ProductionItemType(), $entity, array(
            'action' => $this->generateUrl('productionitem_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductionItem entity.
     *
     * @Route("/new", name="production_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ProductionItem();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
}
