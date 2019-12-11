<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Facades\DB;

class Player extends Model {
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'second_name', 'form', 'total_points', 'influence', 'creativity', 'threat', 'ict_index'
    ];

    /**
     * Get the player's ID and fullname.
     *
     * @return array
     */
    public function scopeFullnames($query)
    {
        return $query->select(['id', DB::raw("CONCAT(first_name,' ',second_name) as full_name")])->get();
    }
}
