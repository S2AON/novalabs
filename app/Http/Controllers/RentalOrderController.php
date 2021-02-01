<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Car;
use App\Models\RentalOrder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RentalOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderResource::collection(Auth::user()->orders) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req = json_decode($request->getContent(), true);

        $validator = Validator::make($request->all(),
        [
            'start_date' => 'required|string',
            'end_date' => 'required|string',
            'cost_per_day' => 'required',
            'payment' => 'required|string',
            'cars' => 'required|array',
        ]);

        //If the validation fails we send an error message to
        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $subtotal = $req['cost_per_day'] * count($req['cars']);
        $itmbs = $req['cost_per_day'] * 0.07 ;

        $req['subtotal'] = $subtotal;
        $req['itbms'] = $itmbs ;
        $req['total'] = $subtotal + $itmbs ;
        $req['code'] = Str::uuid()->toString() ;
        $req['user_id'] = Auth::user()->id ;

        $order = RentalOrder::create($req);

        foreach($req['cars'] as $car)
        {
            $car = Car::find($car['id']);
            $order->cars()->attach($car->id);
            $car->status = true ;
            $car->save();
        }

        return response
        ([
            'message' => 'order successfully created',
            'order_number' => $order->code
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RentalOrder  $rentalOrder
     * @return \Illuminate\Http\Response
     */
    public function show(RentalOrder $rentalOrder)
    {
        return $rentalOrder;
    }

}
