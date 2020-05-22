<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('put')) {
            return [
                'name'       => 'required|unique:roles,id,' . $this->route('role')->getKey(),
                'label'      => 'required|unique:roles,id,' . $this->route('role')->getKey(),
                'guard_name' => 'required|in:' . implode(',', ['admin', 'user', 'doctor', 'pharmacy']),
                'permission_id'   => 'required|array',
                'permission_id.*' => 'exists:permissions,id'
            ];
        }
        return [
            'name'            => 'required|unique:roles',
            'label'           => 'required|unique:roles',
            'guard_name'      => 'required|in:' . implode(',', ['admin', 'user', 'doctor', 'pharmacy']),
            'permission_id'   => 'required|array',
            'permission_id.*' => 'exists:permissions,id'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = null;
        if ($this->ajax()) {
            $response = new JsonResponse([
                'code'    => -1,
                'data'    => $validator->errors(),
                'message' => $validator->errors()->all(),
            ], 200);
        }

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
