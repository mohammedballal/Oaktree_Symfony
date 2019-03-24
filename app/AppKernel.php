<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Stfalcon\Bundle\TinymceBundle\StfalconTinymceBundle(),
            new Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle(),
            new APY\DataGridBundle\APYDataGridBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new SMARTONE\UserBundle\SMARTONEUserBundle(),
            new SMARTONE\HomeBundle\SMARTONEHomeBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new SMARTONE\ShippingBundle\SMARTONEShippingBundle(),
            new SMARTONE\ReportBundle\SMARTONEReportBundle(),
            new SMARTONE\ApiBundle\SMARTONEApiBundle(),
            new SMARTONE\SaleBundle\SMARTONESaleBundle(),
            new SMARTONE\ProductionBundle\SMARTONEProductionBundle(),
            new SGK\BarcodeBundle\SGKBarcodeBundle(),
            new SMARTONE\OrderBundle\SMARTONEOrderBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();

        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}