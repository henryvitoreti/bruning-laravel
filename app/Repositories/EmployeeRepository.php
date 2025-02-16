<?php

namespace App\Repositories;

use App\Models\Employee;
use Prettus\Repository\Eloquent\BaseRepository;

class EmployeeRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Employee::class;
    }
}
