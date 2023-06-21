<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Base\Api\ApiController;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Hash;
use Validator;
use Exception;
use Log;


class AuthController extends ApiController
{
	use SendsPasswordResetEmails;

   public function login(Request $request)
   {
   		$rule = [
            'email' => 'required',
            'password' => 'required',  
        ];

        $validate = Validator::make($request->all(), $rule);

        if ($validate->fails())
        {
             return $this->sendError('Validation Error.', ['errors' => $validate->errors()]);     
        }   
	   	try
		{
			$data = request()->all();
			$user = $this->User->where('email',$data['email'])->where('role_id','2')->first();

			if($user){
				// if($user->email_verify == 'false'){
				// 	return $this->sendResponse('fail', 'please verify your email.');	
				// }
				if(Hash::check($data['password'], $user->password)){

					$session = $this->UserSession->updateOrCreate(
	                ['user_id' => $user->id],
	                ['user_id' => $user->id ,
	                'session_id' => uniqid()]);
					return $this->sendResponse($session, 'Login succesfully');
				}else{
					return $this->sendResponse('fail', 'Entered Wrong Paasword.');	
				}
			}else{
				return $this->sendResponse('fail', 'User not Authorise.');
			}
			
		}
		catch(Exception $e)
		{
			dd($e);
			Log::debug($e->getMessage());
		}  
   }

   public function signup(Request $request)
   {
   		$rule = [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',   
            'device_id' => 'required',   
            'device_type' => 'required',   
        ];

        $validate = Validator::make($request->all(), $rule);

        if ($validate->fails())
        {
             return $this->sendError('Validation Error.', ['error'=>$validate->errors()]);     
        }
	   	try
		{
			$data = request()->all();

			$user = $this->User;
			$user->name = $data['name'];
			$user->email = $data['email'];
			$user->password =  Hash::make($data['password']);
			$user->role_id =  '2';
			$user->device_id =  $data['device_id'];
			$user->device_type =  $data['device_type'];
			$user->save();	

			//create user token

			$user_token = $this->UserSession->updateOrCreate(
                            [
                                'user_id' => $user->id
                            ],
                            [
                                'user_id' => $user->id,
                                'session_id' => uniqid(),
                            ]
                        );
			$user['token'] = $user_token['session_id'];
			
			// sendMailForVerify($user->id,$user->email);
			// $this->sendResetLinkEmail($request);
			
			return $this->sendResponse($user, 'User Signup succesfully.');		
			
		}
		catch(Exception $e)
		{
			// dd($e);
			Log::debug($e->getMessage());
		}  
   }

   public function socialLogin(Request $request)
   {	
   		$rule = [
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',   
            'device_id' => 'required',   
            'device_type' => 'required',   
            'social_id' => 'required',   
            'social_type' => 'required',   
        ];
        $validate = Validator::make($request->all(), $rule);

        if ($validate->fails())
        {
             return $this->sendError('Validation Error.', ['error'=>$validate->errors()]);     
        }
   		try
		{
			$data = request()->all();
			$user = $this->User->where('social_type',$data['social_type'])->where('social_id',$data['social_id'])->first();

			if($user == null){
				
				$user = $this->User;
				$user->username = $data['username'];
				$user->email = $data['email'];
				$user->role_id =  '2';
				$user->social_id =  $data['social_id'];
				$user->social_type =  $data['social_type'];
				$user->device_id =  $data['device_id'];
				$user->device_type =  $data['device_type'];
				$user->email_verify = 'true';
				$user->save();


				if($user){
					$session = $this->UserSession->updateOrCreate(
		                ['user_id' => $user->id],
		                ['user_id' => $user->id ,
		                'session_id' => uniqid()]);
				}
				return $this->sendResponse($session, 'User Login succesfully.');		
			}else{
				$session = $this->UserSession->updateOrCreate(
	                ['user_id' => $user->id],
	                ['user_id' => $user->id ,
	                'session_id' => uniqid()]);
				
				return $this->sendResponse($session, 'User Login succesfully.');
			}
			
		}
		catch(Exception $e)
		{
			Log::debug($e->getMessage());
		}  
   }

   public function logout(Request $request)
   {
   		$rule = [
            'user_id' => 'required',
            'session_id' => 'required',  
        ];

        $validate = Validator::make($request->all(), $rule);

        if ($validate->fails())
        {
             return $this->sendError('Validation Error.', ['error'=>$validate->errors()]);     
        }
	   	try
		{
			$data = request()->all();
			$session = $this->UserSession->where('user_id',$data['user_id'])->where('session_id',$data['session_id'])->delete();	
			return $this->sendResponse('1', 'User Logout.');		
			
		}
		catch(Exception $e)
		{
			Log::debug($e->getMessage());
		}  
   }

   public function updateProfile(Request $request)
   {
   		try
		{
   			$data = request()->all();
   			$user = getSessionBySession($data['session_id']);
   			$filename = $user->profile_picture;
   			$destinationPath = public_path().'/'. \Config::get('admin.image.profile_image');
   			if($request->hasfile('profile_picture'))
             {

               if(!is_dir($destinationPath)) {
            	mkdir($destinationPath,0777,true);
		        }
		        // $file = $request->file($getValue);
		        $getValue = $data['profile_picture'];
		        $extension = $getValue->getClientOriginalExtension(); // getting image extension
		        $filename = 'profile_img_'.$user->id.'.'.$extension;
		        if($user->profile_picture != null){
		            $filename = $user->getOriginal('profile_picture');
		        }
		        $getValue->move($destinationPath, $filename);
             }
   			$user_details=$this->User->where('id',$user->id)->update(['first_name'=>$data['first_name'],'last_name'=>$data['last_name'],'profile_picture'=>$filename]);
   			return $this->sendResponse('1', 'User Profile Update.');	
			
		}
		catch(Exception $e)
		{
			Log::debug($e->getMessage());
		}

   }
}


