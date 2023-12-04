<?php

namespace App\Http\Controllers;

use App\Services\SMSProvider as ServicesSMSProvider;
use App\TextMessage;
use Illuminate\Http\Request;

class TextMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     * Super admin authentication required
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
        
        $request->validate([
            'phoneNumber' => 'required|unique:users_phone_number|numeric',
            'message'=> 'required|string'
        ]);

        try {
            $phone_model = new TextMessage($request->all());
            $phone_model->save();
            $provider = new ServicesSMSProvider();

            return [
                'msg'=> "Phone number registered & SMS sent",
                'data'=> $provider->get_sms_provider($request->message, $request->phoneNumber)
            ];
        } catch (\Throwable $error) {
            return [
                'msg'=> "Error Occered",
                'description'=> $error->__toString()
            ];
        }
    }
}
