<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use Yajra\Auditable\AuditableWithDeletesTrait;

class Product extends Model
{

    protected $fillable = ['description', 'unit_id', 'description', 'user_id', 'product_category_id', 'reference_number'];
    protected $dates = ['created_at', 'updated_at'];
    use AuditableWithDeletesTrait, SoftDeletes, HasStatuses;

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
