<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class PermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('put')){
            return [
                'name'       => 'required|unique:permissions,id,'.$this->route('permission')->getKey(),
                'label'      => 'required|unique:permissions,id,'.$this->route('permission')->getKey(),
                'guard_name' => 'required|in:' . implode(',', ['admin', 'user', 'doctor', 'pharmacy']),
            ];
        }
        return [
            'name'       => 'required|unique:permissions',
            'label'      => 'required|unique:permissions',
            'guard_name' => 'required|in:' . implode(',', ['admin', 'user', 'doctor', 'pharmacy']),
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

        throw new \Illuminate\Validation\ValidationException($validator,$response);
    }
}
