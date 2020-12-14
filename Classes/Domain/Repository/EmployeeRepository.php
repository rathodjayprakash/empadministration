<?php
namespace Ms\Empadministration\Domain\Repository;


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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * The repository for Offices
 */
class EmployeeRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = ['crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING];

    public function findEmployeeByEmail($email) {
        $query = $this->createQuery();
        $query->matching($query->equals('email', $email));
        return $query->execute();
    }

    public function findEmployeeNotIn($uidList) {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->logicalNot(
                    $query->in('uid', explode(",", $uidList)),
                )
            )
        );
        return $query->execute();
    }

    public function findEmployeeIn($uidList) {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->in('uid', explode(",", $uidList)),
            )
        );
        return $query->execute();
    }
}
