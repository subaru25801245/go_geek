<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                記事の詳細
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
        <!-- Sidebar Section -->
        <div class="w-1/4 bg-gray-100 p-4 border-r">
            @include('components.side-menu')
        </div>
        <!-- Main Content Section -->
        <div class="w-3/4 p-4 custom-bg">
            <div class="mx-4 sm:p-8">
                <div class="px-10 mt-4">
                    <div class="bg-white w-full rounded-2xl px-10 pt-2 pb-8 shadow-lg hover:shadow-2xl transition duration-500">
                        <div class="mt-4">
                            <div class="flex items-center justify-between">
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
                                @if(auth()->user() && auth()->user()->favorite_posts->contains($post->id))
                                    <form action="{{ route('favorites.destroy', $post) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">
                                            お気に入りから削除
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('favorites.store', $post) }}" method="post">
                                        @csrf
                                        <button type="submit" class="text-blue-500 hover:underline">
                                            お気に入りに登録
                                        </button>
                                    </form>
                                @endif

                            </div>
                            <hr class="w-full">
                        </div>

                        <div class="flex justify-end mt-4">
                            @can('update', $post)
                                <a href="{{route('post.edit', $post)}}"><x-primary-button class="bg-teal-700 float-right">編集</x-primary-button></a>
                            @endcan
                            @can('delete', $post)
                                <form method="post" action="{{route('post.destroy', $post)}}">
                                    @csrf
                                    @method('delete')
                                    <x-primary-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
                                </form>
                            @endcan
                        </div>
                        <div>
                            <p class="mt-4 text-gray-600 py-4 whitespace-pre-line">
                                <a href="{{$post->title}}" target="_blank" class="text-blue-500 hover:underline">{{$post->title}}</a>
                            </p>
                            <p class="mt-4 text-gray-600 py-4 whitespace-pre-line">{{$post->body}}</p>
                            @if($post->image)
                                <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
                            @endif

                            @if($post->og_title)
                                <p class="mt-4 text-gray-600 py-4">{{$post->og_title}}</p>
                            @endif

                            @if($post->og_description)
                                <p class="mt-4 text-gray-600 py-4">{{$post->og_description}}</p>
                            @endif

                            @if($post->og_image)
                                <img src="{{$post->og_image}}" class="object-cover w-full h-full">
                            @endif

                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <p><a href="{{ route('post.yourProfile', $post->user->id) }}" class="hover:underline text-gray-700">{{ $post->user->name }}</a>• {{ $post->created_at->format('Y年m月d日') }} </p>
                            </div>
                        </div>
                    </div>
                    @foreach ($post->comments as $comment)
                        <div class="bg-white w-full rounded-2xl px-10 py-8 shadow-lg mt-8 whitespace-pre-line">
                            {{$comment->body}}
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <p class="float-left pt-4"> <a href="{{ route('post.yourProfile', $comment->user->id) }}">{{ $comment->user->name }}</a> • {{$comment->created_at->format('Y年m月d日')}}</p>
                                <span class="w-12 h-12 overflow-hidden">
                                <img class="rounded-full" src="{{asset('storage/avatar/'.($comment->user->avatar??'user_default.jpg'))}}">
                            </span>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4 mb-12">
                        <form method="post" action="{{route('comment.store')}}">
                            @csrf
                            <input type="hidden" name='post_id' value="{{$post->id}}">
                            <textarea name="body" class="bg-white w-full rounded-2xl px-4 mt-4 py-4 shadow-lg hover:shadow-2xl transition duration-500" id="body" cols="30" rows="3" placeholder="コメントを入力してください">{{old('body')}}</textarea>
                            <x-primary-button class="float-right mr-4 mb-12">コメントする</x-primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
