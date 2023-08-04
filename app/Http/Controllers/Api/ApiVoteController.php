<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Service\OrderService;
use App\Service\VoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiVoteController extends Controller
{
    public function index(Request $request)
    {
        try {
            $votes = VoteService::index($request);

            return response()->json([
                'status' => 'success',
                'votes' => $votes
            ], 200);

        } catch (\Exception $exception) {
            Log::error("ApiVoteController@index => File:  " .
                $exception->getFile() . " Line: " .
                $exception->getLine() . " Message: " .
                $exception->getMessage());
            return response()->json([
                'data' => []
            ], 501);
        }
    }
    public function store(Request $request)
    {
        try {
            $vote = VoteService::add($request);

            return response()->json([
                'status' => 'success',
                'data' => $vote
            ], 200);

        } catch (\Exception $exception) {
            Log::error("ApiVoteController@index => File:  " .
                $exception->getFile() . " Line: " .
                $exception->getLine() . " Message: " .
                $exception->getMessage());
            return response()->json([
                'data' => []
            ], 501);
        }
    }

    public function static(Request $request, $productID)
    {
        try{
            $response = VoteService::static($request, $productID);
            if ($response['status'] === 'fail') {
                return response()->json([
                    'status' => 'fail',
                    'data'   => $response['data']
                ], 501);
            }
            return response()->json([
                'status' => 'success',
                'data'   => $response['data']
            ], 200);

        }catch (\Exception $exception) {
            Log::error("ApiVoteController@index => File:  " .
                $exception->getFile() . " Line: " .
                $exception->getLine() . " Message: " .
                $exception->getMessage());
            return response()->json([
                'data' => []
            ], 501);
        }
    }
}
