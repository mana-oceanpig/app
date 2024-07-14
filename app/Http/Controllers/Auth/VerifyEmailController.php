<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        Log::info('VerifyEmailController invoked', [
            'user_id' => $request->user()->id,
            'email' => $request->user()->email,
        ]);

        try {
            if ($request->user()->hasVerifiedEmail()) {
                Log::info('User email already verified');
                return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
            }

            if ($request->user()->markEmailAsVerified()) {
                event(new Verified($request->user()));
                Log::info('User email marked as verified');
            }

            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        } catch (\Exception $e) {
            Log::error('Error in email verification process', [
                'error' => $e->getMessage(),
                'user_id' => $request->user()->id,
            ]);
            return redirect()->route('verification.notice')->with('error', 'メール認証中にエラーが発生しました。もう一度お試しください。');
        }
    }
}