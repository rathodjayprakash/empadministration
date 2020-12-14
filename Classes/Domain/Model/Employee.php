<?php
namespace Ms\Empadministration\Domain\Model;


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
 * Employee
 */
class Employee extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * name
     * 
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $name = '';

    /**
     * email
     * 
     * @var string
     */
    protected $email = '';

    /**
     * phoneNumber
     * 
     * @var string
     */
    protected $phoneNumber = '';

    /**
     * NOT specified so -  One employee can have one position at a time
     * 
     * @var \Ms\Empadministration\Domain\Model\Positions
     */
    protected $position = null;

    /**
     * password
     * 
     * @var string
     */
    protected $password = '';

    /**
     * __construct
     */
    public function __construct()
    {

        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
    }

    /**
     * Returns the name
     * 
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name
     * 
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the email
     * 
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     * 
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns the phoneNumber
     * 
     * @return string $phoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Sets the phoneNumber
     * 
     * @param string $phoneNumber
     * @return void
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Returns the position
     * 
     * @return \Ms\Empadministration\Domain\Model\Positions $position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Sets the position
     * 
     * @param \Ms\Empadministration\Domain\Model\Positions $position
     * @return void
     */
    public function setPosition(\Ms\Empadministration\Domain\Model\Positions $position)
    {
        $this->position = $position;
    }

    /**
     * Returns the password
     * 
     * @return string $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the password
     * 
     * @param string $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
