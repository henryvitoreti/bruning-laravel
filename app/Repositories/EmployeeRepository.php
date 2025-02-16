<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EmployeeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Employee::class;
    }

    /**
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function list(): mixed
    {
        return $this->orderBy('created_at', 'desc')->get();
    }

    /**
     * @param int $id
     * @return LengthAwarePaginator|Collection|mixed
     */
    public function findWithTrash(int $id): mixed
    {
        return $this->where('id', $id)->withTrashed()->first();
    }
}
