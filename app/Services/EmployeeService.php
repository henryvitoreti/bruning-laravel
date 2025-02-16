<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;

class EmployeeService
{
    /**
     * @param EmployeeRepository $repository
     */
    public function __construct(private EmployeeRepository $repository) {}
}
