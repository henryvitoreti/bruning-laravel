<?php

namespace App\Http\Controllers;

use Prettus\Repository\Eloquent\BaseRepository;

class BaseController extends Controller
{
    public function __construct(private BaseRepository $repository, private string $resource) {}
}
