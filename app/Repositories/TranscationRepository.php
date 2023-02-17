<?php

namespace App\Repositories;

use App\Models\Transcation;
use App\Repositories\BaseRepository;

/**
 * Class TranscationRepository
 * @package App\Repositories
 * @version April 12, 2022, 11:45 am UTC
*/

class TranscationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
        'amount',
        'account_id',
        'category_id',
        'mode_id',
        'date_time',
        'description'
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
        return Transcation::class;
    }
}
