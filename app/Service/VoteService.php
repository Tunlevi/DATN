<?php
/**
 * Created By PhpStorm
 * User: trungphuna
 * Date: 7/16/23
 * Time: 9:04 AM
 */

namespace App\Service;

use App\Http\Resources\OrderCollection;
use App\Http\Resources\VoteCollection;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VoteService
{
    public static function index(Request $request)
    {
        $votes = Vote::with('user:id,name,avatar');
        if ($request->user_id) $votes->where('user_id', $request->user_id);
        if ($request->product_id) $votes->where('product_id', $request->product_id);

        $votes = $votes
            ->orderBy('id','DESC')
            ->paginate(20);

        return new VoteCollection($votes);
    }

    public static function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');

            $vote = Vote::create($data);
            if ($vote) {
                $product = Product::find($vote->product_id);
                if ($product) {
                    $product->total_vote += 1;
                    $product->stat_vote += $vote->number_vote;
                    $product->updated_at = Carbon::now();
                    $product->save();
                }
            }

            DB::commit();
            return [
                'status' => 'success',
                'data'   => $vote
            ];
        } catch (\Exception $exception) {
            Log::error("OrderService@add => File:  " .
                $exception->getFile() . " Line: " .
                $exception->getLine() . " Message: " .
                $exception->getMessage());
            DB::rollBack();

            return [
                'status' => 'fail',
                'data'   => [
                    'message' => 'Lỗi đánh giá, xin vui lòng thử lại'
                ]
            ];
        }
    }

    public static function static(Request $request, $productID)
    {
        try {
            $ratingsDashboard = Vote::groupBy('number_vote')
                ->where('product_id', $productID)
                ->select(\DB::raw('count(number_vote) as count_number'), \DB::raw('sum(number_vote) as total'))
                ->addSelect('number_vote')
                ->get()->toArray();

            $ratingDefault = self::mapRatingDefault();
            foreach ($ratingDefault as $key => $item) {
                foreach ($ratingsDashboard as $rd)
                {
                    if ($item['number_vote'] == $rd['number_vote']) {
                        $ratingDefault[$key] = $rd;
                    }
                }
            }

//            foreach ($ratingsDashboard as $key => $item) {
//                $ratingDefault[$item['number_vote']] = $item;
//            }

            return [
                'status' => 'success',
                'data'   => $ratingDefault
            ];
        } catch (\Exception $exception) {
            Log::error("OrderService@add => File:  " .
                $exception->getFile() . " Line: " .
                $exception->getLine() . " Message: " .
                $exception->getMessage());
            DB::rollBack();

            return [
                'status' => 'fail',
                'data'   => [
                    'message' => 'Lỗi đánh giá, xin vui lòng thử lại'
                ]
            ];
        }
    }

    public static function mapRatingDefault()
    {
        $ratingDefault = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingDefault[] = [
                "count_number" => 0,
                "total"        => 0,
                "number_vote"     => $i
            ];
        }
        return $ratingDefault;
    }
}
