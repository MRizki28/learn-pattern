<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ApiResponse\MahasiswaResponse;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    protected $mahasiswaResponse;

    public function __construct(MahasiswaResponse $mahasiswaResponse)
    {
        $this->mahasiswaResponse = $mahasiswaResponse;
    }

    public function getAllData()
    {
        return $this->mahasiswaResponse->get();
    }
}
