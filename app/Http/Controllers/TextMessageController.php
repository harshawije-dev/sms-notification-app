<?php

namespace App\Http\Controllers;

use App\Services\SMSProvider as ServicesSMSProvider;
use App\TextMessage;
use Illuminate\Http\Request;

class TextMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return [
            'msg' => "All phone numbers"
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'phoneNumber' => 'required|unique:users_phone_number|numeric'
        ]);

        try {
            // $phone_model = new TextMessage($request->all());
            // $phone_model->save();
            $provider = new ServicesSMSProvider();

            return [
                'msg'=> "Phone number registered",
                'data'=> $provider->get_sms_provider("Your order has been recived !!!", $request->phoneNumber)
            ];
        } catch (\Throwable $error) {
            return [
                'msg'=> "Error Occered",
                'description'=> $error->__toString()
            ];
        }
    }
}
