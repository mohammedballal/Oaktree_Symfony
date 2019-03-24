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
class ProductionItemMattress
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
    protected $mattressModel;

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
    protected $mattressConfig;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $firmness;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $foam;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $springCount;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $colour;

    /**
     * @ORM\Column(type="boolean", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $tufted;

    /**
     * @ORM\Column(type="boolean", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $massage;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $quilted;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $coverType;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $mattressLabel;

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
    public function getFirmness()
    {
        return $this->firmness;
    }

    /**
     * @param mixed $firmness
     */
    public function setFirmness($firmness)
    {
        $this->firmness = $firmness;
    }

    /**
     * @return mixed
     */
    public function getFoam()
    {
        return $this->foam;
    }

    /**
     * @param mixed $foam
     */
    public function setFoam($foam)
    {
        $this->foam = $foam;
    }

    /**
     * @return mixed
     */
    public function getSpringCount()
    {
        return $this->springCount;
    }

    /**
     * @param mixed $springCount
     */
    public function setSpringCount($springCount)
    {
        $this->springCount = $springCount;
    }

    /**
     * @return mixed
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * @param mixed $colour
     */
    public function setColour($colour)
    {
        $this->colour = $colour;
    }

    /**
     * @return mixed
     */
    public function getTufted()
    {
        return $this->tufted;
    }

    /**
     * @param mixed $tufted
     */
    public function setTufted($tufted)
    {
        $this->tufted = $tufted;
    }

    /**
     * @return mixed
     */
    public function getMassage()
    {
        return $this->massage;
    }

    /**
     * @param mixed $massage
     */
    public function setMassage($massage)
    {
        $this->massage = $massage;
    }

    /**
     * @return mixed
     */
    public function getQuilted()
    {
        return $this->quilted;
    }

    /**
     * @param mixed $quilted
     */
    public function setQuilted($quilted)
    {
        $this->quilted = $quilted;
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
