<?php

namespace SMARTONE\OrderBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\OrderBundle\Entity\SaleOrder;
use SMARTONE\OrderBundle\Form\SaleOrderType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Order controller.
 *
 * @Route("/order")
 */
class OrderController extends Controller
{

    /**
     * Lists all Order entities.
     *
     * @Route("/", name="order")
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
                array(
                    'brand' => $oaktree,
                    'orderStatus' => SaleOrder::Order_Start
                )
            );
        $middle = $em->getRepository('SMARTONEOrderBundle:SaleOrder')
            ->findBy(
                array(
                'brand' => $middleton,
                'orderStatus' => SaleOrder::Order_Start
                )
            );

        return array(
            'oaktree' => $oak,
            'middleton' => $middle
        );
    }

    /**
     * Creates a new Order entity.
     *
     * @Route("/", name="order_create")
     * @Method("POST")
     * @Template("SMARTONEOrderBundle:Order:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SaleOrder();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('order'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Order entity.
     *
     * @param Order $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(SaleOrder $entity)
    {
        $form = $this->createForm(new SaleOrderType(), $entity, array(
            'action' => $this->generateUrl('order_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Order entity.
     *
     * @Route("/new", name="order_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SaleOrder();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Order entity.
     *
     * @Route("/{id}", name="order_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:SaleOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Order entity.
     *
     * @Route("/{id}/edit", name="order_edit")
     * @Method("GET")
     * @Template("SMARTONEOrderBundle:Order:new.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:SaleOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Order entity.
    *
    * @param Order $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SaleOrder $entity)
    {
        $form = $this->createForm(new SaleOrderType(), $entity, array(
            'action' => $this->generateUrl('order_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Order entity.
     *
     * @Route("/{id}", name="order_update")
     * @Method("PUT")
     * @Template("SMARTONEOrderBundle:Order:new.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:SaleOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('order'));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Lists all Sale entities.
     *
     * @Route("/{id}/pdf", name="order_pdf")
     * @Method("GET")
     * @Template()
     */
    public function pdfAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:SaleOrder')->find($id);

        $html = $this->renderView('SMARTONEOrderBundle:Order:pdf.html.twig', array(
            'entity' => $entity,
            'base_dir' => $this->get('kernel')->getRootDir() . '/../web' . $this->getRequest()->getBasePath(),
        ));

        $pdf = $this->get('knp_snappy.pdf');


        $footer = '<html><head><script>
function subst() {
  var vars={};
  var x=document.location.search.substring(1).split(\'&\');
  for(var i in x) {var z=x[i].split(\'=\',2);vars[z[0]] = unescape(z[1]);}
  var x=[\'frompage\',\'topage\',\'page\',\'webpage\',\'section\',\'subsection\',\'subsubsection\'];
  for(var i in x) {
    var y = document.getElementsByClassName(x[i]);
    for(var j=0; j<y.length; ++j) y[j].textContent = vars[x[i]];
  }
}
</script></head><body style="border:0; margin: 0;" onload="subst()">
<div style="padding-top: 20px;"><table style="border-top: 1px solid #000000; width: 100%;">
  <tr>
  <td width="25%"></td>
    <td width="50%" style="color: #000000; font-size: 10px; text-align: center;">Platinum Enterprise UK Ltd T/A Bodyease | 0800 046 9901<br>www.bodyease.co.uk | VAT No. GB 698 770 265<br>Registered In England No. 3538175</td>
    <td style="text-align:right; font-size: 10px; padding-right: 30px;color: #000000;" width="25%">
      Page <span class="page"></span> of <span class="topage"></span>
    </td>
  </tr>
</table></div>
</body></html>';

//        $pdf->setOption('header-html',$header);
        $pdf->setOption('footer-html',$footer);
//          $pdf->setOption('footer-line',true);



        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html,
                array(
                    'page-height' => 150,
                    'page-width'  => 100,
                    'dpi' => 1000,
                    'image-dpi' => 1000,
                    'margin-top' => 0,
                    'margin-left' => 0,
                    'margin-right' => 0,
                    'margin-bottom' => 0,
                    'image-quality' => 1000,
                )
            ),
            200,
            array(
                'Content-Type'          => 'application/pdf',
            )
        );
    }

    /**
     * Lists all Sale entities.
     *
     * @Route("/{id}/pdf/labels", name="order_pdf_labels")
     * @Method("GET")
     * @Template()
     */
    public function pdfLabelsAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:SaleOrder')->find($id);

        $html = $this->renderView('SMARTONEOrderBundle:Order:pdfLabels.html.twig', array(
            'order' => $entity,
            'base_dir' => $this->get('kernel')->getRootDir() . '/../web' . $this->getRequest()->getBasePath(),
        ));

        $pdf = $this->get('knp_snappy.pdf');

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html,
                array(
                    'page-height' => 150,
                    'page-width'  => 100,
                    'dpi' => 1000,
                    'image-dpi' => 1000,
                    'margin-top' => 0,
                    'margin-left' => 0,
                    'margin-right' => 0,
                    'margin-bottom' => 0,
                    'image-quality' => 1000,
                )
            ),
            200,
            array(
                'Content-Type'          => 'application/pdf',
            )
        );
    }

    /**
     * Deletes a Order entity.
     *
     * @Route("/{id}", name="order_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEOrderBundle:SaleOrder')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Order entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('order'));
    }

    /**
     * Creates a form to delete a Order entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('order_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=> array('class' => 'btn-danger', 'onclick'=>"return confirm('Delete entry?')")))
            ->getForm()
        ;
    }
}
