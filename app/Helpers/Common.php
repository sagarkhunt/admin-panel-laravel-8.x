<?php
use App\Models\User;
	/*send mail*/
	function sendMail($data)
	{    
		
		try {		
			$email = $data['email']; 
		    Mail::send('email.send_email', $data, function ($message) use ($email) {
		        $message->from('punit.radhe@gmail.com',env('MAIL_FROM_NAME','GoFairy'))->subject('code confirmation');
		        $message->to($email);
		    });
		} catch (\Exception $e) {		
			dd($e->getMessage());
			
		}
	}	

	/*==============================================
    =            IOS push notificaton            =
    ==============================================*/
    function sendPushToMultipleIosDevice($deviceToken,$status,$title,$msg,$data,$push_type) 
    {        
        if (is_array($deviceToken)):
        else:
            $deviceToken2 = [];
            array_push($deviceToken2, $deviceToken);
            $deviceToken = $deviceToken2;
        endif;

        if (empty($deviceToken)):
            return;
        endif;
        $deviceToken = array_unique($deviceToken);

        $url = "https://fcm.googleapis.com/fcm/send";

        $serverKey = 'AAAA9Kr50Io:APA91bEkyr3uKzO82giR14LBqyEBQJXnnX8tcJtu0wNJdd2QiQkCSMX-X_4ZtsYpoh4lNqWscIa9YRheTKa-kK6fsU0C4iXiJHtnuclZSF_XRpGbiaFfSjUtUViPWScKTC-PXcY1L0XP';

        $notification = array(
            'title' => $title, 
            'text' => $msg, 
            'data' => $data,
            'status' => $status,
            'sound' => 'default', 
            'largeIcon' => URL::to('public/fairy-logo.png'),
            'smallIcon' => URL::to('public/fairy-logo.png'),
            'badge' => '1',
            'push_type' => $push_type,
            "click_action"=> "FLUTTER_NOTIFICATION_CLICK",
        );

        $device_token_cunks = array_chunk($deviceToken, 20);

        $arrayToSend = array();
        foreach ($device_token_cunks as $device_token_cunk):

            foreach ($device_token_cunk as $k => $token):

                $arrayToSend = array('to' => $token, 'data' => $notification, 'notification' => $notification, 'priority'=>'high');

            endforeach;

        endforeach;
        
        $json = json_encode($arrayToSend);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='. $serverKey;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //Send the request
        $result = curl_exec($ch);
        Log::Debug('Ios notification'.$deviceToken[0].' '.$result);
        
        curl_close($ch);
        return 0;
    }

    /* Android push notificaton */
    function sendPushToMultipleAndroid($tokens,$status ,$title, $msg ,$data, $type) {

        if (!$title):
            $title = $msg;
        endif;

        
            $notification_msg = array
            (
                'status' => $status,
                'message' => $msg,                
                'title' => $title,
                'subtitle' => 'GoFairy',
                'tickerText' => 'GoFairy',
                'vibrate' => 1,
                'sound' => 1,
                // 'largeIcon' => URL::to('public/notification.png'),
                // 'smallIcon' => URL::to('public/notification.png'),
                'notificationType' => $type,
                "click_action"=> "FLUTTER_NOTIFICATION_CLICK",
            );
       
        
        $fields = array
        (
            'registration_ids' => $tokens,
            'notification' => $notification_msg,
            'data' => $notification_msg,
            'priority' =>'high'
        );

        $headers = array
        (
            'Authorization: key=AAAA9Kr50Io:APA91bEkyr3uKzO82giR14LBqyEBQJXnnX8tcJtu0wNJdd2QiQkCSMX-X_4ZtsYpoh4lNqWscIa9YRheTKa-kK6fsU0C4iXiJHtnuclZSF_XRpGbiaFfSjUtUViPWScKTC-PXcY1L0XP',
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        // if ($result === FALSE) 
        // {
        //        die('FCM Send Error: ' . curl_error($ch));
        // }
        // curl_close( $ch );
        // return $result;
        curl_close($ch);
        
        Log::Debug('Android notification'.$tokens[0].' '.$result);
        return 0;
        die;
    }

?>