<?php

namespace SMARTONE\SaleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Answer
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
     * @ORM\Column(type="integer", nullable=true, unique=true)
     * @Assert\NotBlank()
     */
    protected $number;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank()
     */
    protected $text;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank()
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="SaleQuestion", mappedBy="answer") 
     */
    protected $saleQuestion;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    public function __toString()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    public function getTypeText()
    {
        $a = array(
            1   => 'Sales Order No',
            2   => 'Customer Name',
            3   => 'In Production',
            4   => 'To Be Completed By',
            5   => 'Production Complete',
            6   => 'Sales Paperwork',
            7   => 'Vehicle Assigned',
            8   => 'Loaded',
            9   => 'Mark As Complete',
            10  => 'Delivery Day',
            11  => 'Other'
        );

        return $a[$this->type];
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getSaleQuestion()
    {
        return $this->saleQuestion;
    }

    /**
     * @param mixed $saleQuestion
     */
    public function setSaleQuestion($saleQuestion)
    {
        $this->saleQuestion = $saleQuestion;
    }


}
