<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Prettus\Repository\Eloquent\BaseRepository as PrettusRepository;

abstract class BaseRepository extends PrettusRepository
{
    /**
     * @param $id
     * @param array $columns
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function findWithoutFail($id, array $columns = ['*']): mixed
    {
        try {
            return $this->find($id, $columns);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }
}
