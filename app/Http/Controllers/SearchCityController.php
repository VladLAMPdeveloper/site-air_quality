<?php


namespace App\Http\Controllers;

use App\Services\SearchCityServer;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class SearchCityController extends Controller
{
    public function getCity()
    {
//        $validator = Validator::make($request->all(), [
//            'customerId' => 'required|string',
//            // 'redirectUrl' => 'required|string'
//        ]);

//        if ($validator->fails()) {
//            throw new ValidationException($validator);
//        }

        $res = SearchCityServer::getCity();

//        if (isset($response['status']) && $response['status'] == 'error') {
//            return $response;
//        }

//        return $response;
        return response()->json(['resp' => $res]);
    }
}
