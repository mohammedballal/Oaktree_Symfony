<?php
namespace SMARTONE\ShippingBundle\Twig;

use SMARTONE\ShippingBundle\Entity\Barcode;
use SMARTONE\ShippingBundle\Entity\Shipment;

class FilterExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('loaded', array($this, 'loadedFilter')),
            new \Twig_SimpleFilter('error', array($this, 'errorFilter')),
            new \Twig_SimpleFilter('completeBy', array($this, 'completeByFilter')),
            new \Twig_SimpleFilter('late', array($this, 'lateFilter')),
            new \Twig_SimpleFilter('totals', array($this, 'totalsFilter')),
            new \Twig_SimpleFilter('totalsBySize', array($this, 'totalsBySizeFilter')),
            new \Twig_SimpleFilter('loadedBySize', array($this, 'loadedBySizeFilter')),
            new \Twig_SimpleFilter('scannedBySize', array($this, 'scannedBySizeFilter')),
            new \Twig_SimpleFilter('outstandingBySize', array($this, 'outstandingBySizeFilter')),
            new \Twig_SimpleFilter('errorBySize', array($this, 'errorBySizeFilter')),
        );
    }

    public function scannedBySizeFilter($barcodes,$size) {
        $count = 0;
        /** @var Barcode $barcode */
        foreach ($barcodes as $barcode) {
            if($barcode->getSize() == $size) {
                $count++;
            }
        }

        return $count;
    }

    public function loadedBySizeFilter($barcodes,$size) {
        $count = 0;
        /** @var Barcode $barcode */
        foreach ($barcodes as $barcode) {
            if($barcode->getSize() == $size && $barcode->getScanned()) {
                $count++;
            }
        }

        return $count;
    }

    public function outstandingBySizeFilter($barcodes,$size) {
        return $this->scannedBySizeFilter($barcodes,$size) - $this->loadedBySizeFilter($barcodes, $size);
    }

    public function errorBySizeFilter($barcodes,$size) {
        $count = 0;
        /** @var Barcode $barcode */
        foreach ($barcodes as $barcode) {
            if($barcode->getSize() == $size && $barcode->getScanned()) {
                if($barcode->getCourier() != $barcode->getShipment()->getCourier()) {
                    $count++;
                }
            }
        }

        return $count;
    }

    public function loadedFilter($entity)
    {
        $count = 0;
        /** @var Shipment $entity */

        /** @var Barcode $barcode */
        foreach ($entity->getBarcodes() as $barcode) {
            if($barcode->getScanned()) {
                $count++;
            }
        }
        return $count;
    }

    public function errorFilter($entity)
    {
        $count = 0;
        /** @var Shipment $entity */

        /** @var Barcode $barcode */
        foreach ($entity->getBarcodes() as $barcode) {
            if($barcode->getScanned()) {
                if($barcode->getCourier() != $entity->getCourier()) {
                    $count++;
                }
            }
        }
        return $count;
    }

    public function totalsBySizeFilter($entities,$size)
    {
        $count = 0;

        $arr = array(
            'packages' => 0,
            'loaded' => 0,
            'outstanding' => 0,
            'errors' => 0,
        );

        /** @var Shipment $entity */
        foreach ($entities as $entity) {
            foreach ($entity->getBarcodes() as $barcode) {
                if($barcode->getSize() == $size) {
                    $arr['packages']++ ;
                    if ($barcode->getScanned()) {
                        $arr['loaded']++;
                        if ($barcode->getCourier() != $entity->getCourier()) {
                            $arr['errors']++;
                        }
                    }
                }

            }
        }
        $arr['outstanding'] = $arr['packages'] - $arr['loaded'];

        return $arr;
    }

    public function totalsFilter($entities)
    {
        $count = 0;

        $arr = array(
            'packages' => 0,
            'loaded' => 0,
            'outstanding' => 0,
            'errors' => 0,
        );

        /** @var Shipment $entity */
        foreach ($entities as $entity) {
            $arr['packages'] += count($entity->getBarcodes());
           // $arr['loaded'] += $this->loadedFilter($entity);
            foreach($entity->getBarcodes() as $barcode) {
                if ($barcode->getScanned()) {
                    $arr['loaded']++;
                    if ($barcode->getCourier() != $entity->getCourier()) {
                        $arr['errors']++;
                    }
                }
            }
        }

        $arr['outstanding'] = $arr['packages'] - $arr['loaded'];

        return $arr;
    }

    public function completeByFilter($i)
    {

        $date = strtotime($i->format('Y-m-d H:i:s'));

        if($date > time() + 86400) {
            echo 'warning';
        } else {
            echo 'danger';
        }
    }

    public function lateFilter($i)
    {

        $date = strtotime($i->format('Y-m-d H:i:s'));

        if($date < time() + 86400) {
            echo 'lb-red';
        }
    }

    public function getName()
    {
        return 'filter_extension';
    }
}