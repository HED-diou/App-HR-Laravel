<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requeste extends Model
{

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'requests';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'archived',
        'user_id',
    ];


    public $timestamps = false;
    /**
     * Get the history for the req.
     */
    /*public function history()
    {
        return $this->hasMany(RequestsHistory::class,'request_id');
    }

    public function last_req()
    {
        return $this->history->first();
    }*/
}
