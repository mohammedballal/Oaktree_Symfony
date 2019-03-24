<?php

namespace SMARTONE\ShippingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Barcode
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Barcode
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true, unique=true)
     * @Assert\NotBlank()
     */
    protected $barcode;

    /**
     * @ORM\ManyToOne(targetEntity="Shipment", inversedBy="barcodes")
     * @ORM\JoinColumn(name="shipment", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $shipment;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $scanned;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $courier;

    /**
     * @ORM\ManyToOne(targetEntity="Size", inversedBy="barcode")
     * @ORM\JoinColumn(name="size", referencedColumnName="id")
     * @ORM\OrderBy({"sortOrder"="ASC"})
     * @Assert\NotBlank()
     */
    protected $size;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param mixed $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * @param mixed $shipment
     */
    public function setShipment($shipment)
    {
        $this->shipment = $shipment;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function __toString()
    {
        return $this->getBarcode();
    }

    /**
     * @return mixed
     */
    public function getScanned()
    {
        return $this->scanned;
    }

    /**
     * @param mixed $scanned
     */
    public function setScanned($scanned)
    {
        $this->scanned = $scanned;
    }

    /**
     * @return mixed
     */
    public function getCourier()
    {
        return $this->courier;
    }

    /**
     * @param mixed $courier
     */
    public function setCourier($courier)
    {
        $this->courier = $courier;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }


}
