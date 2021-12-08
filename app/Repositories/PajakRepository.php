<?php

namespace App\Repositories;

use App\Models\Pajak;
use App\Repositories\BaseRepository;

/**
 * Class PajakRepository
 * @package App\Repositories
 * @version December 8, 2021, 2:16 am UTC
*/

class PajakRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'rate'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pajak::class;
    }
}
