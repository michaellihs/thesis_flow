<?php
namespace TYPO3\Party\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Party".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 *  of the License, or (at your option) any later version.                *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A person
 *
 * @FLOW3\Entity
 */
class Person extends \TYPO3\Party\Domain\Model\AbstractParty {

	/**
	 * @var \TYPO3\Party\Domain\Model\PersonName
	 * @ORM\OneToOne
	 * @FLOW3\Validate(type="NotEmpty")
	 */
	protected $name;

	/**
	 * @var \Doctrine\Common\Collections\Collection<\TYPO3\Party\Domain\Model\ElectronicAddress>
	 * @ORM\ManyToMany
	 */
	protected $electronicAddresses;

	/**
	 * @var \TYPO3\Party\Domain\Model\ElectronicAddress
	 * @ORM\ManyToOne
	 */
	protected $primaryElectronicAddress;

	/**
	 * Constructs this Person
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->electronicAddresses = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Sets the current name of this person
	 *
	 * @param \TYPO3\Party\Domain\Model\PersonName $name Name of this person
	 * @return void
	 */
	public function setName(\TYPO3\Party\Domain\Model\PersonName $name) {
		$this->name = $name;
	}

	/**
	 * Returns the current name of this person
	 *
	 * @return \TYPO3\Party\Domain\Model\PersonName Name of this person
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Adds the given electronic address to this person.
	 *
	 * @param \TYPO3\Party\Domain\Model\ElectronicAddress $electronicAddress The electronic address
	 * @return void
	 */
	public function addElectronicAddress(\TYPO3\Party\Domain\Model\ElectronicAddress $electronicAddress) {
		$this->electronicAddresses->add($electronicAddress);
	}

	/**
	 * Removes the given electronic address from this person.
	 *
	 * @param \TYPO3\Party\Domain\Model\ElectronicAddress $electronicAddress The electronic address
	 * @return void
	 */
	public function removeElectronicAddress(\TYPO3\Party\Domain\Model\ElectronicAddress $electronicAddress) {
		$this->electronicAddresses->removeElement($electronicAddress);
		if ($electronicAddress === $this->primaryElectronicAddress) {
			unset($this->primaryElectronicAddress);
		}
	}

	/**
	 * Returns all known electronic addresses of this person.
	 *
	 * @return \Doctrine\Common\Collections\Collection<\TYPO3\Party\Domain\Model\ElectronicAddress>
	 */
	public function getElectronicAddresses() {
		return clone $this->electronicAddresses;
	}

	/**
	 * Sets (and adds if necessary) the primary electronic address of this person.
	 *
	 * @param \TYPO3\Party\Domain\Model\ElectronicAddress $electronicAddress The electronic address
	 * @return void
	 */
	public function setPrimaryElectronicAddress(\TYPO3\Party\Domain\Model\ElectronicAddress $electronicAddress) {
		$this->primaryElectronicAddress = $electronicAddress;
		if (!$this->electronicAddresses->contains($electronicAddress)) {
			$this->electronicAddresses->add($electronicAddress);
		}
	}

	/**
	 * Returns the primary electronic address, if one has been defined.
	 *
	 * @return \TYPO3\Party\Domain\Model\ElectronicAddress The primary electronic address or NULL
	 */
	public function getPrimaryElectronicAddress() {
		return $this->primaryElectronicAddress;
	}
}

?>