<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($orderid)
    {
        $orders = Order::where('id',$orderid)->get();
        return view('admin.order.show',compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function loadStatus($orderid,$status)
    { 
        $status_update = Order::where('id',$orderid)->update(['status'=>$status]);

        $user_id = Order::where('id',$orderid)->pluck('user_id');

        $userInfo = User::where('id',$user_id)->get()->first();

       switch ($status) {
        case '1':
            $value = 'Pending';
            break;
        case '2':
            $value = 'Approved';
            break;
        case '3':
            $value = 'Completed';
            break;
        case '4':
            $value = 'Declined';
            break;
        case '5':
            $value = 'Cancelled';
            break;
        
        default:
            $value = 'unknown';
            break;
       }

        $link = route('order');

        $message = 'Dear <b>'.$userInfo->name.'</b>';
        $message = 'Stage confirmation on processing for your orders';
        $mail_data=[
            'recipient' =>$userInfo->email,
            'name' => $userInfo->name,
            'fromEmail' =>'noreply@gamehubmyanmar.com',
            'fromName' =>'GameHub Myanmar',
            'subject' =>'Status of your order',
            'status'  => $value,
            'body'=>$message,
            'link' =>$link,
        ];
        \Mail::send('order-email-template',$mail_data,function($message) use ($mail_data){
            $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'], $mail_data['fromName'])
                    ->subject($mail_data['subject']);
        });

        return $status;
    }
    public function behaviourOfPaymentStatus($orderidforpayment,$statuspayment){
        $status_update = Payment::where('order_id',$orderidforpayment)->update(['status'=>$statuspayment]);
        return $statuspayment;
    }
}
