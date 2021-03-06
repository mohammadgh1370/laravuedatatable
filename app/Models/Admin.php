<?php

namespace App\Models;

use App\Traits\Appendable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravue\Datatable\Traits\LaraVueDatatableTrait;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles, Appendable,LaraVueDatatableTrait;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'family',
        'email',
        'mobile',
        'password',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active'            => 'boolean'
    ];

    protected $dataTableColumns = [
        'admin' => [
            'id'        => ['priority' => 10, 'searchable' => true],
            'full_name' => ['priority' => 10, 'searchable' => true, 'accessor' => ['name', 'family']],
            'mobile'    => ['priority' => 5, 'searchable' => true],
            'email'     => ['priority' => 5, 'searchable' => true],
        ],
    ];
}
