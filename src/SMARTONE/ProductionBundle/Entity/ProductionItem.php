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
class ProductionItem
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
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $qty;

    /**
     * @ORM\ManyToOne(targetEntity="BaseCategory")
     * @ORM\JoinColumn(name="base_category", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $baseCategory;

    /**
     * @ORM\ManyToOne(targetEntity="Base")
     * @ORM\JoinColumn(name="base", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $base;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseWidth;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isMassage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseLength;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseDepth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseConfig;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $noDrawers;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    protected $accessoryDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    protected $mattressFirmness;

    /**
     * @ORM\Column(type="integer", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $accessoryQty;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $drawerConfig;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ShippingBundle\Entity\Brand")
     * @ORM\JoinColumn(name="brand", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $brand;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\Feet")
     * @ORM\JoinColumn(name="feet", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $feet;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\EndBar")
     * @ORM\JoinColumn(name="end_bar", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $endBar;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\Mattress")
     * @ORM\JoinColumn(name="mattress", referencedColumnName="id")
     */
    protected $mattress;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\MattressFilling")
     * @ORM\JoinColumn(name="mattress_filling", referencedColumnName="id")
     */
    protected $mattressFilling;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\Headboard")
     * @ORM\JoinColumn(name="headboard", referencedColumnName="id")
     */
    protected $headboard;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    protected $comment;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    protected $customComment;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    protected $mattressComment;

    /**
     * @ORM\Column(type="boolean", length=255, nullable=true)
     */
    protected $singleMattress;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $mattressCustomise;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $bedStead;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $headboardSize;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $headboardType;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    protected $headboardComment;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\BedAction")
     * @ORM\JoinColumn(name="bed_action", referencedColumnName="id")
     */
    protected $bedAction;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $splitBedAction;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\Handset")
     * @ORM\JoinColumn(name="handset", referencedColumnName="id")
     */
    protected $handset;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\Badge")
     * @ORM\JoinColumn(name="badge", referencedColumnName="id")
     */
    protected $badge;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\FabricColour")
     * @ORM\JoinColumn(name="fabric_colour", referencedColumnName="id")
     */
    protected $fabricColour;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\FabricColour")
     * @ORM\JoinColumn(name="mattress_fabric_colour", referencedColumnName="id")
     */
    protected $mattressFabricColour;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\MattressCover")
     * @ORM\JoinColumn(name="mattress_cover", referencedColumnName="id")
     */
    protected $mattressCover;

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
    public function getMattress()
    {
        return $this->mattress;
    }

    /**
     * @param mixed $mattress
     */
    public function setMattress($mattress)
    {
        $this->mattress = $mattress;
    }

    /**
     * @return mixed
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @param mixed $base
     */
    public function setBase($base)
    {
        $this->base = $base;
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
    public function getBedStead()
    {
        return $this->bedStead;
    }

    /**
     * @param mixed $bedStead
     */
    public function setBedStead($bedStead)
    {
        $this->bedStead = $bedStead;
    }

    /**
     * @return mixed
     */
    public function getBedAction()
    {
        return $this->bedAction;
    }

    /**
     * @param mixed $bedAction
     */
    public function setBedAction($bedAction)
    {
        $this->bedAction = $bedAction;
    }

    /**
     * @return mixed
     */
    public function getMattressCover()
    {
        return $this->mattressCover;
    }

    /**
     * @param mixed $mattressCover
     */
    public function setMattressCover($mattressCover)
    {
        $this->mattressCover = $mattressCover;
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
    public function getHandset()
    {
        return $this->handset;
    }

    /**
     * @param mixed $handset
     */
    public function setHandset($handset)
    {
        $this->handset = $handset;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
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
    public function getBaseWidth()
    {
        return $this->baseWidth;
    }

    /**
     * @param mixed $baseWidth
     */
    public function setBaseWidth($baseWidth)
    {
        $this->baseWidth = $baseWidth;
    }

    /**
     * @return mixed
     */
    public function getBaseLength()
    {
        return $this->baseLength;
    }

    /**
     * @param mixed $baseLength
     */
    public function setBaseLength($baseLength)
    {
        $this->baseLength = $baseLength;
    }

    /**
     * @return mixed
     */
    public function getBaseDepth()
    {
        return $this->baseDepth;
    }

    /**
     * @param mixed $baseDepth
     */
    public function setBaseDepth($baseDepth)
    {
        $this->baseDepth = $baseDepth;
    }

    /**
     * @return mixed
     */
    public function getBaseConfig()
    {
        return $this->baseConfig;
    }

    /**
     * @param mixed $baseConfig
     */
    public function setBaseConfig($baseConfig)
    {
        $this->baseConfig = $baseConfig;
    }

    /**
     * @return mixed
     */
    public function getNoDrawers()
    {
        return $this->noDrawers;
    }

    /**
     * @param mixed $noDrawers
     */
    public function setNoDrawers($noDrawers)
    {
        $this->noDrawers = $noDrawers;
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
    public function getSplitBedAction()
    {
        return $this->splitBedAction;
    }

    /**
     * @param mixed $splitBedAction
     */
    public function setSplitBedAction($splitBedAction)
    {
        $this->splitBedAction = $splitBedAction;
    }

    /**
     * @return mixed
     */
    public function getBaseCategory()
    {
        return $this->baseCategory;
    }

    /**
     * @param mixed $baseCategory
     */
    public function setBaseCategory($baseCategory)
    {
        $this->baseCategory = $baseCategory;
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
    public function getSingleMattress()
    {
        return $this->singleMattress;
    }

    /**
     * @param mixed $singleMattress
     */
    public function setSingleMattress($singleMattress)
    {
        $this->singleMattress = $singleMattress;
    }

    /**
     * @return mixed
     */
    public function getCustomComment()
    {
        return $this->customComment;
    }

    /**
     * @param mixed $customComment
     */
    public function setCustomComment($customComment)
    {
        $this->customComment = $customComment;
    }

    /**
     * @return mixed
     */
    public function getMattressFilling()
    {
        return $this->mattressFilling;
    }

    /**
     * @param mixed $mattressFilling
     */
    public function setMattressFilling($mattressFilling)
    {
        $this->mattressFilling = $mattressFilling;
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
    public function getMattressComment()
    {
        return $this->mattressComment;
    }

    /**
     * @param mixed $mattressComment
     */
    public function setMattressComment($mattressComment)
    {
        $this->mattressComment = $mattressComment;
    }

    /**
     * @return mixed
     */
    public function getMattressFabricColour()
    {
        return $this->mattressFabricColour;
    }

    /**
     * @param mixed $mattressFabricColour
     */
    public function setMattressFabricColour($mattressFabricColour)
    {
        $this->mattressFabricColour = $mattressFabricColour;
    }

    /**
     * @return mixed
     */
    public function getMattressCustomise()
    {
        return $this->mattressCustomise;
    }

    /**
     * @param mixed $mattressCustomise
     */
    public function setMattressCustomise($mattressCustomise)
    {
        $this->mattressCustomise = $mattressCustomise;
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
    public function getHeadboardType()
    {
        return $this->headboardType;
    }

    /**
     * @param mixed $headboardType
     */
    public function setHeadboardType($headboardType)
    {
        $this->headboardType = $headboardType;
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
    public function getAccessoryDescription()
    {
        return $this->accessoryDescription;
    }

    /**
     * @param mixed $accessoryDescription
     */
    public function setAccessoryDescription($accessoryDescription)
    {
        $this->accessoryDescription = $accessoryDescription;
    }

    /**
     * @return mixed
     */
    public function getAccessoryQty()
    {
        return $this->accessoryQty;
    }

    /**
     * @param mixed $accessoryQty
     */
    public function setAccessoryQty($accessoryQty)
    {
        $this->accessoryQty = $accessoryQty;
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
    public function getMattressFirmness()
    {
        return $this->mattressFirmness;
    }

    /**
     * @param mixed $mattressFirmness
     */
    public function setMattressFirmness($mattressFirmness)
    {
        $this->mattressFirmness = $mattressFirmness;
    }
}


