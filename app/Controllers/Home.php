<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('admin/dashboard');
    }

    public function child1(): string
    {
        $data = [];
        $data['title'] = "Child 1 Page";
        return view('admin/child1', $data);
    }
}
