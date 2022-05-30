<?php

namespace App\Http\Controllers;

use App\Actions\Auth\CreateUser;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{    
    /**
     * for user login
     *
     * @param  Request $request
     * @return void
     */
    public function login(UserRequest $request)
    {
        auth()->attempt($request->validated());
        
        return back()->withErrors(['loginError' => 'Invalid credentials supplied']);
    }
    
    /**
     * for user registration
     *
     * @param  mixed $request
     * @return void
     */
    public function register(UserRequest $request, CreateUser $createUser)
    {
        $createUser->execute($request->validated());

        return to_route('dashboard');
    }
    
    /**
     * logout
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();

        return redirect()->to('/');
    }
}
