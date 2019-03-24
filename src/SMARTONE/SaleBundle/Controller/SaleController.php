<?php

namespace SMARTONE\SaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SMARTONE\SaleBundle\Entity\Sale;
use SMARTONE\SaleBundle\Form\SaleType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Sale controller.
 *
 * @Route("/sale")
 */
class SaleController extends Controller
{

    /**
     * Lists all Sale entities.
     *
     * @Route("/screen/{type}", name="sale", defaults={"type"=false})
     * @Method("GET")
     * @Template()
     */
    public function indexAction($type)
    {
        $em = $this->getDoctrine()->getManager();

        $infos = $em->getRepository('SMARTONESaleBundle:Info')->findAll();

        $full = false;

        if($type == 'full')
        {
            $full = true;
        }

        $entities = $em->getRepository('SMARTONESaleBundle:Sale')->findBy(array('complete' => false),array(
            'productionCompleteByDate' => 'ASC'
        ));

        $inPro = 0;
        $notInPro = 0;
        /** @var Sale $entity */
        foreach ($entities as $entity)
        {
            if($entity->getInProduction()) {
                $inPro++;
            } else {
                $notInPro++;
            }
        }


        $ent = array();
        $nulls = array();

        foreach ($entities as $entity) {
            if ($entity->getProductionCompleteByDate() !== null) {
                $ent[] = $entity;
            } else {
                $nulls[] = $entity;
            }
        }

        $all = array_merge($ent,$nulls);

        return array(
            'entities' => $all,
            'full' => $full,
            'infos' => $infos,
            'inPro' => $inPro,
            'notInPro' => $notInPro
        );
    }

    /**
     * Lists all Sale entities.
     *
     * @Route("/pdf", name="sale_pdf")
     * @Method("GET")
     * @Template()
     */
    public function pdfAction()
    {
        $em = $this->getDoctrine()->getManager();

        $infos = $em->getRepository('SMARTONESaleBundle:Info')->findAll();

        $full = false;

        $entities = $em->getRepository('SMARTONESaleBundle:Sale')->findByComplete(false);

        $html = $this->renderView('SMARTONESaleBundle:Sale:pdf_sale.html.twig', array(
            'entities' => $entities,
            'full' => $full,
            'infos' => $infos
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
<div style="padding-top: 20px;"><table style="border-top: 1px solid #00AAFD; width: 100%;">
  <tr>
  <td width="25%"></td>
    <td width="50%" style="color: #00AAFD; font-size: 10px; text-align: center;">Digital Stock Supplies | www.digitalstocksupply.com | +44 1274 736 035 | VAT No: 253513032</td>
    <td style="text-align:right; font-size: 10px; padding-right: 30px;color: #00AAFD;" width="25%">
      Page <span class="page"></span> of <span class="topage"></span>
    </td>
  </tr>
</table></div>
</body></html>';

        //$pdf->setOption('header-html',$header);
//        $pdf->setOption('footer-html',$footer);
        //  $pdf->setOption('footer-line',true);



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
     * @Route("/completed/sales", name="complete_sales")
     * @Method("GET")
     * @Template("SMARTONESaleBundle:Sale:index.html.twig")
     */
    public function completeSalesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SMARTONESaleBundle:Sale')->findByComplete(true);

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Sale entity.
     *
     * @Route("/", name="sale_create")
     * @Method("POST")
     * @Template("SMARTONESaleBundle:Sale:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Sale();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sale'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Sale entity.
     *
     * @param Sale $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sale $entity)
    {
        $form = $this->createForm(new SaleType(), $entity, array(
            'action' => $this->generateUrl('sale_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create','attr' => array(
            'class' => 'btn-success'
        )));

        return $form;
    }

    /**
     * Displays a form to create a new Sale entity.
     *
     * @Route("/new", name="sale_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Sale();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Sale entity.
     *
     * @Route("/{id}", name="sale_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:Sale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Sale entity.
     *
     * @Route("/{id}/edit", name="sale_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:Sale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Sale entity.
    *
    * @param Sale $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sale $entity)
    {
        $form = $this->createForm(new SaleType(), $entity, array(
            'action' => $this->generateUrl('sale_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sale entity.
     *
     * @Route("/{id}", name="sale_update")
     * @Method("PUT")
     * @Template("SMARTONESaleBundle:Sale:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SMARTONESaleBundle:Sale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sale'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Sale entity.
     *
     * @Route("/{id}", name="sale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SMARTONESaleBundle:Sale')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sale entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sale'));
    }

    /**
     * Creates a form to delete a Sale entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sale_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
