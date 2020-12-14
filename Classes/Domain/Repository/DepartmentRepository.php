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
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * The repository for Offices
 */
class DepartmentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = ['crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING];


    public function findDepartmentByProjectId($uid) {
        if(empty($uid))
            return;

        $query = $this->createQuery();
        $queryString = "SELECT * FROM tx_empadministration_domain_model_department WHERE deleted = 0 AND hidden = 0 AND FIND_IN_SET(" . $uid . ", projects)";
        
        $query->statement($queryString);
        return $query->execute();
    }

    public function getAllEmployeesAndProjectsOfDepartment($uid = null) {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('tx_empadministration_domain_model_department');

        $queryBuilder = $connection->createQueryBuilder();
        $query = $queryBuilder
            ->select('employees', 'projects')
            ->from('tx_empadministration_domain_model_department');

        if(!empty($uid)) {
            $whereExpressions = [
                $queryBuilder->expr()->eq('uid', $uid)
            ];
            $queryBuilder->where(...$whereExpressions);
        }
        return $query->execute()->fetchAll();
    }
}
