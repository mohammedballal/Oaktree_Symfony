<?php

namespace SMARTONE\OrderBundle\Entity;

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
class SaleOrder
{

    const Order_Start = 0;
    const Orders_Received_To_Process = 1;
    const Orders_Scheduled = 2;
    const Orders_Complete = 3;
    const Orders_On_Hold = 4;
    const Order_Cancelled = 5;

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
    protected $orderNo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $orderReceiveDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $orderStatus = 0;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $comments;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $items;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $cancelComment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $deliveryAddress;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $deliveryScheduleDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $deliveryScheduleDay;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $bookingRef;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ShippingBundle\Entity\Brand")
     * @ORM\JoinColumn(name="brand", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $brand;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\OrderBundle\Entity\DocOrder", inversedBy="saleOrder")
     * @ORM\JoinColumn(name="doc_order", referencedColumnName="id")
     */
    protected $docOrder;

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
    public function getOrderReceiveDate()
    {
        return $this->orderReceiveDate;
    }

    /**
     * @param mixed $orderReceiveDate
     */
    public function setOrderReceiveDate($orderReceiveDate)
    {
        $this->orderReceiveDate = $orderReceiveDate;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        switch ($this->orderStatus) {
            case self::Order_Start:
                return 'To Process';
            case self::Orders_Received_To_Process:
                return 'Order Received To Process';
            case self::Orders_Scheduled:
                return 'Order Scheduled';
            case self::Orders_Complete:
                return 'Complete';
            case self::Orders_On_Hold:
                return 'Order On Hold';
            case self::Order_Cancelled:
                return 'Order Cancelled';
            default:
                return 'To Process';
        }

    }

    /**
     * @param mixed $orderStatus
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * @return mixed
     */
    public function getOrderNo()
    {
        return $this->orderNo;
    }

    /**
     * @param mixed $orderNo
     */
    public function setOrderNo($orderNo)
    {
        $this->orderNo = $orderNo;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getCancelComment()
    {
        return $this->cancelComment;
    }

    /**
     * @param mixed $cancelComment
     */
    public function setCancelComment($cancelComment)
    {
        $this->cancelComment = $cancelComment;
    }

    /**
     * @return mixed
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param mixed $deliveryAddress
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
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

    /**
     * @return mixed
     */
    public function getDocOrder()
    {
        return $this->docOrder;
    }

    /**
     * @param mixed $docOrder
     */
    public function setDocOrder($docOrder)
    {
        $this->docOrder = $docOrder;
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
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }
}
