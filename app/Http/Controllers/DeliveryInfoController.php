<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryInfo;
use Auth;

class DeliveryInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $deliveryInfo = DeliveryInfo::where('user_id', $userId)->get();
        $context = ['deliveryInfo' => $deliveryInfo];
        return view('deliveryInfo.index', $context);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deliveryInfo.create');
    }
    public function store(Request $request)
    {
        $userId = Auth::id();
        DeliveryInfo::create([
            'user_id' => $userId,
            'name' => $request->name,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'city' => $request->city,
            'township' => $request->township,
            'state_region' => $request->state_region,
        ]);

        return redirect('checkout/2');
    }
}