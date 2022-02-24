<?php


namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $orderBy
     * @param string $order
     * @return mixed
     */
    function all($orderBy = 'created_at', $order = 'desc')
    {
        return $this->model->orderBy($orderBy, $order)->get();
    }

    /**
     * @param int $perPage
     * @param string $orderBy
     * @param string $order
     * @return mixed
     */
    function paginate($perPage = 15, $orderBy = 'created_at', $order = 'desc')
    {
        return $this->model->orderBy($orderBy, $order)->paginate($perPage);
    }

    /**
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        return $result;
    }

    /**
     * @param array $data
     * @return mixed
     */
    function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    function storeAll(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    function update($id, array $data)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundHttpException("No result found!");
        }
        $result->update($data);
        return $this->find($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    function delete($id)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        return $result->delete();
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }
}