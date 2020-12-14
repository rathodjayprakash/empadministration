<?php
namespace Ms\Empadministration\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Jayprakash <jayprakash.yug@gmail.com>
 */
class OfficeTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Ms\Empadministration\Domain\Model\Office
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Ms\Empadministration\Domain\Model\Office();
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
    public function getAddressReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getAddress()
        );
    }

    /**
     * @test
     */
    public function setAddressForStringSetsAddress()
    {
        $this->subject->setAddress('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'address',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getContactDetailsReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getContactDetails()
        );
    }

    /**
     * @test
     */
    public function setContactDetailsForStringSetsContactDetails()
    {
        $this->subject->setContactDetails('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'contactDetails',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDepartmentsReturnsInitialValueForDepartment()
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getDepartments()
        );
    }

    /**
     * @test
     */
    public function setDepartmentsForObjectStorageContainingDepartmentSetsDepartments()
    {
        $department = new \Ms\Empadministration\Domain\Model\Department();
        $objectStorageHoldingExactlyOneDepartments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneDepartments->attach($department);
        $this->subject->setDepartments($objectStorageHoldingExactlyOneDepartments);

        self::assertAttributeEquals(
            $objectStorageHoldingExactlyOneDepartments,
            'departments',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function addDepartmentToObjectStorageHoldingDepartments()
    {
        $department = new \Ms\Empadministration\Domain\Model\Department();
        $departmentsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $departmentsObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($department));
        $this->inject($this->subject, 'departments', $departmentsObjectStorageMock);

        $this->subject->addDepartment($department);
    }

    /**
     * @test
     */
    public function removeDepartmentFromObjectStorageHoldingDepartments()
    {
        $department = new \Ms\Empadministration\Domain\Model\Department();
        $departmentsObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->setMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $departmentsObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($department));
        $this->inject($this->subject, 'departments', $departmentsObjectStorageMock);

        $this->subject->removeDepartment($department);
    }
}
