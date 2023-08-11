<?php

namespace App\ApiResponse;

use App\Repositories\MahasiswaRepository;

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
                    'code' => 204, // Kode 204 berarti No Content
                    'message' => 'No data found',
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

}