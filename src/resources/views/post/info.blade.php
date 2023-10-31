<x-app-layout>
    <x-slot name="header">
        <!-- Flex container -->
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                サイトご利用に関して
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
        <div class="w-1/4 bg-gray-100 p-4 border-r">
            @include('components.side-menu')
        </div>

        <div class="w-3/4 p-4 custom-bg">
                <img src="{{ asset('logo/thanks.jpg') }}" alt="感謝しています!!" class="centered-image mb-4" >

            <div class="mb-4 bg-white bg-opacity-80 p-4 rounded">
                <h2 class="text-xl font-semibold text-gray-700">ご登録いただき、ありがとうございます！</h2>
                <p class="text-gray-600 mt-2">
                    あなたもこれからエンジニアリングの旅を共にする仲間です。<br>
                    こちらのサイトでは、未経験からエンジニアを目指す皆様のための情報交換の場としてご利用いただけます。<br>
                    活発な情報共有を心よりお待ちしております。
                </p>
            </div>


            <div class="mb-4 bg-white bg-opacity-80 p-4 rounded">
                <h2 class="text-xl font-semibold text-gray-700">利用時の注意事項</h2>
                    <ul class="list-disc pl-5 mt-2 text-gray-600">
                        <li>個人情報や連絡先の公開は避け、プライバシーを守ってください。</li>
                        <li>他のユーザーに対する誹謗中傷や攻撃的なコメントは禁止とさせていただきます。</li>
                        <li>商業的な広告やスパム行為は禁止となっております。</li>
                        <li>不適切と判断される内容の投稿は、管理者の裁量で削除する場合がございます。</li>
                        <li>サイトの利用に関して疑問や不明点があれば、サポートまでお問い合わせください。</li>
                    </ul>
                </div>
            <div class="flex justify-center mt-4">
                <a href="/post" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    記事一覧へ→
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
