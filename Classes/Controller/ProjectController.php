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
 * ProjectController
 */
class ProjectController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    protected $pluginSettings = null;
    protected $userinfo = null;

    /**
     * projectRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\projectRepository
     */
    protected $projectRepository = null;

    /**
     * employeeRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\employeeRepository
     */
    protected $employeeRepository = null;

    /**
     * departmentRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\departmentRepository
     */
    protected $departmentRepository = null;

    /**
     * @param \Ms\Empadministration\Domain\Repository\projectRepository $projectRepository
     */
    public function injectProjectRepository(\Ms\Empadministration\Domain\Repository\ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param \Ms\Empadministration\Domain\Repository\employeeRepository $employeeRepository
     */
    public function injectEmployeeRepository(\Ms\Empadministration\Domain\Repository\EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
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
        $projects = $this->projectRepository->findAll();

        $departments = array();
        foreach ($projects as $key => $value) {
            $departments[$value->getUid()] = $this->departmentRepository->findDepartmentByProjectId($value->getUid());
        }
        $this->view->assign('departments', $departments);
        $this->view->assign('projects', $projects);
        $this->view->assign('userinfo', $this->userinfo);
        $this->view->assign('settings2', $this->pluginSettings);
    }

    /**
     * action show
     * 
     * @param \Ms\Empadministration\Domain\Model\Project $project
     * @return void
     */
    public function showAction(\Ms\Empadministration\Domain\Model\Project $project)
    {
        // Getting department of this project
        $department = $this->departmentRepository->findDepartmentByProjectId($project->getUid());
        if($department)
            $this->view->assign('department', $department->getFirst());

        $this->view->assign('project', $project);
        $this->view->assign('userinfo', $this->userinfo);
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

        $employees = $this->employeeRepository->findAll();
        $this->view->assign('employees', $employees);
    }

    /**
     * action create
     * 
     * @param \Ms\Empadministration\Domain\Model\Project $newProject
     * @return void
     */
    public function createAction(\Ms\Empadministration\Domain\Model\Project $newProject)
    {
        $requestData = $this->request->getArguments();
        $this->projectRepository->add($newProject);
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
     * @param \Ms\Empadministration\Domain\Model\Project $project
     * @return void
     */
    public function editAction(\Ms\Empadministration\Domain\Model\Project $project)
    {
        $employees = $this->employeeRepository->findAll();
        
        $department = $this->departmentRepository->findDepartmentByProjectId($project->getUid());
        if($department)
            $this->view->assign('department', $department->getFirst());

        // $this->view->assign('employees', $employees);
        $this->view->assign('project', $project);
        $this->view->assign('settings2', $this->pluginSettings);
    }

    /**
     * action update
     * 
     * @param \Ms\Empadministration\Domain\Model\Project $project
     * @return void
     */
    public function updateAction(\Ms\Empadministration\Domain\Model\Project $project)
    {
        $this->addFlashMessage('Record udpated ! ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->projectRepository->update($project);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Ms\Empadministration\Domain\Model\Project $project
     * @return void
     */
    public function deleteAction(\Ms\Empadministration\Domain\Model\Project $project)
    {
        $this->addFlashMessage('Record removed !', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->projectRepository->remove($project);
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
