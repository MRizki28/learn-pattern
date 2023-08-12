<?php

namespace App\ApiResponse;

use App\Repositories\MahasiswaRepository;
use Illuminate\Http\Request;

class MahasiswaResponse
{
    protected $MahasiswaRepository;

    public function __construct(MahasiswaRepository $mahasiswaRepository)
    {
        $this->MahasiswaRepository = $mahasiswaRepository;
    }

    public function get()
    {
        try {
            
            $data = $this->MahasiswaRepository->getAllData();
            if ($data->isEmpty()) {
                return response()->json([
                    'code' => 404, 
                    'message' => 'Data not found',
                ]);
            }
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'failed',
                'errors' => $th->getMessage()
            ]);
        }
    }

    public function create(Request $request)
    {
        $data = $this->MahasiswaRepository->createData($request);
        if ($data instanceof \Illuminate\Validation\Validator && $data->fails()) {
            return response()->json([
                'code' => 400,
                'message' => 'Check your validation',
                'errors' => $data->errors()
            ]);
        } elseif ($data instanceof \Throwable) {
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'errors' => $data->getMessage()
            ]);
        } else {
            return response()->json([
                'code' => 201,
                'message' => 'Success create data',
                'data' => $data
            ]);
        }
    }

}