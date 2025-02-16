<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Repositories\EmployeeRepository;
use App\Services\EmployeeService;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class EmployeeController extends BaseController
{
    use ResponseTrait;

    /** @var EmployeeService $service */
    protected EmployeeService $service;

    /**
     * @param EmployeeRepository $repository
     * @param string $resource
     */
    public function __construct(EmployeeRepository $repository, string $resource = EmployeeResource::class)
    {
        $this->service = app(EmployeeService::class);
        parent::__construct($repository, $resource);
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $employees = $this->repository->list();
        return $this->response($this->resource::collection($employees)->resolve());
    }

    /**
     * @param EmployeeRequest $request
     * @return JsonResponse
     */
    public function store(EmployeeRequest $request): JsonResponse
    {
        try {
            $employee = $this->service->store($request);
        } catch (Exception $exception) {
            return $this->response(['message' => $exception->getMessage()], $exception->getCode());
        }

        return $this->response((new $this->resource($employee))->resolve());
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $employee = $this->repository->findWithoutFail($id);

        if (!$employee) {
            return $this->response(['message' => 'Funcionário não encontrado.'], 400);
        }

        return $this->response((new $this->resource($employee))->resolve());
    }

    /**
     * @param int $id
     * @param EmployeeRequest $request
     * @return JsonResponse
     */
    public function update(int $id, EmployeeRequest $request): JsonResponse
    {
        $employee = $this->repository->findWithoutFail($id);

        if (!$employee) {
            return $this->response(['message' => 'Funcionário não encontrado.'], 400);
        }

        try {
            $employee = $this->service->update($id, $request);
        } catch (Exception $exception) {
            return $this->response(['message' => $exception->getMessage()], $exception->getCode());
        }

        return $this->response((new $this->resource($employee))->resolve());
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $employee = $this->repository->findWithoutFail($id);

        if (!$employee) {
            return $this->response(['message' => 'Funcionário não encontrado.'], 400);
        }

        $employee->delete();
        return $this->response([], 204);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function restore($id): JsonResponse
    {
        $employee = $this->repository->findWithTrash($id);

        if (!$employee) {
            return $this->response(['message' => 'Funcionário não encontrado.'], 400);
        }

        $employee->restore();
        return $this->response((new $this->resource($employee))->resolve());
    }
}

