<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const TABLE_NAME = 'roles';
    protected $table = self::TABLE_NAME;
    protected $primaryKey = 'id';
    protected $fillable = ['role'];
}
