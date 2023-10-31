<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                記事の更新
            </h2>
            <!-- Search Form -->
            <div class="flex items-center space-x-0">
                <form action="{{ route('post.search') }}" method="GET" class="flex items-center space-x-0 border rounded-md">
                    <input type="text" name="query" placeholder="投稿の検索" class="rounded-l-md px-2 py-1 h-8 focus:outline-none">
                    <button type="submit" class="px-3 py-1 rounded-r-md bg-blue-500 text-white">検索</button>
                </form>
            </div>
        </div>
        <x-validation-errors class="mb-4" :errors="$errors"/>
        <x-message :message="session('message')" />

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 custom-bg">
        <div class="mx-4 sm:p-8">
            <form method="post" action="{{route('post.update', $post)}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label for="body" class="font-semibold leading-none mt-4">URL</label>
                        <input type="text" name="title" class="w-auto py-2 border border-gray-300 rounded-md" id="title" value="{{old('title', $post->title)}}" placeholder="Enter Title">
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    <label for="body" class="font-semibold leading-none mt-4">オススメポイント</label>
                    <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30" rows="10">{{old('body', $post->body)}}</textarea>
                </div>

                <div class="w-full flex flex-col">
                    @if($post->image)
                        <div>
                            (画像ファイル：{{$post->image}})
                        </div>
                        <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
                    @endif
                    <label for="image" class="font-semibold leading-none mt-4">画像 </label>
                    <div>
                        <input id="image" type="file" name="image">
                    </div>
                </div>

                <x-primary-button class="mt-4">
                    送信する
                </x-primary-button>

            </form>
        </div>
    </div>

</x-app-layout>
