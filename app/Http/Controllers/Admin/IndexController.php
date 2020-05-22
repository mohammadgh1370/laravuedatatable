<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
//    use Authorizable;

//    public function __construct() {
//        $this->abilities = ['index' => 'dashboard'];
//    }

    // صفحه داشبورد
    public function index()
    {
        $adminCount    = Admin::count();
        $userCount     = User::count();
//        flash_success();
        return view('admin.dashboard', compact('adminCount', 'userCount'));
    }
}
