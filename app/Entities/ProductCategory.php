<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use Yajra\Auditable\AuditableWithDeletesTrait;

class ProductCategory extends Model
{
    use AuditableWithDeletesTrait, SoftDeletes, HasStatuses;
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['name', 'product_category_id', 'status', 'description', 'abbreviation', 'slug',];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'];

    public function isRootParentCategory()
    {
        return self::whereNull('product_category_id');
    }

    public function childCategory()
    {
        return $this->hasMany(self::class, 'product_category_id', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(self::class, 'product_category_id');
    }

    public function parentCategoryRecursive()
    {
        return $this->parentCategory()->with('parentCategoryRecursive');
    }

    public function childCategoryRecursive()
    {
        return $this->childCategory()->with('childCategoryRecursive');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
