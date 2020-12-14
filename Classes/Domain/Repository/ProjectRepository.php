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
class ProjectRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = ['crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING];

    public function findProjectsByEmployeeId($uid) {
        $query = $this->createQuery();
        $queryString = "SELECT * FROM tx_empadministration_domain_model_project WHERE deleted = 0 AND hidden = 0 AND FIND_IN_SET(" . $uid . ", employees)";
        
        $query->statement($queryString);
        return $query->execute();
    }

    public function findProjectNotIn($uidList) {
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

    public function findProjectIn($uidList) {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->in('uid', explode(",", $uidList)),
            )
        );
        return $query->execute();
    }

}
