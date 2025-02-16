<?php

namespace App\Http\Controllers;

use Prettus\Repository\Eloquent\BaseRepository;

class BaseController extends Controller
{
    public function __construct(protected BaseRepository $repository, protected string $resource) {}
}
