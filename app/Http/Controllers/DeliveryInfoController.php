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
        if($request->township == 'Mingaladone' || $request->township == 'Hlaingthaya' 
            || $request->township == 'Shwepyitha' || $request->township == 'Dagon Seikkan'
            || $request->township == 'South Dagon' || $request->township == 'East Dagon' ){
                $delivery_fees = 2500;
            }else if($request->township == "Htauk Kyant" || $request->township == "Mhawbi" || 
            $request->township == "Thanlyin" || $request->township == "Shwepyitha"){
                $delivery_fees = 3500;
            }else{
                $delivery_fees = 2000;
            }
        DeliveryInfo::create([
            'user_id' => $userId,
            'name' => $request->name,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'city' => $request->city,
            'delivery_fees' => $delivery_fees,
            'township' => $request->township,
            'state_region' => $request->state_region,
        ]);

        return redirect('checkout/'.Auth::getUser()->name);
    }

    public function getTownshipInfo($id)
    {
        if($id == 'Yangon City'){

            return response()->json([
                'Ahlone' => 'Ahlone',
		        'Bahan'  => 'Bahan',
                'Botataung' => 'Botataung',
                'Dagon Downtown' => 'Dagon Downtown',
                'Dawbon' => 'Dawbon',
                'Hlaing' => 'Dawbon',
                'Hlaingthaya' => 'Hlaingthaya',
                'Insein' => 'Insein',
                'Kamayut' => 'Kamayut',
                'Kyauktada' => 'Kyauktada',
                'Kyauktan' => 'Kyauktan',
                'Kyimyindaing' => 'Kyimyindaing',
                'Lanmadaw' => 'Lanmadaw',
                'Latha' => 'Latha',
                'Mayangone 7mile' => 'Mayangone 7mile',
                'Mayangone 9mile Pyay' => 'Mayangone 9mile Pyay',
                'Mayangone Kabaraye' => 'Mayangone Kabaraye',
                'Mayangone Kyaik Waing' => 'Mayangone Kyaik Waing',
                'Mayangone Parami' => 'Mayangone Parami',
                'Mayangone Thamine' => 'Mayangone Thamine',
                'Mhawbi' => 'Mhawbi',
                'Mingaladone' => 'Mingaladone',
                'MingalartaungNyunt' => 'MingalartaungNyunt',
                'North Okkalapa' => 'North Okkalapa',
                'Pebedan' => 'Pebedan',
                'Pazundaung' => 'Pazundaung',
                'Sanchaung' => 'Sanchaung',
                'Shwepyitha' => 'Shwepyitha',
                'South Okkalapa' => 'South Okkalapa',
                'Tamwe' => 'Tamwe',
                'Thaketa' => 'Thaketa',
                'Thanlyin' => 'Thanlyin',
                'Thingangkuun' => 'Thingangkuun',
                'Yankin' => 'Yankin'

            ]);

        }else if($id == 'Dagon Myothit'){

            return response()->json([

                "Dagon Seikkan" => "Dagon Seikkan",
                "East Dagon" => "East Dagon",
                "North Dagon Ward 27 - 33" => "North Dagon Ward 27 - 33",
                "North Dagon Ward 34 - 45" => "North Dagon Ward 34 - 45",
                "North Dagon Ward 46 - 50" => "North Dagon Ward 46 - 50",
                "South Dagon" => "South Dagon"

            ]);

        }else if($id == 'Yangon Division'){

            return response()->json([

                "Cocokyun" => "Cocokyun",
                "Dala" => "Dala",
                "Hlegu" => "Hlegu",
                "Htantabin" => "Htantabin",
                "Htauk Kyant" => "Htauk Kyant",
                "Kawhmu" => "Kawhmu",
                "Kayan" => "Kayan",
                "Kungyangon" => "Kungyangon",
                "Seikgyikanaungto" => "Seikgyikanaungto",
                "Taikkyi" => "Taikkyi",
                "Thongwa" => "Thongwa",
                "Twantay" => "Twantay",

            ]);

        }

        
    }
}