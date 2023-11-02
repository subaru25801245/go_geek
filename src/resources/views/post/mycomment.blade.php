<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                コメントした記事
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
        <!-- Sidebar -->
        <div class="w-1/4 bg-gray-100 p-4 border-r">
            @include('components.side-menu')
        </div>

        <!-- Main Content -->
        <div class="w-3/4 p-4 custom-bg">
            @if (count($comments) == 0)
                <div class="flex justify-center items-center min-h-screen bg-opacity-50 bg-black">
                    <div class="p-4 bg-white rounded-lg shadow-md">
                        <p class="text-2xl text-gray-800">あなたはまだコメントしていません</p>
                    </div>
                </div>

            @else
                @foreach ($comments->unique('post_id') as $comment)
                    @php
                        $post = $comment->post;
                    @endphp
                    <div class="post-container" data-url="{{route('post.show', $post)}}">
                    <div class="mx-4 sm:p-8">
                        <div class="mt-4">
                            <div class="bg-white w-full rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
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
                                        @if(auth()->user() && auth()->user()->favorite_posts->contains($post->id))
                                            <form action="{{ route('favorites.destroy', $post) }}" method="post" class="ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">
                                                    お気に入りから削除
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('favorites.store', $post) }}" method="post" class="ml-2">
                                                @csrf
                                                <button type="submit" class="text-blue-500 hover:underline">
                                                    お気に入りに登録
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <hr class="w-full">
                                    <p><a href="{{ $post->title }}" class="mt-4 text-blue-600 hover:underline py-4 whitespace-pre-line break-words block focus:outline-none focus:ring focus:border-blue-300"
                                          tabindex="0">{{$post->title}}</a> </p>
                                        <p class="mt-4 text-gray-600 py-4">{!! $post->body !!}</p>

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
                    </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

</x-app-layout>
