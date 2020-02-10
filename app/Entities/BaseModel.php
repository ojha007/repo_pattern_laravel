<?php


namespace App\Entities;


use App\User;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $model;

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function UpdatedBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public  function status()
    {
        return [
            'pending', 'approved', 'viewed',
        ];
    }
}
