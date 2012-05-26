<?php
namespace SL\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity **/
class Enterprise
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected   $id;

    /** @ORM\Column **/
	protected	$name;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="enterprises")
	 */
	protected	$responsible;

    /** @ORM\Column(type="enumStatutEnterprise") **/
	protected	$statut;

    /** @ORM\Column(type="text") **/
	protected	$description;

    /** @ORM\Column(type="date") **/
	protected	$start_date;


	/**
	 * @ORM\ManyToMany(targetEntity="WorkGroup", inversedBy="enterprises")
	 */
	protected	$groups;

	/**
	 * @ORM\OneToMany(targetEntity="Test", mappedBy="enterprise")
	 */
	protected	$tests;

	//TODO: PJ

	public function	__construct()
	{
		$this->groups = new ArrayCollection();
		$this->tests = new ArrayCollection();
	}

    public function __toString()
    {
        return $this->getName();
    }
    
    /**
     * Set responsible
     *
     * @param SL\MainBundle\Entity\User $responsible
     */
    public function setResponsible(\SL\MainBundle\Entity\User $responsible)
    {
        $this->responsible = $responsible;
    }

    /**
     * Get responsible
     *
     * @return SL\MainBundle\Entity\User 
     */
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * Add groups
     *
     * @param SL\MainBundle\Entity\WorkGroup $groups
     */
    public function addWorkGroup(\SL\MainBundle\Entity\WorkGroup $groups)
    {
        $this->groups[] = $groups;
    }

    /**
     * Get groups
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Add tests
     *
     * @param SL\MainBundle\Entity\Test $tests
     */
    public function addTest(\SL\MainBundle\Entity\Test $tests)
    {
        $this->tests[] = $tests;
    }

    /**
     * Get tests
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTests()
    {
        return $this->tests;
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set statut
     *
     * @param enumStatutEnterprise $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * Get statut
     *
     * @return enumStatutEnterprise 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set start_date
     *
     * @param date $startDate
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;
    }

    /**
     * Get start_date
     *
     * @return date 
     */
    public function getStartDate()
    {
        return $this->start_date;
    }
}