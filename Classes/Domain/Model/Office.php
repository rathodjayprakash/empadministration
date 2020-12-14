<?php
namespace Ms\Empadministration\Domain\Model;


/***
 *
 * This file is part of the "Employee Administration" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Jayprakash <jayprakash.yug@gmail.com>, monsun
 *
 ***/
/**
 * Office
 */
class Office extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * Office name
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $name = '';

    /**
     * Company full address
     * 
     * @var string
     */
    protected $address = '';

    /**
     * Contact details for Company
     * 
     * @var string
     */
    protected $contactDetails = '';

    /**
     * An office can have several departments
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ms\Empadministration\Domain\Model\Department>
     */
    protected $departments = null;

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->departments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the name
     * 
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the address
     * 
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the address
     * 
     * @param string $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Returns the contactDetails
     * 
     * @return string $contactDetails
     */
    public function getContactDetails()
    {
        return $this->contactDetails;
    }

    /**
     * Sets the contactDetails
     * 
     * @param string $contactDetails
     * @return void
     */
    public function setContactDetails($contactDetails)
    {
        $this->contactDetails = $contactDetails;
    }

    /**
     * Adds a Department
     * 
     * @param \Ms\Empadministration\Domain\Model\Department $department
     * @return void
     */
    public function addDepartment(\Ms\Empadministration\Domain\Model\Department $department)
    {
        $this->departments->attach($department);
    }

    /**
     * Removes a Department
     * 
     * @param \Ms\Empadministration\Domain\Model\Department $departmentToRemove The Department to be removed
     * @return void
     */
    public function removeDepartment(\Ms\Empadministration\Domain\Model\Department $departmentToRemove)
    {
        $this->departments->detach($departmentToRemove);
    }

    /**
     * Returns the departments
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ms\Empadministration\Domain\Model\Department> $departments
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * Sets the departments
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ms\Empadministration\Domain\Model\Department> $departments
     * @return void
     */
    public function setDepartments(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $departments)
    {
        $this->departments = $departments;
    }
}
