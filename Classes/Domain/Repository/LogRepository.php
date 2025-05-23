<?php
namespace EWW\Dpf\Domain\Repository;

/*
* This file is part of the TYPO3 CMS project.
*
* It is free software; you can redistribute it and/or modify it under
* the terms of the GNU General Public License, either version 2
* of the License, or any later version.
*
* For the full copyright and license information, please read the
* LICENSE.txt file that was distributed with this source code.
*
* The TYPO3 project - inspiring people to share!
*/

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class LogRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'time_micro' => QueryInterface::ORDER_DESCENDING
    ];

    public function initializeObject()
    {
        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * @param string $requestId
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByRequestId(string $requestId)
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->equals('request_id', $requestId)
        )->execute();
    }

    /**
     * @param int $level
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByLevel(int $level)
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->equals('level', $level)
        )->execute();
    }

    /**
     * @param string $component
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByComponent(string $component)
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->equals('component', $component)
        )->execute();
    }

    /**
     * @param int $limit
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findLatestLogs(int $limit = 50)
    {
        $query = $this->createQuery();
        $query->setOrderings(['time_micro' => QueryInterface::ORDER_DESCENDING]);
        $query->setLimit($limit);
        return $query->execute();
    }

    /**
     * @param array $clientIds
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findByClientIds(array $clientIds)
    {
        $query = $this->createQuery();
        return $query->matching(
            $query->in('client_id', $clientIds)
        )->execute();
    }

    public function findByFilters(
        string $sortField = 'timeMicro',
        string $sortDirection = 'desc',
        ?string $requestId = null,
        ?string $component = null,
        ?float $fromTime = null,
        ?float $toTime = null,
        ?array $clientIds = null,
        ?int $level = null
    ): array {

        // Map frontend fieldnames to backend fieldnames
        $fieldMapping = [
            'timeMicro' => 'time_micro',
            'requestId' => 'request_id',
            'component' => 'component',
            'level' => 'level',
            'clientId' => 'client_id'
        ];

        $sortField = $fieldMapping[$sortField] ?? $sortField;


        $query = $this->createQuery();
        $constraints = [];

        if ($requestId !== null) {
            $constraints[] = $query->like('requestId', '%' . $requestId . '%');
        }

        if ($component !== null) {
            $constraints[] = $query->like('component', '%' . $component . '%');
        }

        if ($fromTime !== null) {
            $constraints[] = $query->greaterThanOrEqual('timeMicro', $fromTime);
        }

        if ($toTime !== null) {
            $constraints[] = $query->lessThanOrEqual('timeMicro', $toTime);
        }

        if ($clientIds !== null) {
            $constraints[] = $query->in('client_id', $clientIds);
        }

        if ($level !== null) {
            $constraints[] = $query->equals('level', $level);
        }

        if (count($constraints) > 0) {
            $query->matching($query->logicalAnd($constraints));
        }

        $sortField = empty($sortField) ? 'time_micro' : $sortField;
        $sortDirection = empty($sortDirection) ? 'desc' : $sortDirection;

        $direction = $sortDirection === 'asc' ? QueryInterface::ORDER_ASCENDING : QueryInterface::ORDER_DESCENDING;

        $query->setOrderings([$sortField => $direction]);

        return $query->execute()->toArray();
    }

}
