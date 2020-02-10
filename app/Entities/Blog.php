<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use Yajra\Auditable\AuditableWithDeletesTrait;

class Blog extends BaseModel
{
    use AuditableWithDeletesTrait, SoftDeletes, HasStatuses;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'blog_category_id',
    ];

    public function Category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

}
