<x-app-layout>
    <x-slot name="header">
        <!-- Flex container -->
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                HOME
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
        <div class="w-1/4 bg-gray-100 p-4 border-r">
            @include('components.side-menu')
        </div>
        <div class="w-3/4 p-4">
            <div class="w-full p-4 bg-green-100 rounded-lg shadow-md">
                <h3 class="text-center text-2xl font-bold mb-4 italic">--クイック投稿--</h3>
                    <form method="post" action="{{route('post.store')}}">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block font-semibold leading-none mt-4 text-gray-600">シェアしたいURL</label>
                            <input type="text" name="title" id="title" class="w-full p-2 border-b border-gray-300 focus:outline-none focus:border-blue-500 transition-colors" placeholder="URLを入力してください">
                        </div>
                        <div class="mb-4">
                            <label for="body" class="block font-semibold leading-none text-gray-600">オススメポイント</label>
                            <textarea name="body" id="body" class="w-full p-2 border-b border-gray-300 focus:outline-none focus:border-blue-500 transition-colors" placeholder="オススメポイントを入力してください"></textarea>
                        </div>
                        <button type="submit" class="text-white bg-blue-500 rounded-full py-2 px-4 hover:bg-blue-600 transition-colors">
                            投稿する
                        </button>
                    </form>
            </div>
            <h2 class="text-center text-2xl font-bold mt-8 mt-4 text-white shadow-md">
                ↓記事一覧↓
            </h2>
                 @foreach ($posts as $post)
                 <a href="{{route('post.show', $post)}}" style="display: block; text-decoration: none;">
                    <div class="mt-4">
                        <div class="bg-white w-full  rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                            <div class="mt-4">
                                <div class="flex items-center">
                                    <div class="rounded-full w-12 h-12 overflow-hidden">
                                        @if($post->user->avatar && $post->user->avatar != 'user_default.jpg')
                                            <img src="{{asset('/storage/avatar/'.$post->user->avatar)}}" class="object-cover w-full h-full">
                                        @elseif($post->user->github_avatar)
                                            <img src="{{$post->user->github_avatar}}" class="object-cover w-full h-full">
                                        @else
                                            <img src="{{asset('/storage/avatar/user_default.jpg')}}" class="object-cover w-full h-full">
                                        @endif
                                    </div>
                                </div>
                                <hr class="w-full">
                                <p class="mt-4 text-gray-600 py-4">{{$post->title}}</p>
                                <p class="mt-4 text-gray-600 py-4">{{Str::limit($post->body, 100, '...')}}</p>
                                @if($post->og_title)
                                    <p class="mt-4 text-gray-600 py-4">{{$post->og_title}}</p>
                                @endif

                                @if($post->og_description)
                                    <p class="mt-4 text-gray-600 py-4">{{$post->og_description}}</p>
                                @endif

                                @if($post->og_image)
                                    <img src="{{$post->og_image}}" class="object-cover w-full h-full">
                                @endif
                                <hr class="w-full mb-2">
                                @if ($post->comments->count())
                                    <span class="badge">
                                        返信 {{$post->comments->count()}}件
                                    </span>
                                @else
                                    <span>コメントはまだありません。</span>
                                @endif
                            </div>
                        </div>
                    </div>
                 </a>
                @endforeach
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
