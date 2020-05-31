<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Datatable\DatatableColumn;
use App\Datatables\Admin\AdminDatatable;
use App\Datatables\User\UserDatatable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Laravue\Datatable\Resources\DataTableCollectionResource;

class AdminController extends Controller
{
    use Authorizable;

    // صفحه لیست ادمین ها
    public function index(AdminDatatable $datatable)
    {
        if (request()->ajax()) {
            $data = Admin::eloquentQuery(request('column'), request('dir', 'desc'), request('search'))
                ->with('roles')->paginate(request('length'));
            return new DataTableCollectionResource($data);
        }
//        flash_error();
        $props = $datatable->toArray();
        return view('admin.admin.index', compact('props'));
    }

    public function show(Admin $admin)
    {
        return $admin;
    }

    public function update(Request $request,Admin $admin)
    {
        $admin->update($request->only('name', 'family','active'));
        $role = Role::findById($request->role_id);
        $admin->syncRoles($role);
        return $this->jsonResponse(1,null,'با موفقیت انجام شد');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->jsonResponse(1,null,'با موفقیت انجام شد');
    }

    public function active(Admin $admin)
    {
        $admin->update(['active' => !$admin->active]);
        return $this->jsonResponse(1,null,'با موفقیت انجام شد');
    }
}
