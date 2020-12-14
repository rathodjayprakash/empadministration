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
 * ProjectAssignmentController
 */
class ProjectAssignmentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    protected $userinfo = null;
    protected $pluginSettings = null;

    /**
     * projectAssignmentRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\projectAssignmentRepository
     */
    protected $projectAssignmentRepository = null;

    /**
     * employeeRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\employeeRepository
     */
    protected $employeeRepository = null;


    /**
     * @param \Ms\Empadministration\Domain\Repository\projectAssignmentRepository $projectAssignmentRepository
     */
    public function injectProjectAssignmentRepository(\Ms\Empadministration\Domain\Repository\ProjectAssignmentRepository $projectAssignmentRepository)
    {
        $this->projectAssignmentRepository = $projectAssignmentRepository;
    }

    /**
     * @param \Ms\Empadministration\Domain\Repository\employeeRepository $employeeRepository
     */
    public function injectEmployeeRepository(\Ms\Empadministration\Domain\Repository\EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
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
        if(!empty($this->userinfo) && ($this->pluginSettings['employeeGroupUid'] == $this->userinfo['usergroup'])) {
            // Getting project hours of logged in user if its group of employee 
            $employeeInfo = $this->employeeRepository->findEmployeeByEmail($this->userinfo['email'])->getFirst();
            $projectAssignments = $this->projectAssignmentRepository->findHoursByEmployeeId($employeeInfo->getUid());
        } else {
            // Getting all project hours for administrtor 
            $projectAssignments = $this->projectAssignmentRepository->findAll();
        }
        $this->view->assign('projectAssignments', $projectAssignments);
    }

    /**
     * action show
     * 
     * @param \Ms\Empadministration\Domain\Model\ProjectAssignment $projectAssignment
     * @return void
     */
    public function showAction(\Ms\Empadministration\Domain\Model\ProjectAssignment $projectAssignment)
    {
        $this->view->assign('projectAssignment', $projectAssignment);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
        $userInfo = $GLOBALS['TSFE']->fe_user->user;
        $employee = $this->employeeRepository->findEmployeeByEmail($userInfo['email'])->getFirst();

        $this->view->assign("requestdata", $this->request->getArguments());
        $this->view->assign('settings2', $this->pluginSettings);
        $this->view->assign('employee', $employee);
    }

    /**
     * action create
     * 
     * @param \Ms\Empadministration\Domain\Model\ProjectAssignment $newProjectAssignment
     * @return void
     */
    public function createAction(\Ms\Empadministration\Domain\Model\ProjectAssignment $newProjectAssignment)
    {
        $requestData = $this->request->getArguments();
        $hrsFrom = strtotime($newProjectAssignment->getHoursFrom());
        $hrsTo = strtotime($newProjectAssignment->getHoursTo());
        $newProjectAssignment->setHoursFrom($hrsFrom);
        $newProjectAssignment->setHoursTo($hrsTo);
        
        $this->projectAssignmentRepository->add($newProjectAssignment);
        
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
     * @param \Ms\Empadministration\Domain\Model\ProjectAssignment $projectAssignment
     * @return void
     */
    public function editAction(\Ms\Empadministration\Domain\Model\ProjectAssignment $projectAssignment)
    {
        $this->view->assign('projectAssignment', $projectAssignment);
    }

    /**
     * action update
     * 
     * @param \Ms\Empadministration\Domain\Model\ProjectAssignment $projectAssignment
     * @return void
     */
    public function updateAction(\Ms\Empadministration\Domain\Model\ProjectAssignment $projectAssignment)
    {
        $hrsFrom = strtotime($newProjectAssignment->getHoursFrom());
        $hrsTo = strtotime($newProjectAssignment->getHoursTo());
        $newProjectAssignment->setHoursFrom($hrsFrom);
        $newProjectAssignment->setHoursTo($hrsTo);

        $this->addFlashMessage('Record udpated ! ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->projectAssignmentRepository->update($projectAssignment);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Ms\Empadministration\Domain\Model\ProjectAssignment $projectAssignment
     * @return void
     */
    public function deleteAction(\Ms\Empadministration\Domain\Model\ProjectAssignment $projectAssignment)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->projectAssignmentRepository->remove($projectAssignment);
        $this->redirect('list');
    }
}
