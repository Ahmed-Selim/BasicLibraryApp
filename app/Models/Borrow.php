<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Borrow extends Pivot
{
    protected $primaryKey = 'borrow_id';
}
