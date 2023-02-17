<?php

namespace App\Repositories;

use App\Models\Mode;
use App\Repositories\BaseRepository;

/**
 * Class ModeRepository
 * @package App\Repositories
 * @version April 10, 2022, 12:36 pm UTC
*/

class ModeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return Mode::class;
    }
}
