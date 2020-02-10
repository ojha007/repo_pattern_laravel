<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use Yajra\Auditable\AuditableWithDeletesTrait;

class BlogCategory extends BaseModel
{
    use AuditableWithDeletesTrait, SoftDeletes, HasStatuses;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',

    ];


    public function Category()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
