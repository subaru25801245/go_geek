<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                プロフィール
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
    <div class="max-w-full mx-auto flex custom-bg">

        <!-- Side Menu -->
        <div class="w-1/4 bg-gray-100 p-4 border-r">
            @include('components.side-menu')
        </div>

        <!-- User Information -->
        <div class="w-3/4 p-4 space-y-4">




        </div>
    </div>
</x-app-layout>
