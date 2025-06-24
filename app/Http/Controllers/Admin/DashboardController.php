<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\Core\Http\Controller\AbstractController;
use App\Models\Migration;
use App\Models\Restaurant;
use App\Models\User;


class DashboardController extends AbstractController
{
    public function index(): string
    {
        return view('admin.index', [
            'migrations' => Migration::all(),
        ]);

    }
    public function showUsers()
    {
        return view('admin.showUsers', [
            'users' => User::all(),
        ]);
    }
}
