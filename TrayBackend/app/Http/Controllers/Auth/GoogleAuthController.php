<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Google\GoogleAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GoogleAuthController extends Controller
{
    protected GoogleAuthService $googleService;

    public function __construct(GoogleAuthService $googleService)
    {
        $this->googleService = $googleService;
    }

    public function redirect()
    {
        return response()->json([
            'url' => $this->googleService->getAuthUrl()
        ]);
    }

    public function callback(Request $request)
    {
        if (!$request->has('code')) {
            return response()->json(['error' => 'Código de autorização ausente.'], 400);
        }

        $accessToken = $this->googleService->fetchAccessTokenWithCode($request->code);

        if (isset($accessToken['error'])) {
            return response()->json(['error' => 'Erro ao autenticar com Google'], 400);
        }

        $userInfo = $this->googleService->getUserInfo($accessToken['access_token']);

        $user = User::firstOrCreate(
            ['email' => $userInfo['email']],
            [
                'name' => $userInfo['name'],
                'google_token' => json_encode($accessToken),
            ]
        );

        return redirect("http://localhost:5173/complete-profile?email={$user->email}");
    }
}
