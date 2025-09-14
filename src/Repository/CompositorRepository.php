<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Compositor;
use App\Entity\Period;
use App\Enum\QueryParametersType;
use Matrix\Database\EntityRepository;

class CompositorRepository extends EntityRepository
{
    /**
     * @return Compositor[]
     */
    public function findAllCompositors(array $queries = []): array
    {
        $where = '';
        $binds = [];
        $order = ' ORDER BY compositor.birth';

        if (!empty($queries)) {
            $clean = QueryParametersType::filter($queries);
            $where = $this->addFilters($binds, $clean);
            $order = $this->addOrder($order, $clean);
        }

        $query = 'SELECT * FROM compositor' . $where . $order;

        $data = $this->queryFetchAll($query, Compositor::class, $binds);

        return $data;
    }

    public function findCompositor(int $id): null|Compositor
    {
        $query = 'SELECT compositor.*, 
            GROUP_CONCAT(period_compositor.period_id SEPARATOR ", ") as periods
            FROM compositor
            LEFT JOIN period_compositor ON period_compositor.compositor_id = compositor.id
            WHERE compositor.id = :id
            GROUP BY compositor.id';

        $data = $this->queryFetch($query, Compositor::class, ['id' => $id]);

        return $data;
    }

    public function findCompositorsByPeriod(Period $period): array
    {
        $query = 'SELECT 
            compositor.id, 
            compositor.lastname, 
            compositor.firstname, 
            compositor.birth, 
            compositor.death
            FROM compositor 
            INNER JOIN period_compositor ON period_compositor.compositor_id = compositor.id
            WHERE period_compositor.period_id = :id';

        $data = $this->queryFetchAll($query, Compositor::class, ['id' => $period->getId()]);

        return $data;
    }

    public function addCompositor(Compositor $compositor): int
    {
        $id = 0;

        $query = 'INSERT INTO compositor (id, lastname, firstname, birth, death, origin, figure)
            VALUES (NULL, :lastname, :firstname, :birth, :death, :origin, :figure)';
        $params = $this->populateCompositor($compositor);

        $id = $this->queryInsert($query, $params);

        if (0 < $id) {
            foreach ($compositor->periods as $period) {
                $query = 'INSERT INTO period_compositor (period_id, compositor_id) VALUES (?, ?)';
                $this->queryInsert($query, [$period, $id]);
            }
        }

        return $id;
    }

    public function updateCompositor(Compositor $compositor): int
    {
        $qty = 0;

        $query = 'UPDATE compositor
            SET lastname = :lastname, firstname = :firstname, birth = :birth, death = :death, origin = :origin, figure = :figure
            WHERE compositor.id = :id';
        $params = $this->populateCompositor($compositor);

        $qty = $this->queryEdit($query, ['id' => $compositor->getId(), ...$params]);

        return $qty;
    }

    public function deleteCompositor(Compositor $compositor): int
    {
        $qty = 0;

        $query = 'DELETE FROM period_compositor WHERE period_compositor.compositor_id = :id';
        $qty = $this->queryEdit($query, ['id' => $compositor->getId()]);

        $query = 'DELETE FROM compositor WHERE compositor.id = :id';
        $qty = $this->queryEdit($query, ['id' => $compositor->getId()]);

        return $qty;
    }

    private function populateCompositor(Compositor $compositor): array
    {
        return [
            'lastname' => $compositor->getLastname(),
            'firstname' => $compositor->getFirstname(),
            "birth" => $compositor->getBirth(),
            "death"  => $compositor->getDeath(),
            "origin"  => $compositor->getOrigin(),
            "figure" => $compositor->getFigure(),
        ];
    }

    private function addFilters(array &$binds, array $queries): string
    {
        $clauses = [];
        $keys = array_keys($queries);
        $filtering = QueryParametersType::getFilteringCases($keys);
        $searching = QueryParametersType::getSearchingCases($keys);

        foreach ($filtering as $case) {
            $binds[$case->value] = $queries[$case->value];
            $clauses[] = QueryParametersType::getWhereStatement($case);
        }

        foreach ($searching as $case) {
            $binds[$case->value] = "%" . $queries[$case->value] . "%";
            $clauses[] = QueryParametersType::getWhereStatement($case);
        }

        $where = empty($clauses) ? '' : ' WHERE ' . implode(' AND ', $clauses);

        return $where;
    }

    private function addOrder(string $order, array $queries): string
    {
        $sort = QueryParametersType::Sort->value;

        if (array_key_exists($sort, $queries) && in_array($queries[$sort], Compositor::getSortableFields())) {
            $order = ' ORDER BY compositor.' . $queries[$sort];
        }

        $order .= true === array_key_exists(QueryParametersType::Desc->value, $queries) ? ' DESC' : '';

        return $order;
    }
}
