<?php

namespace SMARTONE\OrderBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Shipments Entity
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class DocOrder
{

    const Doc_New = 0;
    const Doc_In_Production = 1;
    const Doc_Production_Complete = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $docNo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $time;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $vehicleReg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $bookingRef;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $docStatus = 0;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $viewManifest;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ShippingBundle\Entity\Brand")
     * @ORM\JoinColumn(name="brand", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $brand;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $deliveryScheduleDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $deliveryScheduleDay;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\OrderBundle\Entity\OrderAddress")
     * @ORM\JoinColumn(name="order_address", referencedColumnName="id")
     */
    protected $orderAddress;

    /**
     * @ORM\OneToMany(targetEntity="SMARTONE\OrderBundle\Entity\SaleOrder", mappedBy="docOrder") 
     * @ORM\OrderBy({"orderReceiveDate"="ASC"})
     */
    protected $saleOrder;

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
     * @return mixed
     */
    public function getDocStatus()
    {
        return $this->docStatus;
    }

    /**
     * @return string
     */
    public function getDocStatusMsg()
    {
        switch ($this->docStatus) {
            case self::Doc_New:
                return 'New';
            case self::Doc_In_Production:
                return 'In Production';
            case self::Doc_Production_Complete:
                return 'Production Complete';
            default:
                return 'New';
        }
    }

    /**
     * @param mixed $docStatus
     */
    public function setDocStatus($docStatus)
    {
        $this->docStatus = $docStatus;
    }

    /**
     * @return mixed
     */
    public function getSaleOrder()
    {
        return $this->saleOrder;
    }

    /**
     * @param mixed $saleOrder
     */
    public function setSaleOrder($saleOrder)
    {
        $this->saleOrder = $saleOrder;
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

    /**
     * @return mixed
     */
    public function getOrderAddress()
    {
        return $this->orderAddress;
    }

    /**
     * @param mixed $orderAddress
     */
    public function setOrderAddress($orderAddress)
    {
        $this->orderAddress = $orderAddress;
    }

    /**
     * @return mixed
     */
    public function getDeliveryScheduleDate()
    {
        return $this->deliveryScheduleDate;
    }

    /**
     * @param mixed $deliveryScheduleDate
     */
    public function setDeliveryScheduleDate($deliveryScheduleDate)
    {
        $this->deliveryScheduleDate = $deliveryScheduleDate;
    }

    /**
     * @return mixed
     */
    public function getDeliveryScheduleDay()
    {
        return $this->deliveryScheduleDay;
    }

    /**
     * @param mixed $deliveryScheduleDay
     */
    public function setDeliveryScheduleDay($deliveryScheduleDay)
    {
        $this->deliveryScheduleDay = $deliveryScheduleDay;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $path;

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    private $temp;

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {


        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file) {
            unlink($file);
        }
    }

    public function __toString()
    {
        return (string)$this->docNo;
    }

    public function getTotalItems()
    {
        $count = 0;
        /** @var SaleOrder $order */
        foreach ($this->saleOrder as $order) {
            $count += $order->getItems();
        }

        return $count;
    }

    /**
     * @return mixed
     */
    public function getViewManifest()
    {
        return $this->viewManifest;
    }

    /**
     * @param mixed $viewManifest
     */
    public function setViewManifest($viewManifest)
    {
        $this->viewManifest = $viewManifest;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getVehicleReg()
    {
        return $this->vehicleReg;
    }

    /**
     * @param mixed $vehicleReg
     */
    public function setVehicleReg($vehicleReg)
    {
        $this->vehicleReg = $vehicleReg;
    }

    /**
     * @return mixed
     */
    public function getBookingRef()
    {
        return $this->bookingRef;
    }

    /**
     * @param mixed $bookingRef
     */
    public function setBookingRef($bookingRef)
    {
        $this->bookingRef = $bookingRef;
    }
}
