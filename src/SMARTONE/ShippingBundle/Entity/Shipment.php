<?php

namespace SMARTONE\ShippingBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Shipments Entity
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Shipment
{
    public function __construct()
    {
        $this->barcodes = new ArrayCollection();
        $this->completed = false;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $docNo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $finishedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $completeAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $completed;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $sessionClosed;

    /**
     * @ORM\ManyToOne(targetEntity="Courier", inversedBy="shipment")
     * @ORM\JoinColumn(name="courier", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $courier;

    /**
     * @ORM\ManyToOne(targetEntity="Brand", inversedBy="shipment")
     * @ORM\JoinColumn(name="brand", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $brand;

    /**
     * @ORM\OneToMany(targetEntity="Barcode", mappedBy="shipment", cascade={"persist","remove"}) 
     */
    protected $barcodes;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function addBarcode(Barcode $barcode)
    {
        if (!$this->barcodes->contains($barcode)) {
            $barcode->setShipment($this);
            $this->barcodes->add($barcode);
        }

        return $this->barcodes;
    }

    public function removeBarcode(Barcode $barcode)
    {
        if ($this->barcodes->contains($barcode)) {
            $this->barcodes->removeElement($barcode);
        }

        return $this->barcodes;
    }

    /**
     * @return mixed
     */
    public function getBarcodes()
    {
        return $this->barcodes;
    }

    /**
     * @return mixed
     */
    public function getBarcodesComplete()
    {
        $count = 0;
        /** @var Barcode $barcode */
        foreach ($this->getBarcodes() as $barcode) {
            if($barcode->getScanned()) {
                $count++;
            }
        }

        if($count >= count($this->getBarcodes())) {
            return true;
        }

        return false;
    }

    /**
     * @param mixed $barcodes
     */
    public function setBarcodes($barcodes)
    {
        $this->barcodes = $barcodes;
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
     * @return mixed
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * @param mixed $finishedAt
     */
    public function setFinishedAt($finishedAt)
    {
        $this->finishedAt = $finishedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getSessionClosed()
    {
        return $this->sessionClosed;
    }

    /**
     * @param mixed $sessionClosed
     */
    public function setSessionClosed($sessionClosed)
    {
        $this->sessionClosed = $sessionClosed;
    }

    /**
     * @return mixed
     */
    public function getDocNo()
    {
        return $this->docNo;
    }

    /**
     * @param mixed $docNo
     */
    public function setDocNo($docNo)
    {
        $this->docNo = $docNo;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getCompleteAt()
    {
        return $this->completeAt;
    }

    /**
     * @param mixed $completeAt
     */
    public function setCompleteAt($completeAt)
    {
        $this->completeAt = $completeAt;
    }

    /**
     * @return mixed
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * @param mixed $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }
}
