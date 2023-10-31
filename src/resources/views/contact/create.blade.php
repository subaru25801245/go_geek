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
            <!-- Report Form -->
            <div class="bg-white p-4 rounded shadow-lg">
                <h2 class="text-lg font-semibold mb-4">通報フォーム</h2>
                <p>公序良俗に違反している内容を報告する場合、以下のフォームに記入してください。</p>
                <p>対応には時間がかかる場合がございます。予めご了承ください。</p>

                <form method="post" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="mt-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">タイトル:</label>
                        <input type="text" id="title" name="title" value="{{ $post->title }}" class="mt-1 p-2 w-full border rounded-md" readonly>
                    </div>
                    <div class="mt-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">ご自身のメールアドレス:</label>
                        <input type="email" id="email" name="email" required class="mt-1 p-2 w-full border rounded-md" placeholder="your.email@example.com">
                    </div>
                    <div class="mt-4">
                        <label for="body" class="block text-sm font-medium text-gray-700">理由:</label>
                        <textarea id="body" name="body" required rows="4" class="mt-1 p-2 w-full border rounded-md" placeholder="通報の理由を詳しく記入してください。"></textarea>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">送信</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
