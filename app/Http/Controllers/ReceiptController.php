<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class ReceiptController extends Controller
{
    public function uploadReceipt(Request $request)
    {
        $data= $request->all();

        if (!isset(Receipt::where('user_id', $data['userId'])->get()[0])){
            $codeText='';

            $user = User::find($data['userId']);
            $date = Carbon::now()->timezone(Config::get('app.timezone'))->format('H');

            $receipt = new Receipt();

            $receipt ->user_id = $user['id'];
            $receipt ->image = 'Фото чека';
            $randCode = $this ->genUserCode();
            if (($date%2) == 0){
                $receipt ->prize = 1;
                $receipt ->code = $randCode;
                $prizeText = 'Призовой';
                $codeText = ' - Ваш код: '.$randCode;
            } else {
                $receipt ->prize = 0;
                $prizeText = 'Обычный';
            }
            $receipt ->status = 1;
            $statusText = 'Принят';

            $receipt ->save();

            return response()->json(['code'=>$codeText,'status'=>$statusText,'prize' =>$prizeText,'receipt'=>$receipt,'message'=>'Чек добавлен','success'=>'Ajax request submitted successfully']);
        } else{
            return response()->json(['message'=>'У вас уже есть чек','success'=>'Ajax request submitted successfully']);
        }


    }

    private function genUserCode(){
        $receipt = Receipt::all();

        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $receipt->user_id = [
            'user_id' => substr(str_shuffle($permitted_chars), 0, 8)
        ];

        $rules = ['user_id' => 'unique:receipt'];

        $validate = Validator::make($receipt->user_id, $rules)->passes();

        return $validate ? $receipt->user_id['user_id'] : $receipt->genUserCode();
    }
}
