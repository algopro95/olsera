<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Pajak
 * @package App\Models
 * @version December 8, 2021, 2:16 am UTC
 *
 * @property string $nama
 * @property integer $rate
 */
class Pajak extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'pajaks';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nama',
        'rate'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'rate' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'rate' => 'required'
    ];

    
}
