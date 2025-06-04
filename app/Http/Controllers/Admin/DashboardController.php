<?php

namespace App\Http\Controllers\Admin;

use app\Libraries\Core\Http\Controller\AbstractController;
use App\Models\Migration;

class DashboardController extends AbstractController
{
    public function index(): string
    {
        return view('admin.index', [
            'migrations' => Migration::all(),
        ]);
    }
}
