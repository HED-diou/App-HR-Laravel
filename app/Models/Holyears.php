<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holyears extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'holyears';
    protected $fillable = [
        'year_id',
        'holiday_id',
    ];

    public $timestamps = false;
}
