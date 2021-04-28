<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Traits\ResponsesWithPaginationInformation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ResponsesWithPaginationInformation, ValidatesRequests;

    protected const ITEMS_PER_PAGE = 15;

    protected $perPage = self::ITEMS_PER_PAGE;

    public function __construct(Request $request)
    {
        $this->perPage = $request->per_page ?? self::ITEMS_PER_PAGE;
    }
}
