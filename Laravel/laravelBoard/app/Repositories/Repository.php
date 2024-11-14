<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class Repository.
 */
class Repository extends BaseRepository
{
    /**
     * 실제 로직을 처리하는 구간
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }
}
