<?php

use App\Http\Controllers\TaskController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::post('/login', function (Request $request) {
    $request->validate([
        'name' => 'required_without:email',
        'email'    => 'required_without:name|email|exists:users',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user or !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $data = [
        'token' => $user->createToken('token')->plainTextToken
    ];

    return Response::json($data)->setStatusCode(201);
});


Route::post('/register', function (Request $request) {
    $attribute = $request->validate([
        'email'    => 'required|string|email|unique:users',
        'name'     => 'nullable|string|unique:users',
        'password' => 'required|string',
    ]);

    $user = User::create($attribute);

    return Response::json($user)->setStatusCode(201);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('tasks', TaskController::class);
