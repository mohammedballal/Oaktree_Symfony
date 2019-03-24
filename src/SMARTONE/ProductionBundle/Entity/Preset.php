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
class Preset
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
     * @ORM\ManyToOne(targetEntity="SMARTONE\ShippingBundle\Entity\Brand", inversedBy="preset")
     * @ORM\JoinColumn(name="brand", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $brand;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\Badge")
     * @ORM\JoinColumn(name="badge", referencedColumnName="id")
     */
    protected $badge;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\Feet")
     * @ORM\JoinColumn(name="feet", referencedColumnName="id")
     */
    protected $feet;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\BedAction")
     * @ORM\JoinColumn(name="bed_action", referencedColumnName="id")
     */
    protected $bedAction;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     * @Assert\NotBlank()
     */
    protected $comment;

    /**
     * @ORM\ManyToOne(targetEntity="SMARTONE\ProductionBundle\Entity\EndBar")
     * @ORM\JoinColumn(name="end_bar", referencedColumnName="id")
     */
    protected $endBar;

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
}