<?php
namespace SL\MainBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity **/
class User implements UserInterface
{
    /**
     * @ORM\Id @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected   $id;

    /** @ORM\Column(length=8) **/
	protected	$login_intra;

    /** @ORM\Column **/
	protected	$login;

    /** @ORM\Column **/
	protected	$password;

    /** @ORM\Column(type="enumStatutUser") **/
	protected	$statut;

	/**
	 * @ORM\ManyToMany(targetEntity="WorkGroup", mappedBy="members")
	 */
	protected	$groups;

	/**
	 * @ORM\OneToMany(targetEntity="Enterprise", mappedBy="responsible")
	 */
	protected	$enterprises;

    /**
     * @ORM\Column(type="datetime")
     */
    protected  $creation_date;

	public function	__construct()
	{
		$this->groups = new ArrayCollection();
		$this->enterprises = new ArrayCollection();
	}

    public function __toString()
    {
        return $this->getLogin() . " - " . $this->getLoginIntra();
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
     * Set enterprises
     *
     * @param SL\MainBundle\Entity\Enterprise $enterprises
     */
    public function setEnterprises(\SL\MainBundle\Entity\Enterprise $enterprises)
    {
        $this->enterprises = $enterprises;
    }

    /**
     * Get enterprises
     *
     * @return SL\MainBundle\Entity\Enterprise 
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
     * Set login_intra
     *
     * @param string $loginIntra
     */
    public function setLoginIntra($loginIntra)
    {
        $this->login_intra = $loginIntra;
    }

    /**
     * Get login_intra
     *
     * @return string 
     */
    public function getLoginIntra()
    {
        return $this->login_intra;
    }

    /**
     * Set login
     *
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set statut
     *
     * @param enumStatutUser $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    /**
     * Get statut
     *
     * @return enumStatutUser 
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set creation_date
     *
     * @param datetime $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creation_date = $creationDate;
    }

    /**
     * Get creation_date
     *
     * @return datetime 
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * Add enterprises
     *
     * @param SL\MainBundle\Entity\Enterprise $enterprises
     */
    public function addEnterprise(\SL\MainBundle\Entity\Enterprise $enterprises)
    {
        $this->enterprises[] = $enterprises;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->login;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return "//KLSDFGPO9OSDFPIOG";
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        switch ($this->getStatut())
        {
            case "admin":
                return array('ROLE_ADMIN');
            default:
        }
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {

    }

    /**
     * @inheritDoc
     */
    public function equals(UserInterface $user)
    {
        return $this->login === $user->getUsername();
    }
}