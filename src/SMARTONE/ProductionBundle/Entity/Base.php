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
class Base
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
     * @ORM\ManyToOne(targetEntity="BaseCategory", inversedBy="base")
     * @ORM\JoinColumn(name="base_category", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $baseCategory;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseType;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseConfig;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $baseDepth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank()
     */
    protected $noBases;

    /**
     * @ORM\Column(type="integer", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $maxDrawers;

    /**
     * @ORM\Column(type="boolean", length=100, nullable=true)
     */
    protected $isDrawer;

    /**
     * @ORM\Column(type="boolean", length=100, nullable=true)
     */
    protected $mattressInPack;

    /**
     * @ORM\Column(type="boolean", length=100, nullable=true)
     */
    protected $actionIncluded;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank()
     */
    protected $noAction;

    /**
     * @ORM\ManyToMany(targetEntity="SMARTONE\ProductionBundle\Entity\Feet")
     * @ORM\JoinColumn(name="feet", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $feet;

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
    public function getMaxDrawers()
    {
        return $this->maxDrawers;
    }

    /**
     * @param mixed $maxDrawers
     */
    public function setMaxDrawers($maxDrawers)
    {
        $this->maxDrawers = $maxDrawers;
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
    public function getNoAction()
    {
        return $this->noAction;
    }

    /**
     * @param mixed $noAction
     */
    public function setNoAction($noAction)
    {
        $this->noAction = $noAction;
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
    public function getActionIncluded()
    {
        return $this->actionIncluded;
    }

    /**
     * @param mixed $actionIncluded
     */
    public function setActionIncluded($actionIncluded)
    {
        $this->actionIncluded = $actionIncluded;
    }

    /**
     * @return mixed
     */
    public function getNoBases()
    {
        return $this->noBases;
    }

    /**
     * @param mixed $noBases
     */
    public function setNoBases($noBases)
    {
        $this->noBases = $noBases;
    }

    /**
     * @return mixed
     */
    public function getMattressInPack()
    {
        return $this->mattressInPack;
    }

    /**
     * @param mixed $mattressInPack
     */
    public function setMattressInPack($mattressInPack)
    {
        $this->mattressInPack = $mattressInPack;
    }

    public function __toString()
    {
        return $this->baseType;
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
}
