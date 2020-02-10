<?php

namespace App\Http\Repositories\Contrasts;

abstract class Repository implements RepositoryInterface
{
    protected $model, $with = [];

    public function __call($method, $arguments)
    {
        return $this->model->{$method}(...$arguments);
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return object
     */
    public function create(array $attributes): object
    {
        return $this->model->create($attributes);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param $id
     * @param array $attributes
     * @return object
     */
    public function update($id, array $attributes): object
    {
        $record = $this->getById($id);
        $record->update($attributes);
        return $record;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function changeStatusTo($id, $status)
    {
        $record = $this->getById($id);
        $record->setStatus($status);
        return $record;
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param $att
     * @param $columns
     * @return mixed
     */
    public function findBy($att, $columns)
    {
        return $this->model->where($att, $columns);
    }

    /**
     * @param array $with
     * @return mixed
     */
    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    /**
     * @param $id
     * @param array $with
     * @return mixed
     */
    public function getByIdWithRelationShipArray($id, array $with = array())
    {
        $query = $this->make($with);
        return $query->find($id);
    }

    public function getAllWithRelationShipArray(array $with = array())
    {
        return $this->make($with);
    }

}
