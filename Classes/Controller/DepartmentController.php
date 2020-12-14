<?php
namespace Ms\Empadministration\Controller;
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

use ScssPhp\ScssPhp\Formatter\Debug;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * DepartmentController
 */
class DepartmentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    protected $pluginSettings = null;
    protected $userinfo = null;

    /**
     * departmentRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\departmentRepository
     */
    protected $departmentRepository = null;

    /**
     * employeeRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\employeeRepository
     */
    protected $employeeRepository = null;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\FrontendConfigurationManager
     */
    protected $frontendConfigurationManager;

    /**
     * projectRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\projectRepository
     */
    protected $projectRepository = null;

    /**
     * @param \Ms\Empadministration\Domain\Repository\departmentRepository $departmentRepository
     */
    public function injectDepartmentRepository(\Ms\Empadministration\Domain\Repository\DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @param \Ms\Empadministration\Domain\Repository\employeeRepository $employeeRepository
     */
    public function injectEmployeeRepository(\Ms\Empadministration\Domain\Repository\EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param \Ms\Empadministration\Domain\Repository\projectRepository $projectRepository
     */
    public function injectProjectRepository(\Ms\Empadministration\Domain\Repository\ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * Initializes the current action
     *
     */
    public function initializeAction() {
        $this->frontendConfigurationManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Configuration\FrontendConfigurationManager::class);
        $extConfig = $this->frontendConfigurationManager->getTypoScriptSetup();
        $this->pluginSettings = $extConfig['plugin.']['tx_empadministration_empadministration.']['settings.'];
        $this->userinfo = $GLOBALS['TSFE']->fe_user->user;
    }

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $departments = $this->departmentRepository->findAll();
        $this->view->assign('departments', $departments);

        // Getting only those employees who has no department assigned
        $employees = $this->employeeRepository->findAll();
        $this->view->assign('employees', $employees);

        // Getting onlyl those projects which has no department assigned
        $projects = $this->projectRepository->findAll();
        $this->view->assign('projects', $projects);
    
        $this->view->assign('userinfo', $this->userinfo);
        $this->view->assign('settings2', $this->pluginSettings);
    }

    /**
     * action show
     * 
     * @param \Ms\Empadministration\Domain\Model\Department $department
     * @return void
     */
    public function showAction(\Ms\Empadministration\Domain\Model\Department $department)
    {
        $this->view->assign('settings2', $this->pluginSettings);
        $this->view->assign('userinfo', $this->userinfo);
        $this->view->assign('department', $department);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
        $this->view->assign("requestdata", $this->request->getArguments());
        
        $departmentInfo = $this->departmentRepository->getAllEmployeesAndProjectsOfDepartment();

        // Getting only those employees who has no department assigned
        $employeeList = $this->getCommaSaperatedString($departmentInfo, "employees");
        $employees = $this->employeeRepository->findEmployeeNotIn($employeeList);
        $this->view->assign('employees', $employees);

        // Getting onlyl those projects which has no department assigned
        $projectList = $this->getCommaSaperatedString($departmentInfo, "projects");
        $projects = $this->projectRepository->findProjectNotIn($projectList);
        
        $this->view->assign('projects', $projects);
        $this->view->assign('settings2', $this->pluginSettings);
    }

    /**
     * action create
     * 
     * @param \Ms\Empadministration\Domain\Model\Department $newDepartment
     * @return void
     */
    public function createAction(\Ms\Empadministration\Domain\Model\Department $newDepartment)
    {
        $requestData = $this->request->getArguments();
        $this->departmentRepository->add($newDepartment);

        if($requestData['redirectfrom']) {
            $this->redirect($requestData['redirectto'], $requestData['redirectfrom'], NULL, NULL, $requestData['redirectpid'], 0);
        } else {
            $this->addFlashMessage('Record created ! ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
            $this->redirect('list');
        }
    }

    /**
     * action edit
     * 
     * @param \Ms\Empadministration\Domain\Model\Department $department
     * @return void
     */
    public function editAction(\Ms\Empadministration\Domain\Model\Department $department)
    {
        $this->view->assign('department', $department);

        $departmentInfo = $this->departmentRepository->getAllEmployeesAndProjectsOfDepartment($department->getUid());
        $employeeList = $this->getCommaSaperatedString($departmentInfo, "employees");
        $getAllOccupiedEmployeesProjects = $this->departmentRepository->getAllEmployeesAndProjectsOfDepartment();
        
        // Getting selected employees
        $selectedEmployees = $this->employeeRepository->findEmployeeIn($employeeList);
        $this->view->assign('selectedemployees', $selectedEmployees);

        // Getting only those employees who has no department assigned
        $employeeList = $this->getCommaSaperatedString($getAllOccupiedEmployeesProjects, "employees");
        $employees = $this->employeeRepository->findEmployeeNotIn($employeeList);
        

        $this->view->assign('employees', $employees);


        $projectList = $this->getCommaSaperatedString($departmentInfo, "projects");
        // Getting selected projects
        $selectedProjects = $this->projectRepository->findProjectIn($projectList);
        $this->view->assign('selectedprojects', $selectedProjects);

        // Getting only those projects which are not selected in other departments
        $projectList = $this->getCommaSaperatedString($getAllOccupiedEmployeesProjects, "projects");
        $projects = $this->projectRepository->findProjectNotIn($projectList);
       
        $this->view->assign('projects', $projects);

        $this->view->assign('settings2', $this->pluginSettings);
    }

    /**
     * action update
     * 
     * @param \Ms\Empadministration\Domain\Model\Department $department
     * @return void
     */
    public function updateAction(\Ms\Empadministration\Domain\Model\Department $department)
    {
        $this->addFlashMessage('Record udpated ! ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->departmentRepository->update($department);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Ms\Empadministration\Domain\Model\Department $department
     * @return void
     */
    public function deleteAction(\Ms\Empadministration\Domain\Model\Department $department)
    {
        $this->addFlashMessage('Record removed !', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->departmentRepository->remove($department);
        $this->redirect('list');
    }

    public function getCommaSaperatedString($data, $fieldName) {
        $arr = array();
        foreach ($data as $key => $value) {
            if(!empty($value[$fieldName]))
                $arr[] = $value[$fieldName];
        }
        return implode(",", $arr);
    }
}
