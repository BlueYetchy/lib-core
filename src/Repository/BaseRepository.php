<?php


namespace BlueYetchy\LibCore\Repository;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository
{

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = resolve($this->getModelClass());
    }

    /**
     * @return Model
     */
    public function eloquent(): Model
    {
        return $this->model;
    }

    /**
     * @param string? $alias
     *
     * @return Builder
     */
    public function rawQuery($alias = null): Builder
    {
        $tableName = $this->model->getTable();

        return DB::table(isset($alias) ? $tableName . ' as ' . $alias : $tableName);
    }

    /**
     * @param $model
     *
     * @return Model
     *
     * @throws ModelNotFoundException
     */
    public function getModel($model): Model
    {
        if (!$model instanceof Model) {
            $model = $this->model::query()->findOrFail($model);
        }

        return $model;
    }

    /**
     * Return class name to of model to inject in the respisotry
     *
     * @return string
     */
    abstract protected function getModelClass(): string;
}