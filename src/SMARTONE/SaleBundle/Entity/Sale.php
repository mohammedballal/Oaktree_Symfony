<?php

namespace SMARTONE\SaleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sizes
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Sale
{
    public function __construct()
    {
        $this->complete = false;
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
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $saleOrderNo;

    /**
     * @ORM\Column(type="boolean",  nullable=true)
     */
    protected $inProduction;

    /**
     * @ORM\Column(type="boolean",  nullable=true)
     */
    protected $partProduction;

    /**
     * @ORM\Column(type="boolean",  nullable=true)
     */
    protected $fullProduction;

    /**
     * @ORM\Column(type="datetime",  nullable=true)
     */
    protected $inProductionDate;

    /**
     * @ORM\Column(type="date",  nullable=true)
     */
    protected $productionCompleteByDate;

    /**
     * @ORM\Column(type="date",  nullable=true)
     */
    protected $deliveryDayDate;

    /**
     * @ORM\Column(type="boolean",  nullable=true)
     */
    protected $productionComplete;

    /**
     * @ORM\Column(type="boolean",  nullable=true)
     */
    protected $deliveryDay;

    /**
     * @ORM\Column(type="datetime",  nullable=true)
     */
    protected $productionCompleteDate;

    /**
     * @ORM\Column(type="boolean",  nullable=true)
     */
    protected $salesPaperworkComplete;


    /**
     * @ORM\Column(type="datetime",  nullable=true)
     */
    protected $salesPaperworkCompleteDate;

    /**
     * @ORM\Column(type="boolean",  nullable=true)
     */
    protected $vehicleAssigned;

    /**
     * @ORM\Column(type="datetime",  nullable=true)
     */
    protected $vehicleAssignedDate;

    /**
     * @ORM\ManyToOne(targetEntity="Vehicle", inversedBy="sale")
     * @ORM\JoinColumn(name="vehicle", referencedColumnName="id")
     */
    protected $vehicle;

    /**
     * @ORM\Column(type="boolean",  nullable=true)
     */
    protected $loaded;

    /**
     * @ORM\Column(type="datetime",  nullable=true)
     */
    protected $loadedDate;

    /**
     * @ORM\Column(type="integer", length=10, nullable=true)
     */
    protected $complete;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="sale")
     * @ORM\JoinColumn(name="customer", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $customer;

    /**
     * @ORM\OneToMany(targetEntity="SaleQuestion", mappedBy="sale") 
     */
    protected $saleQuestion;

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
    public function getSaleOrderNo()
    {
        return $this->saleOrderNo;
    }

    /**
     * @param mixed $saleOrderNo
     */
    public function setSaleOrderNo($saleOrderNo)
    {
        $this->saleOrderNo = $saleOrderNo;
    }

    /**
     * @return mixed
     */
    public function getInProduction()
    {
        return $this->inProduction;
    }

    /**
     * @param mixed $inProduction
     */
    public function setInProduction($inProduction)
    {
        $this->inProduction = $inProduction;
    }

    /**
     * @return mixed
     */
    public function getInProductionDate()
    {
        return $this->inProductionDate;
    }

    /**
     * @param mixed $inProductionDate
     */
    public function setInProductionDate($inProductionDate)
    {
        $this->inProductionDate = $inProductionDate;
    }

    /**
     * @return mixed
     */
    public function getProductionComplete()
    {
        return $this->productionComplete;
    }

    /**
     * @param mixed $productionComplete
     */
    public function setProductionComplete($productionComplete)
    {
        $this->productionComplete = $productionComplete;
    }

    /**
     * @return mixed
     */
    public function getProductionCompleteDate()
    {
        return $this->productionCompleteDate;
    }

    /**
     * @param mixed $productionCompleteDate
     */
    public function setProductionCompleteDate($productionCompleteDate)
    {
        $this->productionCompleteDate = $productionCompleteDate;
    }

    /**
     * @return mixed
     */
    public function getSalesPaperworkComplete()
    {
        return $this->salesPaperworkComplete;
    }

    /**
     * @param mixed $salesPaperworkComplete
     */
    public function setSalesPaperworkComplete($salesPaperworkComplete)
    {
        $this->salesPaperworkComplete = $salesPaperworkComplete;
    }

    /**
     * @return mixed
     */
    public function getSalesPaperworkCompleteDate()
    {
        return $this->salesPaperworkCompleteDate;
    }

    /**
     * @param mixed $salesPaperworkCompleteDate
     */
    public function setSalesPaperworkCompleteDate($salesPaperworkCompleteDate)
    {
        $this->salesPaperworkCompleteDate = $salesPaperworkCompleteDate;
    }

    /**
     * @return mixed
     */
    public function getVehicleAssigned()
    {
        return $this->vehicleAssigned;
    }

    /**
     * @param mixed $vehicleAssigned
     */
    public function setVehicleAssigned($vehicleAssigned)
    {
        $this->vehicleAssigned = $vehicleAssigned;
    }

    /**
     * @return mixed
     */
    public function getVehicleAssignedDate()
    {
        return $this->vehicleAssignedDate;
    }

    /**
     * @param mixed $vehicleAssignedDate
     */
    public function setVehicleAssignedDate($vehicleAssignedDate)
    {
        $this->vehicleAssignedDate = $vehicleAssignedDate;
    }

    /**
     * @return mixed
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }

    /**
     * @param mixed $vehicle
     */
    public function setVehicle($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * @return mixed
     */
    public function getLoaded()
    {
        return $this->loaded;
    }

    /**
     * @param mixed $loaded
     */
    public function setLoaded($loaded)
    {
        $this->loaded = $loaded;
    }

    /**
     * @return mixed
     */
    public function getLoadedDate()
    {
        return $this->loadedDate;
    }

    /**
     * @param mixed $loadedDate
     */
    public function setLoadedDate($loadedDate)
    {
        $this->loadedDate = $loadedDate;
    }

    /**
     * @return mixed
     */
    public function getComplete()
    {
        return $this->complete;
    }

    /**
     * @param mixed $complete
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;
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
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getProductionCompleteByDate()
    {
        return $this->productionCompleteByDate;
    }

    /**
     * @param mixed $productionCompleteByDate
     */
    public function setProductionCompleteByDate($productionCompleteByDate)
    {
        $this->productionCompleteByDate = $productionCompleteByDate;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getPartProduction()
    {
        return $this->partProduction;
    }

    /**
     * @param mixed $partProduction
     */
    public function setPartProduction($partProduction)
    {
        $this->partProduction = $partProduction;
    }

    /**
     * @return mixed
     */
    public function getFullProduction()
    {
        return $this->fullProduction;
    }

    /**
     * @param mixed $fullProduction
     */
    public function setFullProduction($fullProduction)
    {
        $this->fullProduction = $fullProduction;
    }

    /**
     * @return mixed
     */
    public function getDeliveryDay()
    {
        return $this->deliveryDay;
    }

    /**
     * @param mixed $deliveryDay
     */
    public function setDeliveryDay($deliveryDay)
    {
        $this->deliveryDay = $deliveryDay;
    }

    /**
     * @return mixed
     */
    public function getDeliveryDayDate()
    {
        return $this->deliveryDayDate;
    }

    /**
     * @param mixed $deliveryDayDate
     */
    public function setDeliveryDayDate($deliveryDayDate)
    {
        $this->deliveryDayDate = $deliveryDayDate;
    }

    /**
     * @return mixed
     */
    public function getSaleQuestion()
    {
        return $this->saleQuestion;
    }

    /**
     * @param mixed $saleQuestion
     */
    public function setSaleQuestion($saleQuestion)
    {
        $this->saleQuestion = $saleQuestion;
    }
}
