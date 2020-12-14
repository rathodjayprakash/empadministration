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
 * Project
 */
class Project extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $name = '';

    /**
     * employees
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ms\Empadministration\Domain\Model\Employee>
     */
    protected $employees = null;

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
        $this->employees = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Adds a Employee
     * 
     * @param \Ms\Empadministration\Domain\Model\Employee $employee
     * @return void
     */
    public function addEmployee(\Ms\Empadministration\Domain\Model\Employee $employee)
    {
        $this->employees->attach($employee);
    }

    /**
     * Removes a Employee
     * 
     * @param \Ms\Empadministration\Domain\Model\Employee $employeeToRemove The Employee to be removed
     * @return void
     */
    public function removeEmployee(\Ms\Empadministration\Domain\Model\Employee $employeeToRemove)
    {
        $this->employees->detach($employeeToRemove);
    }

    /**
     * Returns the employees
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ms\Empadministration\Domain\Model\Employee> $employees
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * Sets the employees
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ms\Empadministration\Domain\Model\Employee> $employees
     * @return void
     */
    public function setEmployees(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $employees)
    {
        $this->employees = $employees;
    }
    
}
