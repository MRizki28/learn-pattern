<?php 

namespace App\Interfaces;

use Illuminate\Http\Request;

Interface MahasiswaInterfaces
{
    public function getAllData();
    public function createData(Request $request);
    public function getDataById($id);
}