<?php

namespace SMARTONE\ProductionBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sizes
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BaseCategory
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
    protected $baseCategoryName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseCategoryType;

    /**
     * @ORM\OneToMany(targetEntity="Base", mappedBy="baseCategory") 
     */
    protected $base;

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
    public function getBaseCategoryType()
    {
        return $this->baseCategoryType;
    }

    /**
     * @param mixed $baseCategoryType
     */
    public function setBaseCategoryType($baseCategoryType)
    {
        $this->baseCategoryType = $baseCategoryType;
    }

    /**
     * @return mixed
     */
    public function getBaseCategoryName()
    {
        return $this->baseCategoryName;
    }

    /**
     * @param mixed $baseCategoryName
     */
    public function setBaseCategoryName($baseCategoryName)
    {
        $this->baseCategoryName = $baseCategoryName;
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
        return $this->baseCategoryType .' '.$this->baseCategoryName ;
    }


}