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

/**
 * OfficeController
 */
class OfficeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    protected $pluginSettings = null;
    protected $userinfo;
    /**
     * officeRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\OfficeRepository
     */
    protected $officeRepository = null;

    /**
     * departmentRepository
     * 
     * @var \Ms\Empadministration\Domain\Repository\departmentRepository
     */
    protected $departmentRepository = null;

    /**
     * @param \Ms\Empadministration\Domain\Repository\OfficeRepository $officeRepository
     */
    public function injectOfficeRepository(\Ms\Empadministration\Domain\Repository\OfficeRepository $officeRepository)
    {
        $this->officeRepository = $officeRepository;
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
    public function initializeAction()
    {
        // Getting logged in user information
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
        $offices = $this->officeRepository->findAll();
        $this->view->assign('offices', $offices);

        $departments = $this->departmentRepository->findAll();
        $this->view->assign('departments', $departments);
        $this->view->assign('userinfo', $this->userinfo);
    }

    /**
     * action show
     * 
     * @param \Ms\Empadministration\Domain\Model\Office $office
     * @return void
     */
    public function showAction(\Ms\Empadministration\Domain\Model\Office $office)
    {
        $this->view->assign('settings2', $this->pluginSettings);
        $this->view->assign('office', $office);
        $this->view->assign('userinfo', $this->userinfo);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
        $departments = $this->departmentRepository->findAll();
        $this->view->assign('departments', $departments);
    }

    /**
     * action create
     * 
     * @param \Ms\Empadministration\Domain\Model\Office $newOffice
     * @return void
     */
    public function createAction(\Ms\Empadministration\Domain\Model\Office $newOffice)
    {
        $this->addFlashMessage('Record created ! ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
        $this->officeRepository->add($newOffice);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Ms\Empadministration\Domain\Model\Office $office
     * @return void
     */
    public function editAction(\Ms\Empadministration\Domain\Model\Office $office)
    {
        $departments = $this->departmentRepository->findAll();
        $this->view->assign('departments', $departments);
        $this->view->assign('office', $office);
    }

    /**
     * action update
     * 
     * @param \Ms\Empadministration\Domain\Model\Office $office
     * @return void
     */
    public function updateAction(\Ms\Empadministration\Domain\Model\Office $office)
    {
        $this->addFlashMessage('Record udpated ! ', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->officeRepository->update($office);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Ms\Empadministration\Domain\Model\Office $office
     * @return void
     */
    public function deleteAction(\Ms\Empadministration\Domain\Model\Office $office)
    {
        $this->addFlashMessage('Record removed !', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO);
        $this->officeRepository->remove($office);
        $this->redirect('list');
    }
}
