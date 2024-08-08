<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BookUser extends Pivot
{
    use HasFactory;
    public const TABLE_NAME = 'book_user';
    protected $table = self::TABLE_NAME;

    protected $casts = [
        'expire_date' => 'date',
        'borrowed_date' => 'date',
        'returned_date' => 'date',
    ];



}
