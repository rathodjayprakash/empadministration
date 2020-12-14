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
 * ProjectAssignment
 */
class ProjectAssignment extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * hoursFrom
     * 
     * @var string
     */
    protected $hoursFrom = '';

    /**
     * hoursTo
     * 
     * @var string
     */
    protected $hoursTo = '';

    /**
     * taskInfo
     * 
     * @var string
     */
    protected $taskInfo = '';

    /**
     * On which project worked ?
     * 
     * @var \Ms\Empadministration\Domain\Model\Project
     */
    protected $project = null;

    /**
     * Who & How much worked ?
     * 
     * @var \Ms\Empadministration\Domain\Model\Employee
     */
    protected $employee = null;

    /**
     * Returns the taskInfo
     * 
     * @return string $taskInfo
     */
    public function getTaskInfo()
    {
        return $this->taskInfo;
    }

    /**
     * Sets the taskInfo
     * 
     * @param string $taskInfo
     * @return void
     */
    public function setTaskInfo($taskInfo)
    {
        $this->taskInfo = $taskInfo;
    }

    /**
     * Returns the project
     * 
     * @return \Ms\Empadministration\Domain\Model\Project $project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Sets the project
     * 
     * @param \Ms\Empadministration\Domain\Model\Project $project
     * @return void
     */
    public function setProject(\Ms\Empadministration\Domain\Model\Project $project)
    {
        $this->project = $project;
    }

    /**
     * Returns the employee
     * 
     * @return \Ms\Empadministration\Domain\Model\Employee $employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Sets the employee
     * 
     * @param \Ms\Empadministration\Domain\Model\Employee $employee
     * @return void
     */
    public function setEmployee(\Ms\Empadministration\Domain\Model\Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Returns the hoursFrom
     * 
     * @return string hoursFrom
     */
    public function getHoursFrom()
    {
        return $this->hoursFrom;
    }

    /**
     * Sets the hoursFrom
     * 
     * @param string $hoursFrom
     * @return void
     */
    public function setHoursFrom($hoursFrom)
    {
        $this->hoursFrom = $hoursFrom;
    }

    /**
     * Returns the hoursTo
     * 
     * @return string hoursTo
     */
    public function getHoursTo()
    {
        return $this->hoursTo;
    }

    /**
     * Sets the hoursTo
     * 
     * @param string $hoursTo
     * @return void
     */
    public function setHoursTo($hoursTo)
    {
        $this->hoursTo = $hoursTo;
    }
}
