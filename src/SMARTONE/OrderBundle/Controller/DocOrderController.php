<?php

namespace SMARTONE\OrderBundle\Controller;

use SMARTONE\OrderBundle\Entity\SaleOrder;
use SMARTONE\OrderBundle\Form\DocOrderEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\OrderBundle\Entity\DocOrder;
use SMARTONE\OrderBundle\Form\DocOrderType;
use Symfony\Component\HttpFoundation\Response;

/**
 * DocOrder controller.
 *
 * @Route("/docorder")
 */
class DocOrderController extends Controller
{

    /**
     * Lists all DocOrder entities.
     *
     * @Route("/", name="docorder")
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
            ->setParameter('status1', DocOrder::Doc_New)
            ->orderBy('d.brand', 'ASC')
            ->setParameter('status2', DocOrder::Doc_In_Production)
            ->getQuery();

        $entities = $query->getResult();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all DocOrder entities.
     *
     * @Route("/{id}/add/mode", name="docorder_add_orders")
     * @Method("GET")
     * @Template()
     */
    public function addAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DocOrder entity.');
        }

        $entities = $em->getRepository('SMARTONEOrderBundle:SaleOrder')
            ->findBy(
                array(
                    'brand' => $entity->getBrand(),
                    'orderStatus' => SaleOrder::Order_Start
                )
            );;


        return array(
            'entity' => $entity,
            'entities' => $entities
        );
    }

    /**
     * Lists all DocOrder entities.
     *
     * @Route("/{id}/add/mode", name="docorder_add_orders_post")
     * @Method("POST")
     * @Template()
     */
    public function addPostAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        if($request->request->get('ids')) {
            foreach ($request->request->get('ids') as $id) {
                $order = $em->getRepository('SMARTONEOrderBundle:SaleOrder')->find($id);
                $order->setDocOrder($entity);
                $order->setOrderStatus(SaleOrder::Orders_Scheduled);
            }

            $em->flush();
        }

        return $this->redirectToRoute('docorder_show', array(
            'id' => $entity->getId()
        ));
    }

    /**
     * Creates a new DocOrder entity.
     *
     * @Route("/", name="docorder_create")
     * @Method("POST")
     * @Template("SMARTONEOrderBundle:DocOrder:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new DocOrder();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('docorder_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
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
        $form = $this->createForm(new DocOrderType(), $entity, array(
            'action' => $this->generateUrl('docorder_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new DocOrder entity.
     *
     * @Route("/new", name="docorder_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new DocOrder();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a DocOrder entity.
     *
     * @Route("/{id}", name="docorder_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DocOrder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Lists all Sale entities.
     *
     * @Route("/{id}/pdf", name="docorder_pdf")
     * @Method("GET")
     * @Template()
     */
    public function pdfAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);



        $html = $this->renderView('SMARTONEOrderBundle:DocOrder:pdf.html.twig', array(
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
            $pdf->getOutputFromHtml($html,
                array(
                    'dpi' => 1000,
                    'image-dpi' => 1000,
                    'images' => true,
                    'margin-top' => 10,
                    'margin-left' => 0,
                    'margin-right' => 0,
                    'margin-bottom' => 20,
                    'image-quality' => 1000,
                    'page-size' => 'A4',
                    //'default-header' => true
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
     * @Route("/{id}/pdf/labels", name="docorder_pdf_labels")
     * @Method("GET")
     * @Template()
     */
    public function pdfLabelsAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        $html = $this->renderView('SMARTONEOrderBundle:DocOrder:pdfLabels.html.twig', array(
            'entity' => $entity,
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
     * Displays a form to edit an existing DocOrder entity.
     *
     * @Route("/{id}/edit", name="docorder_edit")
     * @Method("GET")
     * @Template("SMARTONEOrderBundle:DocOrder:new.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DocOrder entity.');
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
     * Creates a form to edit a DocOrder entity.
     *
     * @param DocOrder $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(DocOrder $entity)
    {
        $form = $this->createForm(new DocOrderEditType(), $entity, array(
            'action' => $this->generateUrl('docorder_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing DocOrder entity.
     *
     * @Route("/{id}", name="docorder_update")
     * @Method("PUT")
     * @Template("SMARTONEOrderBundle:DocOrder:new.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DocOrder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('docorder_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a DocOrder entity.
     *
     * @Route("/{id}", name="docorder_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONEOrderBundle:DocOrder')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DocOrder entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('docorder'));
    }

    /**
     * Creates a form to delete a DocOrder entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('docorder_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr' => array(
                'class' => 'btn-danger'
            )))
            ->getForm()
            ;
    }
}
