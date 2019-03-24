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
 * @Route("/barcode")
 */
class BarcodeController extends Controller
{

    /**
     * Displays a form to create a new ProductionItem entity.
     *
     * @Route("/show", name="barcode_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction()
    {
        return array();
    }

    /**
     * Displays a form to create a new ProductionItem entity.
     *
     * @Route("/sites", name="barcode_sites")
     * @Method("GET")
     * @Template()
     */
    public function sitesAction()
    {
        $sites = array(
            'ariston-boiler-parts.co.uk',
            'ariston-boiler-spares.co.uk',
            'ariston-parts.co.uk',
            'aristonspares.com',
            'biasiparts.com',
            'biasi-parts.co.uk',
            'boilerparts247.com',
            'boilerparts247.co.uk',
            'boiler-spareparts.com',
            'boiler-spareparts.co.uk',
            'boilerspares247.com',
            'boilerspares247.co.uk',
            'bradfordboilerparts.com',
            'bradfordboilerparts.co.uk',
            'bradfordboilerspares.com',
            'bradfordheating.com',
            'bradfordheatingparts.com',
            'bradfordheatingspares.com',
            'buderusparts.com',
            'buderusparts.co.uk',
            'buderusspares.com',
            'buderusspares.co.uk',
            'chaffoteauxparts.com',
            'chaffoteauxparts.co.uk',
            'cheapboilerparts.com',
            'fernox-tf1.com',
            'fernoxtf1.com',
            'fernox-tf1.co.uk',
            'fernoxtf1.co.uk',
            'ferroliparts.com',
            'flue-analyser.com',
            'flue-analyser.co.uk',
            'gas-analyser.com',
            'gdc-fires.com',
            'gdcfires.com',
            'gdc-fires.co.uk',
            'gdcfires.co.uk',
            'gdc-spares.com',
            'gdcspares.com',
            'gdc-spares.co.uk',
            'gdcspares.co.uk',
            'halsteadparts.com',
            'halsteadparts.co.uk',
            'halsteadspares.co.uk',
            'heatingparts247.com',
            'heatingparts4boilers.com',
            'heatingparts4boilers.co.uk',
            'heating-spares-247.com',
            'heatingspares-247.com',
            'heating-spares-247.co.uk',
            'heatingspares247.co.uk',
            'heatline-boiler-parts.co.uk',
            'heatline-boilers.com',
            'heatlineboilers.com',
            'heatlineboilers.co.uk',
            'heatline-boiler-spares.co.uk',
            'heatlineparts.com',
            'heatlineparts.co.uk',
            'hgheating.com',
            'hgheating.co.uk',
            'h-r-p-c.com',
            'h-r-p-c.co.uk',
            'ideal-independent.com',
            'idealindependent.com',
            'ideal-independent.co.uk',
            'idealindependent.co.uk',
            'ideal-logicplus.com',
            'ideal-logicplus.co.uk',
            'inta-klean.com',
            'intaklean.com',
            'inta-klean.co.uk',
            'intaklean.co.uk',
            'intergas-boilers.com',
            'intergas-boilers.co.uk',
            'intergas-boilers.uk',
            'intergas-parts.com',
            'intergas-parts.co.uk',
            'intergas-parts.uk',
            'interpartparts.com',
            'interpartparts.co.uk',
            'interpartspares.com',
            'kane425.com',
            'kane425.co.uk',
            'kane-451.com',
            'kane451.com',
            'kane-451.co.uk',
            'kane451.co.uk',
            'kane-455-analyser.com',
            'kane455-analyser.com',
            'kane-455-analyser.co.uk',
            'kane455-analyser.co.uk',
            'kane455.com',
            'kane-455.co.uk',
            'kane455.co.uk',
            'kane-457.com',
            'kane457.com',
            'kane-457.co.uk',
            'kane457.co.uk',
            'kane-analyser.com',
            'kane-analyser.co.uk',
            'mainboilerparts.com',
            'main-boiler-parts.co.uk',
            'main-boilers.com',
            'main-boilers.co.uk',
            'mainboilerspares.com',
            'main-boiler-spares.co.uk',
            'mainboilerspares.co.uk',
            'maincombi.com',
            'maincombi.co.uk',
            'mtsparts.com',
            'mtsparts.co.uk',
            'mtsspares.com',
            'mtsspares.co.uk',
            'mysonparts.com',
            'mysonparts.co.uk',
            'potterton-boiler-parts.co.uk',
            'potterton-boiler-spares.co.uk',
            'pottertonparts.com',
            'procombi-boiler-parts.co.uk',
            'procombi-boiler-spares.co.uk',
            'pro-combi.com',
            'procombi.com',
            'pro-combi.co.uk',
            'procombi.co.uk',
            'procombiessential.com',
            'procombiessential.co.uk',
            'procombi-exclusive.com',
            'procombiexclusive.com',
            'procombi-exclusive.co.uk',
            'procombiexclusive.co.uk',
            'procombiparts.com',
            'procombiparts.co.uk',
            'procombispares.com',
            'procombispares.co.uk',
            'proradiators.co.uk',
            'proradradiators.com',
            'proradradiators.co.uk',
            'prothermparts.com',
            'prothermparts.co.uk',
            'prothermspares.com',
            'prothermspares.co.uk',
            'ravenheatparts.com',
            'remeha-avantaexclusive.com',
            'remehaavantaexclusive.com',
            'remeha-avantaexclusive.co.uk',
            'remehaavantaexclusive.co.uk',
            'remehaboilerparts.com',
            'remeha-boiler-parts.co.uk',
            'remeha-boilers.co.uk',
            'remehaboilerspares.com',
            'remeha-boiler-spares.co.uk',
            'remehaparts.com',
            'remehaparts.co.uk',
            'robinsonwilly-fires.com',
            'robinsonwillyfires.com',
            'robinsonwilly-fires.co.uk',
            'robinsonwillyfires.co.uk',
            'sabrespares.com',
            'simeboilerparts.com',
            'simeboilerspares.com',
            'simeparts.com',
            'simeparts.co.uk',
            'simespares.com',
            'simesparts.com',
            'simesparts.co.uk',
            'vaillant-boiler-parts.co.uk',
            'vaillant-boiler-spares.co.uk',
            'vaillant-ecotec.com',
            'vaillant-heating.com',
            'vaillant-heating.co.uk',
            'vaillant-parts.com',
            'vaillant-parts.co.uk',
            'vaillant-spares.com',
            'vaillantunistore.com',
            'vaillantunistore.co.uk',
            'valorparts.com',
            'viessmann-parts.com',
            'viessmannparts.com',
            'viessmannparts.co.uk',
            'viessmann-spares.com',
            'viessmannspares.com',
            'viessmannspares.co.uk',
            'vokera-boiler-parts.com',
            'vokera-boiler-parts.co.uk',
            'vokera-boiler-spares.co.uk',
            'vokera-compact.com',
            'vokeracompact.com',
            'vokera-compact.co.uk',
            'vokeracompact.co.uk',
            'vokera-lineaone.com',
            'vokeralineaone.com',
            'vokera-lineaone.co.uk',
            'vokeralineaone.co.uk',
            'vokera-myunte.com',
            'vokeramyunte.com',
            'vokera-myunte.co.uk',
            'vokeramyunte.co.uk',
            'vokera-parts.com',
            'vokera-parts.co.uk',
            'vokera-verve.com',
            'vokeraverve.com',
            'vokera-verve.co.uk',
            'vokeraverve.co.uk',
            'vokera-vision.com',
            'vokeravision.com',
            'vokera-vision.co.uk',
            'vokeravision.co.uk',
            'worcester-boiler-parts.co.uk',
            'worcesterparts.com',
        );

        return array(
            'sites' => $sites
        );
    }
}
