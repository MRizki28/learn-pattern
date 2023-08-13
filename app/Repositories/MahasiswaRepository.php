<?php

namespace App\Repositories;

use App\Interfaces\MahasiswaInterfaces;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function createData(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nama' => 'required'
        ]);

        if ($validation->fails()) {
            return $validation;
        }

        $entry = $this->model->where('entry_count', true)->first();
        if ($entry) {
            return ('checking_entry_count');
        }

        try {
            $data = new $this->model;
            $data->nama = $request->input('nama');
            $data->entry_count = true;
            $data->save();

            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getDataById($id)
    {
        $data = $this->model->where('id', $id)->first();
        if (!$data) {
            return $data;
        }
        return $data;
    }

    
}
