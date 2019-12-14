<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use App\User;

class RegisterController extends BaseController
{
     /**
     * 註冊新使用者
     *
	 * @bodyParam name string required 使用者名稱
	 * @bodyParam email string required 電子郵件
	 * @bodyParam password string required 密碼
	 * @bodyParam c_password string required 密碼確認
     * @response {
     *  "success": true,
     *  "data": {
     *   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.e",
	 *   "name": "test"
     *  },
     *  "message": "User register successfully."
     * }
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
}
