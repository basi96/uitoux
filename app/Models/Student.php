<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_student_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_name'
    ];

     /**
     * @param $query
     * @return mixed
     */
    /**
     * The attributes dates that should be added.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];
}
