<?php
namespace Ms\Empadministration\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Jayprakash <jayprakash.yug@gmail.com>
 */
class PositionsControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Ms\Empadministration\Controller\PositionsController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Ms\Empadministration\Controller\PositionsController::class)
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
    public function listActionFetchesAllPositionssFromRepositoryAndAssignsThemToView()
    {

        $allPositionss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $positionsRepository = $this->getMockBuilder(\::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $positionsRepository->expects(self::once())->method('findAll')->will(self::returnValue($allPositionss));
        $this->inject($this->subject, 'positionsRepository', $positionsRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('positionss', $allPositionss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenPositionsToView()
    {
        $positions = new \Ms\Empadministration\Domain\Model\Positions();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('positions', $positions);

        $this->subject->showAction($positions);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenPositionsToPositionsRepository()
    {
        $positions = new \Ms\Empadministration\Domain\Model\Positions();

        $positionsRepository = $this->getMockBuilder(\::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $positionsRepository->expects(self::once())->method('add')->with($positions);
        $this->inject($this->subject, 'positionsRepository', $positionsRepository);

        $this->subject->createAction($positions);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenPositionsToView()
    {
        $positions = new \Ms\Empadministration\Domain\Model\Positions();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('positions', $positions);

        $this->subject->editAction($positions);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenPositionsInPositionsRepository()
    {
        $positions = new \Ms\Empadministration\Domain\Model\Positions();

        $positionsRepository = $this->getMockBuilder(\::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $positionsRepository->expects(self::once())->method('update')->with($positions);
        $this->inject($this->subject, 'positionsRepository', $positionsRepository);

        $this->subject->updateAction($positions);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPositionsFromPositionsRepository()
    {
        $positions = new \Ms\Empadministration\Domain\Model\Positions();

        $positionsRepository = $this->getMockBuilder(\::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $positionsRepository->expects(self::once())->method('remove')->with($positions);
        $this->inject($this->subject, 'positionsRepository', $positionsRepository);

        $this->subject->deleteAction($positions);
    }
}
