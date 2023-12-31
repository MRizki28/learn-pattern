<?php

namespace App\ApiResponse;

use App\Repositories\MahasiswaRepository;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

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
        }

        if ($data === 'checking_entry_count' ) {
            return response()->json([
                'code' => 400,
                'message' => 'Data already exist'
            ]);
        }

        if ($data instanceof \Throwable) {
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'errors' => $data->getMessage()
            ]);
        }

        return response()->json([
            'code' => 201,
            'message' => 'Success create data',
            'data' => $data
        ]);
    }

    public function getById($id)
    {
        $data = $this->MahasiswaRepository->getDataById($id);
        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'message' => 'success get data by id',
                'data' => $data
            ]);
        }
    }
}
