<?php

namespace Magenta\Bundle\SWarrantyModelBundle\Entity\Organisation;

use Bean\Component\Organization\Model\Organization as OrganizationModel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Magenta\Bundle\SWarrantyModelBundle\Entity\Media\Media;
use Magenta\Bundle\SWarrantyModelBundle\Entity\System\System;
use Magenta\Bundle\SWarrantyModelBundle\Entity\User\User;

/**
 * @ORM\Entity()
 * @ORM\Table(name="organisation__organisation")
 */
class Organisation extends OrganizationModel {
	
	/**
	 * @var int|null
	 * @ORM\Id
	 * @ORM\Column(type="integer",options={"unsigned":true})
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @param User $adminUser
	 */
	public function setAdminUser(User $adminUser): void {
		$this->adminUser = $adminUser;
		$adminUser->setAdminOrganisation($this);
	}
	
	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Organisation\OrganisationMember", mappedBy="organization", cascade={"persist","merge"}, orphanRemoval=true)
	 */
	protected $members;
	
	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\AccessControl\ACRole", mappedBy="organisation", cascade={"persist","merge"}, orphanRemoval=true)
	 */
	protected $roles;
	
	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Product\ServiceZone", mappedBy="organisation", cascade={"persist","merge"}, orphanRemoval=true)
	 */
	protected $serviceZones;
	
	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Product\BrandCategory", mappedBy="organisation", cascade={"persist","merge"}, orphanRemoval=true)
	 */
	protected $categories;
	
	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Product\BrandSubCategory", mappedBy="organisation", cascade={"persist","merge"}, orphanRemoval=true)
	 */
	protected $subCategories;
	
	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Product\BrandSupplier", mappedBy="organisation", cascade={"persist","merge"}, orphanRemoval=true)
	 */
	protected $suppliers;
	
	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Product\Brand", mappedBy="organisation", cascade={"persist","merge"}, orphanRemoval=true)
	 */
	protected $brands;
	/**
	 * @var Collection
	 * @ORM\OneToMany(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Product\Dealer", mappedBy="organisation", cascade={"persist","merge"}, orphanRemoval=true)
	 */
	protected $dealers;
	
	
	/**
	 * @var System|null
	 * @ORM\ManyToOne(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\System\System", inversedBy="organisations", cascade={"persist","merge"})
	 * @ORM\JoinColumn(name="id_system", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $system;
	
	/**
	 * @var User|null
	 * @ORM\OneToOne(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\User\User", mappedBy="adminOrganisation", cascade={"persist","merge"})
	 */
	protected $adminUser;
	
	/**
	 * @var Media|null
	 * @ORM\OneToOne(targetEntity="Magenta\Bundle\SWarrantyModelBundle\Entity\Media\Media", mappedBy="logoOrganisation", cascade={"persist","merge"})
	 */
	protected $logo;
	
	/**
	 * @var boolean
	 * @ORM\Column(type="boolean", options={"default":true})
	 */
	protected $enabled = true;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $tos;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $name;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $code;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $adminEmail;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $adminFamilyName;
	
	/**
	 * @var string|null
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $adminGivenName;
	
	
	/**
	 * @var string|null
	 */
	protected $adminPassword;
	
	/**
	 * @return Media|null
	 */
	public function getLogo(): ?Media {
		return $this->logo;
	}
	
	/**
	 * @param Media $logo
	 */
	public function setLogo(Media $logo): void {
		$this->logo = $logo;
	}
	
	/**
	 * @return Collection
	 */
	public function getRoles(): Collection {
		return $this->roles;
	}
	
	/**
	 * @param Collection $roles
	 */
	public function setRoles(Collection $roles): void {
		$this->roles = $roles;
	}
	
	/**
	 * @return null|string
	 */
	public function getAdminEmail(): ?string {
		return $this->adminEmail;
	}
	
	/**
	 * @param null|string $adminEmail
	 */
	public function setAdminEmail(?string $adminEmail): void {
		$this->adminEmail = $adminEmail;
	}
	
	/**
	 * @return null|string
	 */
	public function getAdminPassword(): ?string {
		return $this->adminPassword;
	}
	
	/**
	 * @param null|string $adminPassword
	 */
	public function setAdminPassword(?string $adminPassword): void {
		$this->adminPassword = $adminPassword;
	}
	
	/**
	 * @return User
	 */
	public function getAdminUser(): ?User {
		return $this->adminUser;
	}
	
	/**
	 * @return null|string
	 */
	public function getAdminFamilyName(): ?string {
		return $this->adminFamilyName;
	}
	
	/**
	 * @param null|string $adminFamilyName
	 */
	public function setAdminFamilyName(?string $adminFamilyName): void {
		$this->adminFamilyName = $adminFamilyName;
	}
	
	/**
	 * @return null|string
	 */
	public function getAdminGivenName(): ?string {
		return $this->adminGivenName;
	}
	
	/**
	 * @param null|string $adminGivenName
	 */
	public function setAdminGivenName(?string $adminGivenName): void {
		$this->adminGivenName = $adminGivenName;
	}
	
	/**
	 * @return System|null
	 */
	public function getSystem(): ?System {
		return $this->system;
	}
	
	/**
	 * @param System|null $system
	 */
	public function setSystem(?System $system): void {
		$this->system = $system;
	}
	
	/**
	 * @return Collection
	 */
	public function getCategories(): Collection {
		return $this->categories;
	}
	
	/**
	 * @param Collection $categories
	 */
	public function setCategories(Collection $categories): void {
		$this->categories = $categories;
	}
	
	/**
	 * @return Collection
	 */
	public function getSubCategories(): Collection {
		return $this->subCategories;
	}
	
	/**
	 * @param Collection $subCategories
	 */
	public function setSubCategories(Collection $subCategories): void {
		$this->subCategories = $subCategories;
	}
	
	/**
	 * @return Collection
	 */
	public function getSuppliers(): Collection {
		return $this->suppliers;
	}
	
	/**
	 * @param Collection $suppliers
	 */
	public function setSuppliers(Collection $suppliers): void {
		$this->suppliers = $suppliers;
	}
	
	/**
	 * @return Collection
	 */
	public function getBrands(): Collection {
		return $this->brands;
	}
	
	/**
	 * @param Collection $brands
	 */
	public function setBrands(Collection $brands): void {
		$this->brands = $brands;
	}
	
	/**
	 * @return null|string
	 */
	public function getCode(): ?string {
		return $this->code;
	}
	
	/**
	 * @param null|string $code
	 */
	public function setCode(?string $code): void {
		$this->code = $code;
	}
	
	/**
	 * @return Collection
	 */
	public function getDealers(): Collection {
		return $this->dealers;
	}
	
	/**
	 * @param Collection $dealers
	 */
	public function setDealers(Collection $dealers): void {
		$this->dealers = $dealers;
	}
	
	/**
	 * @return null|string
	 */
	public function getTos(): ?string {
		return $this->tos;
	}
	
	/**
	 * @param null|string $tos
	 */
	public function setTos(?string $tos): void {
		$this->tos = $tos;
	}
	
}