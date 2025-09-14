<?php

declare(strict_types=1);

namespace App\Repository;

use Matrix\Database\EntityRepository;
use App\Entity\Period;

class PeriodRepository extends EntityRepository
{
    /**
     * @return Period[]
     */
    public function findAllPeriods(): array
    {
        $query = 'SELECT
            period.id,
            period.name,
            period.begin,
            COALESCE(period.end, YEAR(CURDATE())) as end,
            period.tag
            FROM period ORDER BY period.begin';

        $data = $this->queryFetchAll($query, Period::class);

        return $data;
    }

    public function findPeriod(int $id): null|Period
    {
        $query = 'SELECT * FROM period WHERE period.id = :id';
        
        $data = $this->queryFetch($query, Period::class, ['id' => $id]);

        return $data;
    }

    public function updatePeriod(Period $period): int
    {
        $qty = 0;

        $query = 'UPDATE period
            SET name = :name, begin = :begin, end = :end, tag = :tag, description = :description
            WHERE period.id = :id';
        $params = $this->populatePeriod($period);

        $qty = $this->queryEdit($query, ['id' => $period->getId(), ...$params]);

        return $qty;
    }

    public function matchPeriods(array $periods): array
    {
        $in = str_repeat('?,', count($periods) - 1) . '?';

        $query = 'SELECT period.id FROM period WHERE period.id IN ( '. $in .')';

        $data = $this->queryFetchEnumerate($query, $periods);

        return $data;
    }

    private function populatePeriod(Period $period): array
    {
        return [
            'name' => $period->getName(),
            'begin' => $period->getBegin(),
            "end" => $period->getEnd(),
            "tag"  => $period->getTag(),
            "description"  => $period->getDescription(),
        ];
    }
}
