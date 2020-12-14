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
 * Department
 */
class Department extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * Name of the department
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $name = '';

    /**
     * A department can work on several projects
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ms\Empadministration\Domain\Model\Project>
     */
    protected $projects = null;

    /**
     * A department can have several employees
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ms\Empadministration\Domain\Model\Employee>
     */
    protected $employees = null;

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
        $this->projects = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->employees = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
     * Adds a Project
     * 
     * @param \Ms\Empadministration\Domain\Model\Project $project
     * @return void
     */
    public function addProject(\Ms\Empadministration\Domain\Model\Project $project)
    {
        $this->projects->attach($project);
    }

    /**
     * Removes a Project
     * 
     * @param \Ms\Empadministration\Domain\Model\Project $projectToRemove The Project to be removed
     * @return void
     */
    public function removeProject(\Ms\Empadministration\Domain\Model\Project $projectToRemove)
    {
        $this->projects->detach($projectToRemove);
    }

    /**
     * Returns the projects
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ms\Empadministration\Domain\Model\Project> $projects
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * Sets the projects
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ms\Empadministration\Domain\Model\Project> $projects
     * @return void
     */
    public function setProjects(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $projects)
    {
        $this->projects = $projects;
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
