<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Item
 * @package App\Models
 * @version December 8, 2021, 2:21 am UTC
 *
 * @property string $nama
 * @property integer $pajak1
 * @property integer $pajak2
 */
class Item extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'items';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nama',
        'pajak1',
        'pajak2'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'pajak1' => 'integer',
        'pajak2' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'pajak1' => 'required',
        'pajak2' => 'required'
    ];

    
}
