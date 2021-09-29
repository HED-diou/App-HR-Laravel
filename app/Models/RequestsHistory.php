<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestsHistory extends Model
{

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'requests_history';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'start_date',
            'end_date',
            'dayscount',
            'updated_at',
            'comment',
            'admincomment',
            'leaving_at_evening',
            'coming_at_evening',
            'request_id',
            'holidaytype',
            'latest_action',
            'statut',
            'admin_id',
    ];


    public $timestamps = false;
}
