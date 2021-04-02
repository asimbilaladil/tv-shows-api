<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Show extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'show_id',
        'name',
        'image',
        'link',
        'status',
    ];
    
}