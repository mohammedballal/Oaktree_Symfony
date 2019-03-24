<?php

namespace SMARTONE\SaleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sale Questions
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class SaleQuestion
{
    public function __construct()
    {
        $this->complete = false;
    }


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Sale", inversedBy="saleQuestion")
     * @ORM\JoinColumn(name="sale", referencedColumnName="id")
     */
    protected $sale;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="saleQuestion")
     * @ORM\JoinColumn(name="question", referencedColumnName="id")
     * @Assert\NotBlank()
     */
    protected $question;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $complete;

    /**
     * @ORM\ManyToOne(targetEntity="Answer", inversedBy="saleQuestion")
     * @ORM\JoinColumn(name="answer", referencedColumnName="id")
     */
    protected $answer;

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
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * @param mixed $sale
     */
    public function setSale($sale)
    {
        $this->sale = $sale;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getComplete()
    {
        return $this->complete;
    }

    /**
     * @param mixed $complete
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }
}
