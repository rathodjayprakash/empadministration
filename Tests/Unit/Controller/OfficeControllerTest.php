<?php
namespace Ms\Empadministration\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Jayprakash <jayprakash.yug@gmail.com>
 */
class OfficeControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Ms\Empadministration\Controller\OfficeController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Ms\Empadministration\Controller\OfficeController::class)
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
    public function listActionFetchesAllOfficesFromRepositoryAndAssignsThemToView()
    {

        $allOffices = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $officeRepository = $this->getMockBuilder(\Ms\Empadministration\Domain\Repository\OfficeRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $officeRepository->expects(self::once())->method('findAll')->will(self::returnValue($allOffices));
        $this->inject($this->subject, 'officeRepository', $officeRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('offices', $allOffices);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenOfficeToView()
    {
        $office = new \Ms\Empadministration\Domain\Model\Office();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('office', $office);

        $this->subject->showAction($office);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenOfficeToOfficeRepository()
    {
        $office = new \Ms\Empadministration\Domain\Model\Office();

        $officeRepository = $this->getMockBuilder(\Ms\Empadministration\Domain\Repository\OfficeRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $officeRepository->expects(self::once())->method('add')->with($office);
        $this->inject($this->subject, 'officeRepository', $officeRepository);

        $this->subject->createAction($office);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenOfficeToView()
    {
        $office = new \Ms\Empadministration\Domain\Model\Office();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('office', $office);

        $this->subject->editAction($office);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenOfficeInOfficeRepository()
    {
        $office = new \Ms\Empadministration\Domain\Model\Office();

        $officeRepository = $this->getMockBuilder(\Ms\Empadministration\Domain\Repository\OfficeRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $officeRepository->expects(self::once())->method('update')->with($office);
        $this->inject($this->subject, 'officeRepository', $officeRepository);

        $this->subject->updateAction($office);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenOfficeFromOfficeRepository()
    {
        $office = new \Ms\Empadministration\Domain\Model\Office();

        $officeRepository = $this->getMockBuilder(\Ms\Empadministration\Domain\Repository\OfficeRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $officeRepository->expects(self::once())->method('remove')->with($office);
        $this->inject($this->subject, 'officeRepository', $officeRepository);

        $this->subject->deleteAction($office);
    }
}
