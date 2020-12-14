<?php
namespace Ms\Empadministration\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Jayprakash <jayprakash.yug@gmail.com>
 */
class EmployeeTest extends \TYPO3\TestingFramework\Core\Unit\UnitTestCase
{
    /**
     * @var \Ms\Empadministration\Domain\Model\Employee
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Ms\Empadministration\Domain\Model\Employee();
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
    public function getEmailReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail()
    {
        $this->subject->setEmail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'email',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPhoneNumberReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPhoneNumber()
        );
    }

    /**
     * @test
     */
    public function setPhoneNumberForStringSetsPhoneNumber()
    {
        $this->subject->setPhoneNumber('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'phoneNumber',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPasswordReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getPassword()
        );
    }

    /**
     * @test
     */
    public function setPasswordForStringSetsPassword()
    {
        $this->subject->setPassword('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'password',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPositionReturnsInitialValueForPositions()
    {
        self::assertEquals(
            null,
            $this->subject->getPosition()
        );
    }

    /**
     * @test
     */
    public function setPositionForPositionsSetsPosition()
    {
        $positionFixture = new \Ms\Empadministration\Domain\Model\Positions();
        $this->subject->setPosition($positionFixture);

        self::assertAttributeEquals(
            $positionFixture,
            'position',
            $this->subject
        );
    }
}
