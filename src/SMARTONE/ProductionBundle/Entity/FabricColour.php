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
class FabricColour
{

    CONST base = 0;
    CONST mattress = 1;
    CONST baseMattress = 2;
    CONST headboard = 3;
    CONST bedstead = 4;
    CONST notMattress = 5;
    CONST all = 6;

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
    protected $colourName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $colourCategory;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $fabricFor;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank()
     */
    protected $sortOrder;

    /**
     * @ORM\OneToMany(targetEntity="SMARTONE\ProductionBundle\Entity\Mattress", mappedBy="coverType") 
     */
    protected $mattress;


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
    public function getColourName()
    {
        return $this->colourName;
    }

    /**
     * @param mixed $colourName
     */
    public function setColourName($colourName)
    {
        $this->colourName = $colourName;
    }

    /**
     * @return mixed
     */
    public function getFabricFor()
    {
        return $this->fabricFor;
    }

    /**
     * @param mixed $fabricFor
     */
    public function setFabricFor($fabricFor)
    {
        $this->fabricFor = $fabricFor;
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
    public function getColourCategory()
    {
        return $this->colourCategory;
    }

    /**
     * @param mixed $colourCategory
     */
    public function setColourCategory($colourCategory)
    {
        $this->colourCategory = $colourCategory;
    }

    public function __toString()
    {
        return $this->colourName.' ('.$this->colourCategory.')';
    }


}
