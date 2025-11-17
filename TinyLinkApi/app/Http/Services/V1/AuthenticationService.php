<?php

namespace App\Http\Services\V1;

use App\Enums\Authentication;
use App\Enums\Token;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\RefreshToken;

class AuthenticationService
{
    /**
     * Generate user login token
     *
     * @param array $credentials
     * @return array
     * @throws Exception
     */
    public static function userLoginToken(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            logger()->error("authentication: login failed for user: {$credentials['email']}");

            throw new Exception('Invalid credentials');
        }

        $token = $user->createToken(Authentication::API_TOKEN->value)->accessToken;

        return [
            'user' => $user,
            'token' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_in_days' => Token::TOKEN_TTL_DAYS->value,
            ]
        ];
    }

    /**
     * Refresh user token
     *
     * @param User $user
     * @return string
     */
    public static function refreshToken(User $user): string
    {
        $currentUserToken = $user->token();
        if ($currentUserToken) {
            $currentUserToken->revoke();
            RefreshToken::query()
                ->where('access_token_id', $currentUserToken->id)
                ->update(['revoked' => true]);
        }

        return $user->createToken(Authentication::API_TOKEN->value)->accessToken;
    }
}
