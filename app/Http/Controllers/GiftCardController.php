<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiftCard;
use Illuminate\Support\Str;


class GiftCardController extends Controller
{
    public function index()
    {
        $giftCards = GiftCard::where('status',1)->get();
        $context = ['giftCards' => $giftCards];
        return view('admin.giftcard.index',$context);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.giftcard.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'code' => 'unique:gift_cards',
            'amount' => 'required|integer|min:10000',
            'balance' => 'required|integer|min:0',
            'expire_date' => 'required',
        ]); 


        GiftCard::create([
            'code' => Str::uuid(),
            'user_info' => $request->name.'|'.$request->address.'|'.$request->phone.'|'.$request->fb_link,
            'amount' => $request->amount,
            'balance' => $request->balance,
            'expire_date' =>  $request->expire_date,
            'description' => $request->description,
        ]);
        notify()->success('Giftcard Created Successfully');
        return redirect('/auth/giftcard/index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $giftcard = GiftCard::find($id);
        $context = ['giftcard'=>$giftcard];
        return view('admin.giftcard.edit',$context);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $giftcard = GiftCard::find($id);
        $giftcard->user_info = $request->name.'|'.$request->address.'|'.$request->phone.'|'.$request->fb_link;


        $giftcard->amount = $request->amount;
        $giftcard->balance = $request->balance;
        $giftcard->expire_date = $request->expire_date;

        $giftcard->description = $giftcard->description;
       
        $giftcard->save();
        notify()->success('Updated Successfully');
        return redirect('/auth/giftcard/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $giftcard = GiftCard::find($id);
        $giftcard->status = false;
        $giftcard->save();
        notify()->success('GiftCard Deleted Successfully');
        return redirect('/auth/giftcard/index');
    }
}
