<?php declare(strict_types=1);

namespace App\Http\Controllers\OAuth;

use App\Enums\SocialProvider;
use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiteTwoUser;

final class CallbackFromProviderController extends Controller
{
    /**
     * @param AuthManager $auth
     */
    public function __construct(
        private AuthManager $auth,
    ) {
    }

    /**
     * @param Request $request
     * @param SocialProvider $provider
     * @return JsonResponse
     */
    public function __invoke(Request $request, SocialProvider $provider)
    {
        /** @var SocialiteTwoUser $socialiteTwoUser */
        $socialiteTwoUser = Socialite::driver($provider->value)->user();

        $name = $provider->name;
        $social_id = $socialiteTwoUser->getId();

        $where = [
            'provider_name' => $name,
            'provider_id' => $social_id,
        ];

        $socialAccount = SocialAccount::where($where)->first();

        if ($socialAccount) {
            $this->auth->guard()->login($socialAccount->user);
            $request->session()->regenerate();

            return redirect('/post');
        }

        $email = $socialiteTwoUser->getEmail();
        $test1 = [
            'email' => $email
        ];

        $name = $socialiteTwoUser->getName();
        $password = Hash::make(Str::random());
        $avatarUrl = $socialiteTwoUser->getAvatar();

        $test2 = [
            'name' => $name,
            'password' => $password,
            'github_avatar' => $avatarUrl
        ];

        $user = User::firstOrCreate($test1, $test2);


        $value = $provider->value;
        $provider_id = $socialiteTwoUser->getId();
        $provider_token = $socialiteTwoUser->token;
        $provider_refresh_token = $socialiteTwoUser->refreshToken;

        $total = [
            'provider_name' => $value,
            'provider_id' => $provider_id,
            'provider_token' => $provider_token,
            'provider_refresh_token' => $provider_refresh_token,
        ];

        $user->socialAccounts()->create($total);

        $this->auth->guard()->login($user);
        $request->session()->regenerate();

        return redirect('/post');
    }
}
