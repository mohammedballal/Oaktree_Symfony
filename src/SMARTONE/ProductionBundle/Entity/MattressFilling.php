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
class MattressFilling
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
    protected $fillingName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank()
     */
    protected $sortOrder;

    /**
     * @ORM\OneToMany(targetEntity="Mattress", mappedBy="mattressFilling") 
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
    public function getFillingName()
    {
        return $this->fillingName;
    }

    /**
     * @param mixed $fillingName
     */
    public function setFillingName($fillingName)
    {
        $this->fillingName = $fillingName;
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
        return $this->fillingName;
    }
}
