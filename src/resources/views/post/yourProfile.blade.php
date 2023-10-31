<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                投稿者のプロフィール
            </h2>
            <!-- Search Form -->
            <div class="flex items-center space-x-0">
                <form action="{{ route('post.search') }}" method="GET" class="flex items-center space-x-0 border rounded-md">
                    <input type="text" name="query" placeholder="投稿の検索" class="rounded-l-md px-2 py-1 h-8 focus:outline-none">
                    <button type="submit" class="px-3 py-1 rounded-r-md bg-blue-500 text-white">検索</button>
                </form>
            </div>
        </div>

        <x-message :message="session('message')" />

    </x-slot>
    <div class="max-w-full mx-auto flex">

        <!-- Side Menu -->
        <div class="w-1/4 bg-gray-100 p-4 border-r">
            @include('components.side-menu')
        </div>

        <!-- User Information -->
        <div class="w-3/4 p-4 space-y-4 custom-bg">

            <!-- Name -->
            <div class="border p-4 rounded bg-white">
                <div class="font-bold text-sm uppercase">お名前:</div>
                <h1 class="text-xl">{{ $user->name }}</h1>
            </div>

            <!-- lang -->
            @if($user->lang)
                <div class="border p-4 rounded bg-white">
                    <div class="font-bold text-sm uppercase">学習している言語:</div>
                    <p class="mt-2">{{ $user->lang }}</p>
                </div>
            @endif

            <!-- Avatar -->
            @php
                $displayAvatar = null;

                if ($user->avatar && $user->avatar !== 'user_default.jpg') {
                    $displayAvatar = asset('storage/avatar/' . $user->avatar);
                } elseif ($user->github_avatar) {
                    $displayAvatar = $user->github_avatar;
                } elseif ($user->avatar === 'user_default.jpg') {
                    $displayAvatar = asset('storage/avatar/user_default.jpg');
                }
            @endphp

            @if($displayAvatar)
                <div class="border p-4 rounded bg-white">
                    <div class="font-bold text-sm uppercase">プロフィール画像:</div>
                    <img src="{{ $displayAvatar }}" class="w-48 h-48 rounded-full mt-4">
                </div>
            @endif

            <!-- Bio -->
            @if($user->bio)
                <div class="border p-4 rounded bg-white">
                    <div class="font-bold text-sm uppercase">自己紹介:</div>
                    <p class="mt-2">{{ $user->bio }}</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
