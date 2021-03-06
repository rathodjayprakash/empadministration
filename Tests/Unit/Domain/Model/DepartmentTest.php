<?php
namespace Ms\Empadministration\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Jayprakash <jayprakash.yug@gmail.com>
 */
class DepartmentTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Ms\Empadministration\Domain\Model\Department
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Ms\Empadministration\Domain\Model\Department();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getProjectsReturnsInitialValueForProject()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getProjects()
        );
    }

    /**
     * @test
     */
    public function setProjectsForObjectStorageContainingProjectSetsProjects()
    {
        $project = new \Ms\Empadministration\Domain\Model\Project();
        $objectStorageHoldingExactlyOneProjects = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneProjects->attach($project);
        $this->subject->setProjects($objectStorageHoldingExactlyOneProjects);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneProjects,
            'projects',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addProjectToObjectStorageHoldingProjects()
    {
        $project = new \Ms\Empadministration\Domain\Model\Project();
        $projectsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $projectsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($project));
        $this->inject($this->subject, 'projects', $projectsObjectStorageMock);

        $this->subject->addProject($project);
    }

    /**
     * @test
     */
    public function removeProjectFromObjectStorageHoldingProjects()
    {
        $project = new \Ms\Empadministration\Domain\Model\Project();
        $projectsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $projectsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($project));
        $this->inject($this->subject, 'projects', $projectsObjectStorageMock);

        $this->subject->removeProject($project);
    }

    /**
     * @test
     */
    public function getEmployeesReturnsInitialValueForEmployee()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getEmployees()
        );
    }

    /**
     * @test
     */
    public function setEmployeesForObjectStorageContainingEmployeeSetsEmployees()
    {
        $employee = new \Ms\Empadministration\Domain\Model\Employee();
        $objectStorageHoldingExactlyOneEmployees = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneEmployees->attach($employee);
        $this->subject->setEmployees($objectStorageHoldingExactlyOneEmployees);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneEmployees,
            'employees',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addEmployeeToObjectStorageHoldingEmployees()
    {
        $employee = new \Ms\Empadministration\Domain\Model\Employee();
        $employeesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $employeesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($employee));
        $this->inject($this->subject, 'employees', $employeesObjectStorageMock);

        $this->subject->addEmployee($employee);
    }

    /**
     * @test
     */
    public function removeEmployeeFromObjectStorageHoldingEmployees()
    {
        $employee = new \Ms\Empadministration\Domain\Model\Employee();
        $employeesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $employeesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($employee));
        $this->inject($this->subject, 'employees', $employeesObjectStorageMock);

        $this->subject->removeEmployee($employee);
    }
}
