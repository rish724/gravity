<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Services\DiwaliService;

class ApiController extends Controller
{
    public function diwaliOffer(Request $request,DiwaliService $diwaliService)
    {
        $validator = \Validator::make($request->all(), [
            'rule' => 'required|in:1,2,3',
            'input' => 'required|array',
           
        ]);
    
        if ($validator->fails()) {
            $responseArr['message'] = $validator->errors();
            $responseArr['status'] = false;
            return response()->json($responseArr, Response::HTTP_BAD_REQUEST);
        }else {
            $returnResponse=$diwaliService->getDiwaliOffer($request);   
            return response()->json($returnResponse, Response::HTTP_OK);
        }
        
    }
}
