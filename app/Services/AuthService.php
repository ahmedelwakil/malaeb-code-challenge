<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\PasswordGrantClientNotFoundException;
use App\Models\User;
use App\Utils\PermissionUtil;
use App\Utils\RoleUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\RefreshTokenRepository;

class AuthService
{

    /**
     * @param string $email
     * @param string $password
     * @return array
     * @throws InvalidCredentialsException|PasswordGrantClientNotFoundException
     */
    public function doLogin(string $email, string $password)
    {
        $user = User::query()->where('email', '=', $email)->first();
        if (!$user || !Hash::check($password, $user->password))
            throw new InvalidCredentialsException();

        $client = DB::table('oauth_clients')->where('password_client', '=', true)->first();
        if (!$client)
            throw new PasswordGrantClientNotFoundException();

        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $email,
            'password' => $password,
        ];

        switch ($user->role) {
            case RoleUtil::ADMIN:
                $data['scope'] = '*';
                break;
            case RoleUtil::USER:
                $data['scope'] = implode(' ', PermissionUtil::getUserPermissions());
                break;
            default:
                break;
        }

        $request = Request::create('/oauth/token', 'POST', $data);
        $response = Route::prepareResponse($request, App::handle($request))->getContent();
        $tokens = json_decode($response, true);

        return array_merge($user->toArray(), ['tokens' => $tokens]);
    }

    public function doLogout()
    {
        $refreshTokenRepository = app(RefreshTokenRepository::class);

        $user = Auth::user();
        $userTokens = $user->tokens;
        foreach ($userTokens as $token) {
            $token->revoke();
            $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token->id);
        }
    }
}
