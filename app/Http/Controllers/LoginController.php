<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Passport\PersonalAccessTokenResult;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected PersonalAccessTokenResult $tokenResult;

    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $attempt = $this->guard()->attempt($this->credentials($request));

        if ($attempt) {
            $user = $this->guard()->user();

            $token = $user->tokens->where('revoked', false)->where('expires_at', '>', Carbon::now())->first();

            try {
                $this->tokenResult = $token ? $token->getPersonalAccessTokenResult() : $user->createToken('App');

                return true;
            } catch (Exception $e) {
            }
        }

        return false;
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        $token = (string)$this->tokenResult->accessToken;

        return response()->json([
            'token'      => $token,
            'token_type' => 'bearer',
            'expires_at' => Carbon::parse($this->tokenResult->token->expires_at)->toDateTimeString(),
        ], Response::HTTP_OK);
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json(['logout' => true], Response::HTTP_OK);
    }

    public function user(Request $request)
    {
        return $request->user();
    }
}
