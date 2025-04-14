<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePentestRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function pentest(Request $request)
    {
        $request->headers->set('Content-Type','application/json');
        dd($request->all());
        $data = [
            'status' => 'success'
        ];
        return response()->json($data);
    }
}
