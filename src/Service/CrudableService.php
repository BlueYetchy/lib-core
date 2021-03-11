<?php


namespace BlueYetchy\LibCore\Service;


use BlueYetchy\LibCore\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class CrudableService
{
    /**
     * @var BaseRepository
     */
    protected BaseRepository $repository;

    public function __construct()
    {
        $this->repository = resolve($this->getRepositoryClass());
    }

    /**
     * Get all of the models from the database.
     *
     * @param string[] $columns
     * @param array    $with
     *
     * @return array|Collection
     */
    public function all($columns = ['*'], $with = []): array|Collection
    {
        return $this->repository->eloquent()->with($with)->get($columns);
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param int|string $id
     * @param string[]   $columns
     * @param array      $with
     *
     * @return Model
     * @throws ModelNotFoundException
     */
    public function getById(int|string $id, $columns = ['*'], array $with = []): Model
    {
        return $this->repository->eloquent()->query()->with($with)->findOrFail($id, $columns);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param array $attributes
     *
     * @return Model
     */
    public function create($attributes = []): Model
    {
        return $this->repository->eloquent()->query()->create($attributes);
    }

    /**
     * Delete records from the database.
     *
     * @param Model|int|string $model
     *
     * @return bool|null
     *
     * @throws \Exception|ModelNotFoundException
     */
    public function delete(Model|int|string $model): ?bool
    {
        $model = $this->repository->getModel($model);

        return $model->delete();
    }

    /**
     * Update the model in the database.
     *
     * @param Model|int|string $model
     * @param array            $attributes
     * @param array            $options
     *
     * @return bool|int
     *
     * @throws ModelNotFoundException
     */
    public function update(Model|int|string $model, $attributes = [], $options = []): bool|int
    {
        $model = $this->repository->getModel($model);

        return $model->update($attributes, $options);
    }

    /**
     * Return instance of the repository
     *
     * @return BaseRepository
     */
    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }

    /**
     * Return relative repository abstract class to set property into constructor
     *
     * @return string
     */
    abstract protected function getRepositoryClass(): string;
}