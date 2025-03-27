<?php
namespace App\Http\Controllers;

use App\Http\Requests\CompleteProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function index(Request $request)
    {
        $users = $this->userService->getFilteredUsers($request->only(['name', 'cpf']));
        return UserResource::collection($users);
    }

    public function completeProfile(CompleteProfileRequest $request)
    {
        $user = $this->userService->completeProfile($request->validated());

        return response()->json([
            'message' => 'Perfil atualizado com sucesso!',
            'user' => $user
        ]);
    }
}