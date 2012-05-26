<?php
namespace SL\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity **/
class Test
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected   $id;

    /** @ORM\Column(type="datetime") **/
	protected	$start_date;

    /** @ORM\Column(type="datetime") **/
	protected	$stop_date;

    /** @ORM\Column **/
	protected	$title;

    /** @ORM\Column(type="text") **/
	protected	$corps;

	/**
	 * @ORM\ManyToMany(targetEntity="User")
	 */
	protected	$authors;

	/**
	 * @ORM\ManyToOne(targetEntity="Enterprise", inversedBy="tests")
	 */
	protected	$enterprise;

	public function	__construct()
	{
		$this->authors = new ArrayCollection();
	}

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Add authors
     *
     * @param SL\MainBundle\Entity\User $authors
     */
    public function addUser(\SL\MainBundle\Entity\User $authors)
    {
        $this->authors[] = $authors;
    }

    /**
     * Get authors
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set enterprise
     *
     * @param SL\MainBundle\Entity\Enterprise $enterprise
     */
    public function setEnterprise(\SL\MainBundle\Entity\Enterprise $enterprise)
    {
        $this->enterprise = $enterprise;
    }

    /**
     * Get enterprise
     *
     * @return SL\MainBundle\Entity\Enterprise 
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }

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
     * Set start_date
     *
     * @param datetime $startDate
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;
    }

    /**
     * Get start_date
     *
     * @return datetime 
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set stop_date
     *
     * @param datetime $stopDate
     */
    public function setStopDate($stopDate)
    {
        $this->stop_date = $stopDate;
    }

    /**
     * Get stop_date
     *
     * @return datetime 
     */
    public function getStopDate()
    {
        return $this->stop_date;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set corps
     *
     * @param text $corps
     */
    public function setCorps($corps)
    {
        $this->corps = $corps;
    }

    /**
     * Get corps
     *
     * @return text 
     */
    public function getCorps()
    {
        return $this->corps;
    }
}