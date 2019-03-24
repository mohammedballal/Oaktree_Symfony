<?php

namespace SMARTONE\ProductionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sizes
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BedAction
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
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $actionName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $actionType;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isMassage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isSplittable;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isHandsetUpgradable;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\Handset")
     * @ORM\JoinColumn(name="handset_type", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $handsetType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank()
     */
    protected $sortOrder;

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
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @param mixed $actionName
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    /**
     * @return mixed
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * @param mixed $actionType
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;
    }

    /**
     * @return mixed
     */
    public function getisMassage()
    {
        return $this->isMassage;
    }

    /**
     * @param mixed $isMassage
     */
    public function setIsMassage($isMassage)
    {
        $this->isMassage = $isMassage;
    }

    /**
     * @return mixed
     */
    public function getisSplittable()
    {
        return $this->isSplittable;
    }

    /**
     * @param mixed $isSplittable
     */
    public function setIsSplittable($isSplittable)
    {
        $this->isSplittable = $isSplittable;
    }

    /**
     * @return mixed
     */
    public function getHandsetType()
    {
        return $this->handsetType;
    }

    /**
     * @param mixed $handsetType
     */
    public function setHandsetType($handsetType)
    {
        $this->handsetType = $handsetType;
    }

    /**
     * @return mixed
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param mixed $sortOrder
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return mixed
     */
    public function getisHandsetUpgradable()
    {
        return $this->isHandsetUpgradable;
    }

    /**
     * @param mixed $isHandsetUpgradable
     */
    public function setIsHandsetUpgradable($isHandsetUpgradable)
    {
        $this->isHandsetUpgradable = $isHandsetUpgradable;
    }

    public function __toString()
    {
        return $this->actionName;
    }


}
