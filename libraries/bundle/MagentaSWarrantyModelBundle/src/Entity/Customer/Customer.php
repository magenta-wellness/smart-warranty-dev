<?php

namespace Magenta\Bundle\SWarrantyModelBundle\Entity\Customer;

use Magenta\Bundle\SWarrantyModelBundle\Entity\Organisation\Organisation;
use Magenta\Bundle\SWarrantyModelBundle\Entity\Person\Person;
use Magenta\Bundle\SWarrantyModelBundle\Entity\System\Thing;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Magenta\Bundle\SWarrantyModelBundle\Entity\Organisation\OrganisationMember;
use Magenta\Bundle\SWarrantyModelBundle\Entity\User\User;

/**
 * @ORM\Entity()
 * @ORM\Table(name="customer__customer")
 */
class Customer extends Thing {
	
	public function __construct() {
		$this->warranties    = new ArrayCollection();
		$this->registrations = new ArrayCollection();
	}
	
	public function generateFullText() {
		parent::generateFullText();
		
		return $this->fullText .= ' ' . sprintf('email:%s phone:%s home address:%s ', $this->email, $this->telephone, $this->homeAddress);
	}
	
	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Customer\Warranty", mappedBy="customer", cascade={"persist","merge"})
	 */
	protected $warranties;
	
	public function addWarranties(Warranty $w) {
		$this->warranties->add($w);
		$w->setCustomer($this);
	}
	
	public function removeWarranties(Warranty $w) {
		$this->warranties->removeElement($w);
		$w->setCustomer(null);
	}
	
	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Customer\Registration", mappedBy="customer", cascade={"persist","merge"}, orphanRemoval=true)
	 */
	protected $registrations;
	
	/**
	 * @var Organisation|null
	 * @ORM\ManyToOne(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Organisation\Organisation", inversedBy="customers", cascade={"persist","merge"})
	 * @ORM\JoinColumn(name="id_organisation", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $organisation;
	
	/**
	 * @var Person|null
	 * @ORM\ManyToOne(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Person\Person", cascade={"persist", "merge"}, inversedBy="customers")
	 * @ORM\JoinColumn(name="id_person", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $person;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string",nullable=true)
	 */
	protected $name;
	
	/**
	 * @var \DateTime|null
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	protected $birthDate;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string",nullable=true)
	 */
	protected $email;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string",nullable=true)
	 */
	protected $homeAddress;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string",nullable=true)
	 */
	protected $homePostalCode;
	
	/**
	 * @var integer|null
	 * @ORM\Column(type="integer",nullable=true)
	 */
	protected $dialingCode = 65;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string",nullable=true)
	 */
	protected $telephone;
	
	/**
	 * @return \DateTime|null
	 */
	public function getBirthDate(): ?\DateTime {
		return $this->birthDate;
	}
	
	/**
	 * @param \DateTime|null $birthDate
	 */
	public function setBirthDate(?\DateTime $birthDate): void {
		$this->birthDate = $birthDate;
	}
	
	/**
	 * @return null|string
	 */
	public function getEmail(): ?string {
		return $this->email;
	}
	
	/**
	 * @param null|string $email
	 */
	public function setEmail(?string $email): void {
		$this->email = $email;
	}
	
	/**
	 * @return null|string
	 */
	public function getHomeAddress(): ?string {
		return $this->homeAddress;
	}
	
	/**
	 * @param null|string $homeAddress
	 */
	public function setHomeAddress(?string $homeAddress): void {
		$this->homeAddress = $homeAddress;
	}
	
	/**
	 * @return null|string
	 */
	public function getTelephone(): ?string {
		return $this->telephone;
	}
	
	/**
	 * @param null|string $telephone
	 */
	public function setTelephone(?string $telephone): void {
		$this->telephone = $telephone;
	}
	
	/**
	 * @return Person|null
	 */
	public function getPerson(): ?Person {
		return $this->person;
	}
	
	/**
	 * @param Person|null $person
	 */
	public function setPerson(?Person $person): void {
		$this->person = $person;
	}
	
	/**
	 * @return null|string
	 */
	public function getHomePostalCode(): ?string {
		return $this->homePostalCode;
	}
	
	/**
	 * @param null|string $homePostalCode
	 */
	public function setHomePostalCode(?string $homePostalCode): void {
		$this->homePostalCode = $homePostalCode;
	}
	
	/**
	 * @return Collection
	 */
	public function getWarranties(): Collection {
		return $this->warranties;
	}
	
	/**
	 * @param Collection $warranties
	 */
	public function setWarranties(Collection $warranties): void {
		$this->warranties = $warranties;
	}
	
	/**
	 * @return null|integer
	 */
	public function getDialingCode(): ?int {
		return $this->dialingCode;
	}
	
	/**
	 * @param null|integer $dialingCode
	 */
	public function setDialingCode(?int $dialingCode): void {
		$this->dialingCode = $dialingCode;
	}
	
	/**
	 * @return Collection
	 */
	public function getRegistrations(): Collection {
		return $this->registrations;
	}
	
	/**
	 * @param Collection $registrations
	 */
	public function setRegistrations(Collection $registrations): void {
		$this->registrations = $registrations;
	}
}