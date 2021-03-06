<?php
namespace SL\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class WorkGroup
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected   $id;

    /** @ORM\Column **/
	protected	$name;

    /** @ORM\Column(type="text") **/
	protected	$description;

	/**
	 * @ORM\OneToOne(targetEntity="User")
	 */
	protected	$leader;

	/**
	 * @ORM\ManyToMany(targetEntity="User", inversedBy="groups")
	 */
	protected	$members;

	/**
	 * @ORM\ManyToMany(targetEntity="Enterprise", mappedBy="groups")
	 */
	protected	$enterprises;

	//TODO: PJ

	public function	__construct()
	{
		$this->members = new ArrayCollection();
		$this->enterprises = new ArrayCollection();
	}

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Set leader
     *
     * @param SL\MainBundle\Entity\User $leader
     */
    public function setLeader(\SL\MainBundle\Entity\User $leader)
    {
        $this->leader = $leader;
    }

    /**
     * Get leader
     *
     * @return SL\MainBundle\Entity\User 
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * Add members
     *
     * @param SL\MainBundle\Entity\User $members
     */
    public function addUser(\SL\MainBundle\Entity\User $members)
    {
        $this->members[] = $members;
    }

    /**
     * Get members
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Add entreprises
     *
     * @param SL\MainBundle\Entity\Enterprise $entreprises
     */
    public function addEnterprise(\SL\MainBundle\Entity\Enterprise $entreprises)
    {
        $this->entreprises[] = $entreprises;
    }

    /**
     * Get entreprises
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEnterprises()
    {
        return $this->enterprises;
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
}