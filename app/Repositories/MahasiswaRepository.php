<?php

namespace App\Repositories;

use App\Interfaces\MahasiswaInterfaces;
use App\Models\MahasiswaModel;

class MahasiswaRepository implements MahasiswaInterfaces
{
    protected $model;

    public function __construct(MahasiswaModel $model)
    {
        $this->model = $model;
    }

    public function getAllData()
    {
        $data = $this->model->all();
        return $data;
    }
}