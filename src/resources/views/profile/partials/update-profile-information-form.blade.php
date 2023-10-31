<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('プロフィール画面') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("アカウントの名前とメールアドレスを更新してください。") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="lang" :value="__('学習している言語')" />
            <x-text-input id="lang" name="lang" type="text" class="mt-1 block w-full" :value="old('lang', $user->lang)" autofocus autocomplete="lang" />
            <x-input-error class="mt-2" :messages="$errors->get('lang')" />
        </div>

        <div>
            <x-input-label for="bio" :value="__('自己紹介')" />
            <textarea id="bio" name="bio" class="mt-1 block w-full" rows="4">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div>
            <x-input-label for="avatar" :value="__('プロフィール画像（任意・1MBまで）')" />
            <div class="rounded-full w-36">
                @if($user->avatar && $user->avatar != 'user_default.jpg')
                    <img src="{{asset('/storage/avatar/'.$user->avatar)}}">
                @elseif($user->github_avatar)
                    <img src="{{$user->github_avatar}}">
                @else
                    <img src="{{asset('/storage/avatar/user_default.jpg')}}">
                @endif
            </div>
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar')" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('更新する') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
