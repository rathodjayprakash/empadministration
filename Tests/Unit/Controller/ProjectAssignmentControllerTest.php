<?php
namespace Ms\Empadministration\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Jayprakash <jayprakash.yug@gmail.com>
 */
class ProjectAssignmentControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Ms\Empadministration\Controller\ProjectAssignmentController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Ms\Empadministration\Controller\ProjectAssignmentController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllProjectAssignmentsFromRepositoryAndAssignsThemToView()
    {

        $allProjectAssignments = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $projectAssignmentRepository = $this->getMockBuilder(\::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $projectAssignmentRepository->expects(self::once())->method('findAll')->will(self::returnValue($allProjectAssignments));
        $this->inject($this->subject, 'projectAssignmentRepository', $projectAssignmentRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('projectAssignments', $allProjectAssignments);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenProjectAssignmentToView()
    {
        $projectAssignment = new \Ms\Empadministration\Domain\Model\ProjectAssignment();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('projectAssignment', $projectAssignment);

        $this->subject->showAction($projectAssignment);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenProjectAssignmentToProjectAssignmentRepository()
    {
        $projectAssignment = new \Ms\Empadministration\Domain\Model\ProjectAssignment();

        $projectAssignmentRepository = $this->getMockBuilder(\::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $projectAssignmentRepository->expects(self::once())->method('add')->with($projectAssignment);
        $this->inject($this->subject, 'projectAssignmentRepository', $projectAssignmentRepository);

        $this->subject->createAction($projectAssignment);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenProjectAssignmentToView()
    {
        $projectAssignment = new \Ms\Empadministration\Domain\Model\ProjectAssignment();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('projectAssignment', $projectAssignment);

        $this->subject->editAction($projectAssignment);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenProjectAssignmentInProjectAssignmentRepository()
    {
        $projectAssignment = new \Ms\Empadministration\Domain\Model\ProjectAssignment();

        $projectAssignmentRepository = $this->getMockBuilder(\::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $projectAssignmentRepository->expects(self::once())->method('update')->with($projectAssignment);
        $this->inject($this->subject, 'projectAssignmentRepository', $projectAssignmentRepository);

        $this->subject->updateAction($projectAssignment);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenProjectAssignmentFromProjectAssignmentRepository()
    {
        $projectAssignment = new \Ms\Empadministration\Domain\Model\ProjectAssignment();

        $projectAssignmentRepository = $this->getMockBuilder(\::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $projectAssignmentRepository->expects(self::once())->method('remove')->with($projectAssignment);
        $this->inject($this->subject, 'projectAssignmentRepository', $projectAssignmentRepository);

        $this->subject->deleteAction($projectAssignment);
    }
}
