<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;
use Yajra\Auditable\AuditableWithDeletesTrait;

class Unit extends Model
{
    use AuditableWithDeletesTrait, SoftDeletes, HasStatuses;
}
