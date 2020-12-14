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
/**
 * PositionsController
 */
class PositionsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $positions = $this->positionsRepository->findAll();
        $this->view->assign('positions', $positions);
    }

    /**
     * action show
     * 
     * @param \Ms\Empadministration\Domain\Model\Positions $positions
     * @return void
     */
    public function showAction(\Ms\Empadministration\Domain\Model\Positions $positions)
    {
        $this->view->assign('positions', $positions);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \Ms\Empadministration\Domain\Model\Positions $newPositions
     * @return void
     */
    public function createAction(\Ms\Empadministration\Domain\Model\Positions $newPositions)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->positionsRepository->add($newPositions);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \Ms\Empadministration\Domain\Model\Positions $positions
     * @ignorevalidation $positions
     * @return void
     */
    public function editAction(\Ms\Empadministration\Domain\Model\Positions $positions)
    {
        $this->view->assign('positions', $positions);
    }

    /**
     * action update
     * 
     * @param \Ms\Empadministration\Domain\Model\Positions $positions
     * @return void
     */
    public function updateAction(\Ms\Empadministration\Domain\Model\Positions $positions)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->positionsRepository->update($positions);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \Ms\Empadministration\Domain\Model\Positions $positions
     * @return void
     */
    public function deleteAction(\Ms\Empadministration\Domain\Model\Positions $positions)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->positionsRepository->remove($positions);
        $this->redirect('list');
    }
}
