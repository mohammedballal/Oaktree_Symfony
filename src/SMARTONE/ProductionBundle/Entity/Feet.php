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
class Feet
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
    protected $feetName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $feetSize;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $feetColour;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $feetType;

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
    public function getFeetName()
    {
        return $this->feetName;
    }

    /**
     * @param mixed $feetName
     */
    public function setFeetName($feetName)
    {
        $this->feetName = $feetName;
    }

    /**
     * @return mixed
     */
    public function getFeetSize()
    {
        return $this->feetSize;
    }

    /**
     * @param mixed $feetSize
     */
    public function setFeetSize($feetSize)
    {
        $this->feetSize = $feetSize;
    }

    /**
     * @return mixed
     */
    public function getFeetColour()
    {
        return $this->feetColour;
    }

    /**
     * @param mixed $feetColour
     */
    public function setFeetColour($feetColour)
    {
        $this->feetColour = $feetColour;
    }

    /**
     * @return mixed
     */
    public function getFeetType()
    {
        return $this->feetType;
    }

    /**
     * @param mixed $feetType
     */
    public function setFeetType($feetType)
    {
        $this->feetType = $feetType;
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

    public function __toString()
    {
        return $this->feetName;
    }


}
