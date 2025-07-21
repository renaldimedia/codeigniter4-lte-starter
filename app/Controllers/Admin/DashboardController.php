<?php

namespace App\Controllers\Admin;
use App\Controllers\Admin\BaseController;

class DashboardController extends BaseController
{
    public function index(): string
    {
        return view('admin/dashboard');
    }
}
