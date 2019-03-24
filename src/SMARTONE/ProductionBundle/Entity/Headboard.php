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
class Headboard
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
    protected $headboardStyle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    protected $prefixComment;

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
    public function getHeadboardStyle()
    {
        return $this->headboardStyle;
    }

    /**
     * @param mixed $headboardStyle
     */
    public function setHeadboardStyle($headboardStyle)
    {
        $this->headboardStyle = $headboardStyle;
    }

    /**
     * @return mixed
     */
    public function getPrefixComment()
    {
        return $this->prefixComment;
    }

    /**
     * @param mixed $prefixComment
     */
    public function setPrefixComment($prefixComment)
    {
        $this->prefixComment = $prefixComment;
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
        return $this->headboardStyle;
    }


}
