<?php

namespace App\Http\Controllers\Admin;

use App\Datatables\Admin\UserDatatable;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Laravue\Datatable\Resources\DataTableCollectionResource;

class UserController extends Controller
{
    use Authorizable;

    // صفحه لیست کاربران
    public function index(UserDatatable $datatable)
    {
        if (request()->ajax()) {
            $data = User::eloquentQuery(request('column'), request('dir', 'desc'), request('search'))
                ->with('info')->paginate(request('length'));
            return new DataTableCollectionResource($data);
        }

        $props = $datatable->toArray();
        return view('admin.user.index', compact('props'));
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->only('name', 'family', 'active'));
        return $this->jsonResponse(1, null,'با موفقیت انجام شد');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->jsonResponse(1, null,'با موفقیت انجام شد');
    }

    public function active(User $user)
    {
        $user->update(['active' => !$user->active]);
        return $this->jsonResponse(1, null,'با موفقیت انجام شد');
    }
}
