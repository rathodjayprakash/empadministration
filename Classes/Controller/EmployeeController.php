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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory;

/**
 * EmployeeController
 */
class EmployeeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    protected $pluginSettings = null;
    protected $userinfo = null;
    
    /**
     * employeeRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\employeeRepository
     */
    protected $employeeRepository = null;

    /**
     * employeeRepository
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserGroupRepository
     */
    protected $feUserGroupRepository = null;

    /**
     * feUserRepository
     * 
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     */
    protected $feUserRepository;
    
    /**
     * projectRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\projectRepository
     */
    protected $projectRepository = null;

    /**
     * departmentRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\departmentRepository
     */
    protected $departmentRepository = null;

    /**
     * @param \Ms\Empadministration\Domain\Repository\employeeRepository $employeeRepository
     */
    public function injectEmployeeRepository(\Ms\Empadministration\Domain\Repository\EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserGroupRepository $feUserGroupRepository
     */
    public function injectFeUserGroupRepository(\TYPO3\CMS\Extbase\Domain\Repository\FrontendUserGroupRepository $feUserGroupRepository)
    {
        $this->feUserGroupRepository = $feUserGroupRepository;
    }

    /**
     * Dependency injection of the Country Repository
     *
     * @param \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository $feUserRepository
     *
     * @return void
     */
    public function injectFrontendUserRepository(\TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository $feUserRepository)
    {
        $this->feUserRepository = $feUserRepository;
    }

    /**
     * @param \Ms\Empadministration\Domain\Repository\projectRepository $projectRepository
     */
    public function injectProjectRepository(\Ms\Empadministration\Domain\Repository\ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param \Ms\Empadministration\Domain\Repository\departmentRepository $departmentRepository
     */
    public function injectDepartmentRepository(\Ms\Empadministration\Domain\Repository\DepartmentRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
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
        $employees = $this->employeeRepository->findAll();
        $projects = array();
        foreach ($employees as $key => $value) {
            $projects[$value->getUid()] = $this->projectRepository->findProjectsByEmployeeId($value->getUid());
        }
        $this->view->assign('projects', $projects);
        $this->view->assign('employees', $employees);
        $this->view->assign('userinfo', $this->userinfo);
        $this->view->assign('settings2', $this->pluginSettings);
    }

    /**
     * action show
     * 
     * @param \Ms\Empadministration\Domain\Model\Employee $employee
     * @return void
     */
    public function showAction(\Ms\Empadministration\Domain\Model\Employee $employee)
    {
        $employeeInfo = $this->employeeRepository->findEmployeeByEmail($employee->getEmail());
        if($employeeInfo)
            $projects = $this->projectRepository->findProjectsByEmployeeId($employeeInfo->getFirst()->getUid());

        $this->view->assign('projects', $projects);
        $this->view->assign('employee', $employee);
        $this->view->assign("requestdata", $this->request->getArguments());
        $this->view->assign('settings2', $this->pluginSettings);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
        $this->view->assign("requestdata", $this->request->getArguments());
        $this->view->assign('settings2', $this->pluginSettings);
    }

    /**
     * action create
     * 
     * @param \Ms\Empadministration\Domain\Model\Employee $newEmployee
     * @return void
     */
    public function createAction(\Ms\Empadministration\Domain\Model\Employee $newEmployee)
    {
        $requestData = $this->request->getArguments();
        $feUserInstance = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser::class);
        $objectManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        // Find employee email in fe_user table
        $employeeEmail = $newEmployee->getEmail();
        $employeeUserGroup = $this->feUserGroupRepository->findByUid($this->settings['usergroup']); // Employee Usergroup 
        if(empty($this->feUserRepository->findByUsername($employeeEmail)->getFirst())) {
            // Creating Frontend user record for employee
            $name = $newEmployee->getName();
            $feUserInstance->setName($name);

            $name = explode(" ", $name);
            $feUserInstance->setFirstName($name[0] ? $name[0] : '');
            $feUserInstance->setLastName($name[1] ? $name[1] : '');
            $feUserInstance->setUsername($employeeEmail);
            $feUserInstance->setEmail($employeeEmail);
            $feUserInstance->addUsergroup($employeeUserGroup);
            $feUserInstance->setTelephone($newEmployee->getPhoneNumber());

            $hashedPassword = $this->getHashedPassword($newEmployee->getPassword());
            $feUserInstance->setPassword($hashedPassword);

            $this->feUserRepository->add($feUserInstance);
            $this->persistenceManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
            $this->persistenceManager->persistAll();
            
            $newEmployee->setPassword($hashedPassword);
            $this->employeeRepository->add($newEmployee);

            if($requestData['redirectfrom']) {
                $this->redirect($requestData['redirectto'], $requestData['redirectfrom'], NULL, NULL, $requestData['redirectpid'], 0);
            } else {
                $this->addFlashMessage('Record created ! ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
                $this->redirect('list');
            }
        } else {
            $this->addFlashMessage('Employee : ' . $employeeEmail . ' already exists in the system !', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
            $this->redirect('new');
        }
    }

    /**
     * action edit
     * 
     * @param \Ms\Empadministration\Domain\Model\Employee $employee
     * @return void
     */
    public function editAction(\Ms\Empadministration\Domain\Model\Employee $employee)
    {
        $this->view->assign("requestdata", $this->request->getArguments());
        $this->view->assign('employee', $employee);
        $this->view->assign('settings2', $this->pluginSettings);
        $this->view->assign('userinfo', $this->userinfo);
    }

    /**
     * action update
     * 
     * @param \Ms\Empadministration\Domain\Model\Employee $employee
     * @return void
     */
    public function updateAction(\Ms\Empadministration\Domain\Model\Employee $employee)
    {
        $requestData = $this->request->getArguments();
        $feUserInstance = $this->feUserRepository->findByUsername($employee->getEmail())->getFirst();
        
        if($employee->getPassword()) {
            $hashedPassword = $this->getHashedPassword($employee->getPassword());
            $feUserInstance->setPassword($hashedPassword);
            $employee->setPassword($hashedPassword);
        }

        $name = $employee->getName();
        $feUserInstance->setName($name);
        $name = explode(" ", $name);
        $feUserInstance->setFirstName($name[0] ? $name[0] : '');
        $feUserInstance->setLastName($name[1] ? $name[1] : '');
        $feUserInstance->setTelephone($employee->getPhoneNumber());
        $this->feUserRepository->update($feUserInstance);

        $this->employeeRepository->update($employee);

        if($requestData['redirectfrom']) {
            $this->redirect($requestData['redirectto'], $requestData['redirectfrom'], NULL, NULL, $requestData['redirectpid'], 0);
        } else {
            $this->addFlashMessage('Record udpated ! ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
            $this->redirect('list');
        }
    }

    /**
     * action delete
     * 
     * @param \Ms\Empadministration\Domain\Model\Employee $employee
     * @return void
     */
    public function deleteAction(\Ms\Empadministration\Domain\Model\Employee $employee)
    {
        $feUserInstance = $this->feUserRepository->findByUsername($employee->getEmail())->getFirst();
        $this->feUserRepository->remove($feUserInstance);

        $this->employeeRepository->remove($employee);
        $this->addFlashMessage('Record removed !', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->redirect('list');
    }

    /*
    * Getting logged in employee information
    */
    public function myinfoAction() {
        $userInfo = $GLOBALS['TSFE']->fe_user->user;
        $employees = $this->employeeRepository->findEmployeeByEmail($userInfo['email']);
        
        if(!$employees)
            $this->addFlashMessage('Your data not found !', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);

        if($employees)
            $projects = $this->projectRepository->findProjectsByEmployeeId($employees->getFirst()->getUid());

        $departments = array();
        foreach ($projects as $key => $value) {
            $department = $this->departmentRepository->findDepartmentByProjectId($value->getUid());
            $departments[$value->getUid()] =  $department->getFirst();
        }
        $this->view->assign('departments', $departments);

        $this->view->assign("userInfo", $userInfo);
        $this->view->assign("projects", $projects);
        $this->view->assign("employees", $employees);
        $this->view->assign('settings2', $this->pluginSettings);
    }

    public function getHashedPassword($passwordString) {
        $hashInstance = GeneralUtility::makeInstance(PasswordHashFactory::class)->getDefaultHashInstance('FE');
        return $hashInstance->getHashedPassword($passwordString);
    }
}
