<?php

namespace Story\StoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Story
 *
 * @ORM\Table(name="story", indexes={@ORM\Index(name="p_id", columns={"p_id"})})
 * @ORM\Entity
 */
class Story
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="line", type="string", length=140, nullable=false)
     */
    private $line;

    /**
     * @var \Story\StoryBundle\Entity\Story
     *
     * @ORM\ManyToOne(targetEntity="Story\StoryBundle\Entity\Story")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="p_id", referencedColumnName="id")
     * })
     */
    private $p;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set line
     *
     * @param string $line
     * @return Story
     */
    public function setLine($line)
    {
        $this->line = $line;

        return $this;
    }

    /**
     * Get line
     *
     * @return string 
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Set p
     *
     * @param \Story\StoryBundle\Entity\Story $p
     * @return Story
     */
    public function setP(\Story\StoryBundle\Entity\Story $p = null)
    {
        $this->p = $p;

        return $this;
    }

    /**
     * Get p
     *
     * @return \Story\StoryBundle\Entity\Story 
     */
    public function getP()
    {
        return $this->p;
    }
}
