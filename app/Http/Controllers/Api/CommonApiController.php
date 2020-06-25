<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiCommanFunctionController as ApiCommanFunctionController;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use Hash;

class CommonApiController extends ApiCommanFunctionController
{

     /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){

            return $this->sendError($validator->errors()->first(),[],422);     
        }

        $obj = new User;
        $obj->name = $input['name'];
        $obj->email = $input['email'];
        $obj->password = Hash::make($input['password']);
        $obj->save();

        if (!empty($obj)) {
            
            return $this->sendResponse(200,$obj->toArray(),'User successfully register.');

        }else{

            return $this->sendError(false,"No data found",402);
        }   

    }
     /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {   

        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){

            return $this->sendError($validator->errors()->first(),[],422);     
        }

        $credentials = request(['email','password']);

        if (! $token = auth()->attempt($credentials)) {

            return $this->sendError('Unauthorized',[],401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {      
        $data = auth()->user();
        if ($data !=null) {
        
            return $this->sendResponse(200,auth()->user(),'User data successfully retrived.');
            
        }else{

            return $this->sendResponse(401,[],'Data not found.');
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return $this->sendResponse(200,[],'Logout successfully done.');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'status'=>200,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}