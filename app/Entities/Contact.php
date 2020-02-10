<?php


namespace App\Entities;


use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Contact extends Model
{
    use HasRoles;
    protected $fillable = [
        'name', 'email', 'role',
    ];
}
