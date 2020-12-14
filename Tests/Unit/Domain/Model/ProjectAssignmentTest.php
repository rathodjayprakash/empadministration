<?php
namespace Ms\Empadministration\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Jayprakash <jayprakash.yug@gmail.com>
 */
class ProjectAssignmentTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Ms\Empadministration\Domain\Model\ProjectAssignment
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Ms\Empadministration\Domain\Model\ProjectAssignment();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getHoursFromReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getHoursFrom()
        );
    }

    /**
     * @test
     */
    public function setHoursFromForDateTimeSetsHoursFrom()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setHoursFrom($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'hoursFrom',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getHoursToReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getHoursTo()
        );
    }

    /**
     * @test
     */
    public function setHoursToForDateTimeSetsHoursTo()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setHoursTo($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'hoursTo',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getTaskInfoReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getTaskInfo()
        );
    }

    /**
     * @test
     */
    public function setTaskInfoForStringSetsTaskInfo()
    {
        $this->subject->setTaskInfo('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'taskInfo',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getProjectReturnsInitialValueForProject()
    {
        self::assertEquals(
            null,
            $this->subject->getProject()
        );
    }

    /**
     * @test
     */
    public function setProjectForProjectSetsProject()
    {
        $projectFixture = new \Ms\Empadministration\Domain\Model\Project();
        $this->subject->setProject($projectFixture);

        self::assertAttributeEquals(
            $projectFixture,
            'project',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEmployeeReturnsInitialValueForEmployee()
    {
        self::assertEquals(
            null,
            $this->subject->getEmployee()
        );
    }

    /**
     * @test
     */
    public function setEmployeeForEmployeeSetsEmployee()
    {
        $employeeFixture = new \Ms\Empadministration\Domain\Model\Employee();
        $this->subject->setEmployee($employeeFixture);

        self::assertAttributeEquals(
            $employeeFixture,
            'employee',
            $this->subject
        );
    }
}
