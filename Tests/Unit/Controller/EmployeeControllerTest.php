<?php
namespace Ms\Empadministration\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Jayprakash <jayprakash.yug@gmail.com>
 */
class EmployeeControllerTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Ms\Empadministration\Controller\EmployeeController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Ms\Empadministration\Controller\EmployeeController::class)
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
    public function listActionFetchesAllEmployeesFromRepositoryAndAssignsThemToView()
    {

        $allEmployees = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $employeeRepository = $this->getMockBuilder(\::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $employeeRepository->expects(self::once())->method('findAll')->will(self::returnValue($allEmployees));
        $this->inject($this->subject, 'employeeRepository', $employeeRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('employees', $allEmployees);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenEmployeeToView()
    {
        $employee = new \Ms\Empadministration\Domain\Model\Employee();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('employee', $employee);

        $this->subject->showAction($employee);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenEmployeeToEmployeeRepository()
    {
        $employee = new \Ms\Empadministration\Domain\Model\Employee();

        $employeeRepository = $this->getMockBuilder(\::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $employeeRepository->expects(self::once())->method('add')->with($employee);
        $this->inject($this->subject, 'employeeRepository', $employeeRepository);

        $this->subject->createAction($employee);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenEmployeeToView()
    {
        $employee = new \Ms\Empadministration\Domain\Model\Employee();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('employee', $employee);

        $this->subject->editAction($employee);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenEmployeeInEmployeeRepository()
    {
        $employee = new \Ms\Empadministration\Domain\Model\Employee();

        $employeeRepository = $this->getMockBuilder(\::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $employeeRepository->expects(self::once())->method('update')->with($employee);
        $this->inject($this->subject, 'employeeRepository', $employeeRepository);

        $this->subject->updateAction($employee);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenEmployeeFromEmployeeRepository()
    {
        $employee = new \Ms\Empadministration\Domain\Model\Employee();

        $employeeRepository = $this->getMockBuilder(\::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $employeeRepository->expects(self::once())->method('remove')->with($employee);
        $this->inject($this->subject, 'employeeRepository', $employeeRepository);

        $this->subject->deleteAction($employee);
    }
}
