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
class ProductionItemBase
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
    protected $qty;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $headboard;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $headboardSize;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $headboardStyle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $headboardComment;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $headboardColour;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $headboardFixing;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseCode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $width;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $length;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $depth;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseUpgrade;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseType;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseComment;

    /**
     * @ORM\Column(type="integer", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $noOfDrawers;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $drawerConfig;

    /**
     * @ORM\Column(type="boolean", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $isDrawer;

    /**
     * @ORM\Column(type="boolean", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $isBedstead;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $action;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $actionType;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $actionUpgrade;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $actionHandset;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $fabricColour;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $endBar;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $feet;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $badge;

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
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param mixed $qty
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    /**
     * @return mixed
     */
    public function getBaseName()
    {
        return $this->baseName;
    }

    /**
     * @param mixed $baseName
     */
    public function setBaseName($baseName)
    {
        $this->baseName = $baseName;
    }

    /**
     * @return mixed
     */
    public function getHeadboard()
    {
        return $this->headboard;
    }

    /**
     * @param mixed $headboard
     */
    public function setHeadboard($headboard)
    {
        $this->headboard = $headboard;
    }

    /**
     * @return mixed
     */
    public function getHeadboardSize()
    {
        return $this->headboardSize;
    }

    /**
     * @param mixed $headboardSize
     */
    public function setHeadboardSize($headboardSize)
    {
        $this->headboardSize = $headboardSize;
    }

    /**
     * @return mixed
     */
    public function getHeadboardStyle()
    {
        return $this->headboardStyle;
    }

    /**
     * @param mixed $headboardStyle
     */
    public function setHeadboardStyle($headboardStyle)
    {
        $this->headboardStyle = $headboardStyle;
    }

    /**
     * @return mixed
     */
    public function getHeadboardComment()
    {
        return $this->headboardComment;
    }

    /**
     * @param mixed $headboardComment
     */
    public function setHeadboardComment($headboardComment)
    {
        $this->headboardComment = $headboardComment;
    }

    /**
     * @return mixed
     */
    public function getHeadboardColour()
    {
        return $this->headboardColour;
    }

    /**
     * @param mixed $headboardColour
     */
    public function setHeadboardColour($headboardColour)
    {
        $this->headboardColour = $headboardColour;
    }

    /**
     * @return mixed
     */
    public function getHeadboardFixing()
    {
        return $this->headboardFixing;
    }

    /**
     * @param mixed $headboardFixing
     */
    public function setHeadboardFixing($headboardFixing)
    {
        $this->headboardFixing = $headboardFixing;
    }

    /**
     * @return mixed
     */
    public function getBaseCode()
    {
        return $this->baseCode;
    }

    /**
     * @param mixed $baseCode
     */
    public function setBaseCode($baseCode)
    {
        $this->baseCode = $baseCode;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
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
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param mixed $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    /**
     * @return mixed
     */
    public function getBaseUpgrade()
    {
        return $this->baseUpgrade;
    }

    /**
     * @param mixed $baseUpgrade
     */
    public function setBaseUpgrade($baseUpgrade)
    {
        $this->baseUpgrade = $baseUpgrade;
    }

    /**
     * @return mixed
     */
    public function getBaseType()
    {
        return $this->baseType;
    }

    /**
     * @param mixed $baseType
     */
    public function setBaseType($baseType)
    {
        $this->baseType = $baseType;
    }

    /**
     * @return mixed
     */
    public function getBaseComment()
    {
        return $this->baseComment;
    }

    /**
     * @param mixed $baseComment
     */
    public function setBaseComment($baseComment)
    {
        $this->baseComment = $baseComment;
    }

    /**
     * @return mixed
     */
    public function getNoOfDrawers()
    {
        return $this->noOfDrawers;
    }

    /**
     * @param mixed $noOfDrawers
     */
    public function setNoOfDrawers($noOfDrawers)
    {
        $this->noOfDrawers = $noOfDrawers;
    }

    /**
     * @return mixed
     */
    public function getDrawerConfig()
    {
        return $this->drawerConfig;
    }

    /**
     * @param mixed $drawerConfig
     */
    public function setDrawerConfig($drawerConfig)
    {
        $this->drawerConfig = $drawerConfig;
    }

    /**
     * @return mixed
     */
    public function getisDrawer()
    {
        return $this->isDrawer;
    }

    /**
     * @param mixed $isDrawer
     */
    public function setIsDrawer($isDrawer)
    {
        $this->isDrawer = $isDrawer;
    }

    /**
     * @return mixed
     */
    public function getisBedstead()
    {
        return $this->isBedstead;
    }

    /**
     * @param mixed $isBedstead
     */
    public function setIsBedstead($isBedstead)
    {
        $this->isBedstead = $isBedstead;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
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
    public function getActionUpgrade()
    {
        return $this->actionUpgrade;
    }

    /**
     * @param mixed $actionUpgrade
     */
    public function setActionUpgrade($actionUpgrade)
    {
        $this->actionUpgrade = $actionUpgrade;
    }

    /**
     * @return mixed
     */
    public function getActionHandset()
    {
        return $this->actionHandset;
    }

    /**
     * @param mixed $actionHandset
     */
    public function setActionHandset($actionHandset)
    {
        $this->actionHandset = $actionHandset;
    }

    /**
     * @return mixed
     */
    public function getFabricColour()
    {
        return $this->fabricColour;
    }

    /**
     * @param mixed $fabricColour
     */
    public function setFabricColour($fabricColour)
    {
        $this->fabricColour = $fabricColour;
    }

    /**
     * @return mixed
     */
    public function getEndBar()
    {
        return $this->endBar;
    }

    /**
     * @param mixed $endBar
     */
    public function setEndBar($endBar)
    {
        $this->endBar = $endBar;
    }

    /**
     * @return mixed
     */
    public function getFeet()
    {
        return $this->feet;
    }

    /**
     * @param mixed $feet
     */
    public function setFeet($feet)
    {
        $this->feet = $feet;
    }

    /**
     * @return mixed
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @param mixed $badge
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
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
}
