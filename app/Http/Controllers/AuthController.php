<?php

namespace App\Http\Controllers;

use App\Models\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //checking if the user is already logged in and return to the dashboard
        if (Auth::user()) {
            return redirect('/');
        }
                //validate request
       $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password, ])) {
        $user = Auth::user();      
        return response()->json([
            'msg' => 'You are logged in',
            'user' => $user
        ]);
    }else {
        return response()->json([
            'msg' => 'Incorrect Login details '
        ], 401);    }
    }
    public function createUser(Request $request) 
    {
        //validate request
       $this->validate($request, [
           'firstName' => 'required',
           'lastName' => 'required',
           'email' => 'required|email|unique:users',
           'phone' => 'required|unique:users',
           'password' => 'required|min:6',
       ]);
       /* Get credentials from .env */
                $token = getenv("TWILIO_AUTH_TOKEN");
                $twilio_sid = getenv("TWILIO_SID");
                $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
                $twilio = new Client($twilio_sid, $token);
                $twilio->verify->v2->services($twilio_verify_sid)
                    ->verifications
                    ->create($request->phone, "sms");
                    $password = bcrypt($request->password);
                    if ($request->role_id) {
                        $user = User::create([
                        'firstName' => $request->firstName,
                        'lastName' => $request->lastName,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'password' => $password,
                        'role_id' => $request->role_id,
                        ]);  
                        return $user;
                    }else{
                        $user = User::create([
                            'firstName' => $request->firstName,
                            'lastName' => $request->lastName,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'password' => $password,
                            ]);  
                            return $user;
                    }
                              
       //return $user;
   }
   public function requestCode($phone)
   {
            /* Get credentials from .env */
            $token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_sid = getenv("TWILIO_SID");
            $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
            $twilio = new Client($twilio_sid, $token);
             $request = $twilio->verify->v2->services($twilio_verify_sid)
                ->verifications
                ->create($phone, "sms");
            return $request;
   }

   public function verify( $phone, $verification_code)
   {
       /* Get credentials from .env */
       $token = getenv("TWILIO_AUTH_TOKEN");
       $twilio_sid = getenv("TWILIO_SID");
       $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
       $twilio = new Client($twilio_sid, $token);

       $verification = $twilio->verify->v2->services($twilio_verify_sid)
           ->verificationChecks
           ->create($verification_code, ["to" => $phone]);
       if ($verification->valid) {
           $user = tap(User::where('phone', $phone))->update(['isVerified' => true]);
           /* Authenticate user */
           Auth::login($user->first());
           //return $verification->valid;
           return response()->json([
            'msg' => 'You are logged in',
            'user' => Auth::user()
        ]);
           //return redirect()->route('welcome')->with(['message' => 'Phone number verified']);
       }
       //return back()->with(['phone' => $data['phone'], 'error' => 'Invalid verification code entered!']);
   }

   public function logout() 
   {
    Auth::logout();
    return redirect('/login');
    }
}
