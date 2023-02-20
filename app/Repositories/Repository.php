<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

class Repository
{

    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all posts.
     *
     * @return Collection Model $model
     */
    public function getAll($cols = ['*'] ,$with = [])
    {
        return $this->model->select($cols)->with($with)->get();
    }

    /**
     * Get post by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->where('id', $id)->get();
    }

    /**
     * Save Post
     *
     * @param $data
     * @return Model
     */
    public function save($data)
    {
        return  $this->model::create($data);
    }

    /**
     * Update Post
     *
     * @param $data
     * @return Model
     */
    public function update($data, $id)
    {

        $model = $this->model->find($id);
        $model->update($data);

        return $model;
    }

    /**
     * Update Post
     *
     * @param $data
     * @return Model
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        return $model->delete();
    }

}