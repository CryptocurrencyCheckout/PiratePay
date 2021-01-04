<?php

namespace App\Http\Controllers\API\V1;

use \Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Status as StatusResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Transaction;
use Purifier;

/**
 * @group Transaction Status
 *
 * Check the current status of a PiratePay Transaction with a PiratePay ID or a Store ID.
 */

class StatusController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth:api');
        $this->middleware('throttle:50');

    }

    /**
     * @bodyParam  type string required Search for transaction using either PiratePay "id" or store order number with "store_id". Example: store_id
     * @bodyParam  id string required The transaction id or store order id/number. Example: 2563
     * 
     * @response  {
     *  "data": {
     *      "id": 1,
     *      "store_order_id": "2563",
     *      "store_order_price": "0.02",
     *      "store_currency": "USD",
     *      "store_buyer_name": "John Doe",
     *      "store_buyer_email": "test@test.com",
     *      "crypto_address": "zs1yu96c2uz8g0k04qcprj2ssg2rmkuvzgfa2ug8u0rrrysmh2sjzwksx780j78n9qwu9v0ynnjhqk",
     *      "crypto_market_price": "0.097645",
     *      "crypto_price": "0.204824",
     *      "start_balance": "0",
     *      "expected_balance": "0.204824",
     *      "end_balance": null,
     *      "status_detailed": "pending",
     *      "status_basic": "false",
     *      "created_at": "2021-01-04 18:21:17",
     *      "updated_at": "2020-01-04 18:21:17"
     *   }
     * }
     * @response 422 {
     *      "error": "validation error",
     *      "message": {
     *          "type": [
     *              "The type field is required."
     *          ],
     *          "id": [
     *              "The id field is required."
     *          ]
     *      }
     * }
     */
    public function status(Request $request)
    {
        $validator =  Validator::make($request->all(),[

            'type' => ['required', Rule::in(['id', 'store_id',])],
            'id' => 'required',

            ]);
        
            if($validator->fails()){
                return response()->json([
                    "error" => 'validation error',
                    "message" => $validator->errors(),
                ], 422);
            }

        $type = Purifier::clean($request->input('type'));
        $id = Purifier::clean($request->input('id'));

        if ($type == 'id'){

            try {
                $transaction = Transaction::where('id', $id)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return response([
                    'status' => 'ERROR',
                    'error' => '404 not found'
                ], 404);
            }

        } elseif ($type == 'store_id'){

            try {
                $transaction = Transaction::where('store_order_id', $id)->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return response([
                    'status' => 'ERROR',
                    'error' => '404 not found'
                ], 404);
            }

        }

        return new StatusResource($transaction);

    }


}
