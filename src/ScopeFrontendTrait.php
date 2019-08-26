<?php namespace PlanetaDelEste\Traits;

use PlanetaDelEste\Traits\Utils;

/**
 * Trait ScopeFrontendTrait
 *
 * @package PlanetaDelEste\Traits
 *
 * @method static \October\Rain\Database\Builder|static frontend(array $data, array $sort = [])
 */
trait ScopeFrontendTrait
{
    use Utils;

    public static function bootScopeFrontendTrait(){ }

    /**
     * @param \October\Rain\Database\Builder|static $query
     * @param array                                 $data
     * @param array                                 $sort
     *
     * @return \October\Rain\Database\Builder|static
     * @throws \Exception
     */
    public function scopeFrontend($query, $data, $sort = [])
    {
        $columns = $this->getFullTextIndexFields();

        foreach ($data as $column => $value) {
            if (in_array($column, $columns)) {
                $query->where($column, 'LIKE', "%{$value}%");
            }
        }

        if ($q = array_get($data, 'query')) {
            foreach ($columns as $column) {
                $query->where($column, 'LIKE', "%{$q}%", 'or');
            }
        }


        // Sort results
        if (!empty($sort)) {
            if ($column = array_get($sort, 'column')) {
                if (is_array($column)) {
                    $column = $column[0];
                }
                if ($column == 'created_at_formatted') {
                    $column = 'created_at';
                }
                $direction = array_get($sort, 'direction', 'asc');
                if (in_array($column, $columns)) {
                    $query->orderBy($column, $direction);
                }
            }
        }

        return $query;
    }
}
