<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Prettus\Validator\Exceptions\ValidatorException;

class EmployeeService
{
    /**
     * @param EmployeeRepository $repository
     */
    public function __construct(protected EmployeeRepository $repository) {}

    /**
     * @param Request $request
     * @return LengthAwarePaginator|Collection|mixed
     * @throws ValidatorException
     */
    public function store(Request $request): mixed
    {
        return $this->repository->create($request->all());
    }

    /**
     * @param int $id
     * @param Request $request
     * @return LengthAwarePaginator|Collection|mixed
     * @throws ValidatorException
     */
    public function update(int $id, Request $request): mixed
    {
        return $this->repository->update($request->all(), $id);
    }
}
