<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Repositories\EmployeeRepository;
use App\Services\EmployeeService;
use App\Traits\ResponseTrait;
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
        dd('index');
    }

    /**
     * @param EmployeeRequest $request
     * @return JsonResponse
     */
    public function store(EmployeeRequest $request): JsonResponse
    {
        dd('store');
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        dd('show');
    }

    /**
     * @param $id
     * @param EmployeeRequest $request
     * @return JsonResponse
     */
    public function update($id, EmployeeRequest $request): JsonResponse
    {
        dd('update');
    }
}

