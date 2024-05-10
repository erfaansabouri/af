<?php

namespace App\Services;
use Kavenegar as KN;
class Kavenegar {
    public static function send($receptor , $template, $token, $token2 = null, $token3 = null){
        try{
            //Send null for tokens not defined in the template
            //Pass token10 and token20 as parameter 6th and 7th
            $result = KN::VerifyLookup($receptor, $token, $token2, $token3, $template, $type = null);
            if($result){
                foreach($result as $r){
                    echo "messageid = $r->messageid";
                    echo "message = $r->message";
                    echo "status = $r->status";
                    echo "statustext = $r->statustext";
                    echo "sender = $r->sender";
                    echo "receptor = $r->receptor";
                    echo "date = $r->date";
                    echo "cost = $r->cost";
                }
            }
        }
        catch(\Kavenegar\Exceptions\ApiException $e){
            \Log::info($e->getMessage());
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
    }
}
