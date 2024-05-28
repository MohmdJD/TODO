<?php
//
//namespace App\Http\Controllers\Auth;
//
//use App\Http\Controllers\Controller;
//use App\Models\User;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\Route;
//
//
//class RegisterController extends Controller
//{
//
//    public function create(Request $request)
//    {
//        $attribute = $request->validate([
//            'email' => 'required|string|email|unique:users',
//            'name' => 'nullable|string',
//            'password' => 'required|string',
//        ]);
//
//        $user = $this->create($attribute);
//
//        return Response::json($user)->setStatusCode(201);
//    }
//
//}
