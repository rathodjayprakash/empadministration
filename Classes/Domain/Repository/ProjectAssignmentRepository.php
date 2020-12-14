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
/**
 * The repository for Offices
 */
class ProjectAssignmentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = ['crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING];

    public function findHoursByEmployeeId($uid) {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('employee', $uid),
            )
        );
        return $query->execute();
    }
}
