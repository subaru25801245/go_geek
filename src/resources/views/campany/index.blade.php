<x-app-layout>

    <div>
        <a href="/campany">新規登録</a>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @foreach ($campanies as $campany)
            <a href="/campany/{{ $campany->id }}">・{{ $campany->name }}<br></a>
        @endforeach
    </div>

</x-app-layout>
