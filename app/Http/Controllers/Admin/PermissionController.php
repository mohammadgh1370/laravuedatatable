<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\PermissionDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PermissionRequest;
use App\Models\Permission;
use App\Traits\Authorizable;
use Laravue\Datatable\Resources\DataTableCollectionResource;

class PermissionController extends Controller
{
    use Authorizable;

    // لیست مجوز ها
    public function index(PermissionDatatable $datatable)
    {
        if (\request()->ajax()) {
            $query = Permission::eloquentQuery(request('column'), request('dir', 'desc'), request('search'));
            if (request('get')) {
                $data = $query->get();
            } else
                $data = $query->paginate(request('length'));
            return new DataTableCollectionResource($data);
        }
        $props = $datatable->toArray();
        return view('admin.permission.index', compact('props'));
    }

    // صفحه ایجاد مجوز
    public function create()
    {
        $guards = ['admin', 'user', 'doctor', 'pharmacy'];

        return view('admin.permission.create', compact('guards'));
    }

    // ذخیره مجوز
    public function store(PermissionRequest $request)
    {
        Permission::create($request->only('name', 'label', 'guard_name'));
        flash_success();
        return back();
    }

    // ویرایش مجوز
    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update($request->only('name', 'label', 'guard_name'));

        return $this->jsonResponse(1, null, 'عملیات با موفقیت انجام شد');
    }

    // حذف مجوز
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return $this->jsonResponse(1, null, 'عملیات با موفقیت انجام شد');
    }
}
