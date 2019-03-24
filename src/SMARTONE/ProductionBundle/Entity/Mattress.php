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
class Mattress
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
     * @ORM\ManyToOne(targetEntity="SMARTONE\ShippingBundle\Entity\Brand", inversedBy="mattress")
     * @ORM\JoinColumn(name="brand", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $brand;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $mattressModel;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $mattesDepth;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $mattressType;

    /**
     * @ORM\ManyToOne(targetEntity="MattressFilling", inversedBy="mattress")
     * @ORM\JoinColumn(name="mattress_filling", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $mattressFilling;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $mattressStyle;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\MattressQuiltDesign", inversedBy="mattress")
     * @ORM\JoinColumn(name="mattress_quilt_design", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $mattressQuiltDesign;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $mattressFinish;

    /**
     * @ORM\Column(type="boolean", length=100, nullable=true)
     */
    protected $massageAvailable;

    /**
     * @ORM\ManyToOne(targetEntity="FabricColour", inversedBy="mattress")
     * @ORM\JoinColumn(name="cover_type", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $coverType;

    /**
     * @ORM\ManyToOne(targetEntity="MattressLabel", inversedBy="mattress")
     * @ORM\JoinColumn(name="mattress_label", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $mattressLabel;

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
    public function getMattressModel()
    {
        return $this->mattressModel;
    }

    /**
     * @param mixed $mattressModel
     */
    public function setMattressModel($mattressModel)
    {
        $this->mattressModel = $mattressModel;
    }

    /**
     * @return mixed
     */
    public function getMattesDepth()
    {
        return $this->mattesDepth;
    }

    /**
     * @param mixed $mattesDepth
     */
    public function setMattesDepth($mattesDepth)
    {
        $this->mattesDepth = $mattesDepth;
    }

    /**
     * @return mixed
     */
    public function getMattressType()
    {
        return $this->mattressType;
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
     * @param mixed $mattressType
     */
    public function setMattressType($mattressType)
    {
        $this->mattressType = $mattressType;
    }

    /**
     * @return mixed
     */
    public function getMattressStyle()
    {
        return $this->mattressStyle;
    }

    /**
     * @param mixed $mattressStyle
     */
    public function setMattressStyle($mattressStyle)
    {
        $this->mattressStyle = $mattressStyle;
    }

    /**
     * @return mixed
     */
    public function getMattressQuiltDesign()
    {
        return $this->mattressQuiltDesign;
    }

    /**
     * @param mixed $mattressQuiltDesign
     */
    public function setMattressQuiltDesign($mattressQuiltDesign)
    {
        $this->mattressQuiltDesign = $mattressQuiltDesign;
    }

    /**
     * @return mixed
     */
    public function getMassageAvailable()
    {
        return $this->massageAvailable;
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
     * @param mixed $massageAvailable
     */
    public function setMassageAvailable($massageAvailable)
    {
        $this->massageAvailable = $massageAvailable;
    }

    /**
     * @return mixed
     */
    public function getCoverType()
    {
        return $this->coverType;
    }

    /**
     * @param mixed $coverType
     */
    public function setCoverType($coverType)
    {
        $this->coverType = $coverType;
    }

    /**
     * @return mixed
     */
    public function getMattressLabel()
    {
        return $this->mattressLabel;
    }

    /**
     * @param mixed $mattressLabel
     */
    public function setMattressLabel($mattressLabel)
    {
        $this->mattressLabel = $mattressLabel;
    }

    /**
     * @return mixed
     */
    public function getMattressFinish()
    {
        return $this->mattressFinish;
    }

    /**
     * @param mixed $mattressFinish
     */
    public function setMattressFinish($mattressFinish)
    {
        $this->mattressFinish = $mattressFinish;
    }

    public function __toString()
    {
        return $this->mattressModel;
    }


}
