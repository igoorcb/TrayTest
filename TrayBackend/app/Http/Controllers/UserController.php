<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('cpf')) {
            $query->where('cpf', $request->cpf);
        }

        $users = $query->orderByDesc('id')->paginate(10);

        return UserResource::collection($users);
    }
    public function completeProfile(CompleteProfileRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $user->update([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'birthdate' => $request->birthdate,
        ]);

        Mail::to($user->email)->queue(new \App\Mail\ProfileCompletedMail($user));

        return response()->json([
            'message' => 'Perfil atualizado com sucesso!',
            'user' => $user
        ]);
    }
}
