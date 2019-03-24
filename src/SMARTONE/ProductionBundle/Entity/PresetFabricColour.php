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
class PresetFabricColour
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
     * @ORM\ManyToOne(targetEntity="SMARTONE\ShippingBundle\Entity\Brand", inversedBy="presetFabricColour")
     * @ORM\JoinColumn(name="brand", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $brand;

    /**
     * @ORM\ManyToMany(targetEntity="SMARTONE\ProductionBundle\Entity\FabricColour")
     * @ORM\JoinColumn(name="fabric_colour", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $fabricColour;

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
}
