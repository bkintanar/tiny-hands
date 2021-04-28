<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param Request $request
     * @param mixed   $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify(Request $request, $id)
    {
        if ($request->route('id') == $request->user()->getKey() &&
            $request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));

            return response()->json(['email_verified' => true], Response::HTTP_OK);
        }

        return response()->json(['email_verified' => false], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['email_verified' => true], Response::HTTP_OK);
        }

        $domain = $request->route()->domain;

        $request->user()->sendEmailVerificationNotification($domain);

        return response()->json(['resent' => true], Response::HTTP_OK);
    }
}
