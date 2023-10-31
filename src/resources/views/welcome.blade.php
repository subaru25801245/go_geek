<x-guest-layout>
    <div class="h-screen pb-14 bg-right bg-cover">
        <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center bg-yellow-50">
            <!--左側-->
            <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden ">
                <h1 class="my-10 text-3xl md:text-5xl text-green-800 font-bold leading-tight text-center md:text-left slide-in-bottom-h1">エンジニア未経験の転職情報共有</h1>
                <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left slide-in-bottom-subtitle">
                    こちらは、エンジニア未経験のための転職情報共有サイトです。勉強したことがない・勉強はしたけど実務経験が無い・オススメの 資格は何か？などなど、 さまざまな情報を共有するためのサイトです。
                </p>

                <p class="text-blue-400 font-bold pb-8 lg:pb-6 text-center md:text-left fade-in">
                    絶賛会員募集中です!! お気軽に覗いてみてください!!
                </p>
                <div class="flex w-full justify-center md:justify-start pb-24 lg:pb-0 fade-in ">
                    {{-- ボタン設定 --}}
                    <a href="{{route('register')}}" class="mr-3"><x-primary-button class="btnsetr">ご登録はこちら</x-primary-button></a>
                    <a href="{{route('login')}}"><x-primary-button class="btnsetg">会員の方はこちら</x-primary-button></a>
                </div>
            </div>
            {{-- 右側 --}}
            <div class="w-full xl:w-3/5 py-6 overflow-y-hidden">
                <img class="w-5/6 mx-auto lg:mr-0 slide-in-bottom rounded-lg shadow-xl" src="{{asset('logo/question.png')}}">
            </div>
        </div>
        <div class="container pt-10 md:pt-18 px-6 mx-auto flex flex-wrap flex-col md:flex-row items-center">
            <div class="w-full text-sm text-center md:text-left fade-in border-2 p-4 text-red-800 leading-8 mb-8">
                <P> 未経験でエンジニアに転職するというのは、とても大変だと思います。<br>
                どのような知識や経験が必要なのか、年齢は大丈夫なのか、資格は必要なのかなど、さまざまな情報が必要になります。<br>
                そのような未経験者のための、情報共有サイトです。<br>
                チャット形式で、誰でも気軽に始められます!!<br>
                このサイトを活用して、未経験からエンジニアを目指しましょう!!</p>
            </div>
            <!--フッタ-->
            <div class="w-full pt-10 pb-6 text-sm md:text-left fade-in">
                <p class="text-gray-500 text-center">@2023 エンジニア未経験のための転職共有</p>
            </div>
        </div>
    </div>
</x-guest-layout>
