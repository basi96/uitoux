<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tb_student_marks';

    protected $primaryKey = 'mark_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'mark_1', 'mark_2', 'mark_3', 'total', 'rank', 'result'
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
