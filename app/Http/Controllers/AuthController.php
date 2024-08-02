<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\PasswordGrantClientNotFoundException;
use App\Services\AuthService;
use App\Utils\HttpStatusCodeUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $service;

    public function __construct(AuthService $authService)
    {
        $this->service = $authService;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if ($validator->fails())
            return $this->response($validator->errors()->toArray(), HttpStatusCodeUtil::BAD_REQUEST, 'Validation Error!');

        try {
            $data = $this->service->doLogin($request->email, $request->password);
            return $this->response($data, HttpStatusCodeUtil::OK, 'Login Successful!');
        } catch (InvalidCredentialsException $e) {
            return $this->response([], HttpStatusCodeUtil::BAD_REQUEST, $e->getMessage());
        } catch (PasswordGrantClientNotFoundException $e) {
            return $this->response([], HttpStatusCodeUtil::SERVER_ERROR, 'Something Went Wrong!');
        }
    }

    public function logout()
    {
        $this->service->doLogout();
        return $this->response([], HttpStatusCodeUtil::OK, 'Logout Successful!');
    }
}
