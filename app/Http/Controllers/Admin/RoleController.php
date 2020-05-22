<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\RoleDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Traits\Authorizable;
use Laravue\Datatable\Resources\DataTableCollectionResource;

class RoleController extends Controller
{
    use Authorizable;

    public function index(RoleDatatable $datatable)
    {
        if (request()->ajax()) {
            $query = Role::eloquentQuery(request('column'), request('dir', 'desc'), request('search'))
                ->with('permissions');
            if (request('get')) {
                $data = $query->get();
            } else
                $data = $query->paginate(request('length'));
            return new DataTableCollectionResource($data);
        }
        $props = $datatable->toArray();
        return view('admin.role.index', compact('props'));
    }

    public function create()
    {
        $guards      = ['admin', 'user', 'doctor', 'pharmacy'];
        $permissions = Permission::all();
        return view('admin.role.create', compact('guards', 'permissions'));
    }

    // ذخیره مجوز
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->only('name', 'label', 'guard_name'));
        $role->syncPermissions($request->permission_id);
        flash_success();
        return back();
    }

    // ویرایش مجوز
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->only('name', 'label', 'guard_name'));
        $role->syncPermissions($request->permission_id);
        return $this->jsonResponse(1, null, 'عملیات با موفقیت انجام شد');
    }

    // حذف مجوز
    public function destroy(Role $role)
    {
        $role->delete();

        return $this->jsonResponse(1, null, 'عملیات با موفقیت انجام شد');
    }
}
