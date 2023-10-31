<x-app-layout>
    <p>・{{$campany->name}}</p>
    <p>{{$campany->text}}</p>

    <a href="/campany/{{ $campany->id }}/edit"><x-primary-button class="bg-green-700 float-right">編集</x-primary-button></a>

    <form method="post" action="/campany/{{ $campany->id }}">
        @csrf
        @method('delete')
        <x-primary-button class="bg-red-700 float-right ml-4" onClick="return confirm('本当に削除しますか？');">削除</x-primary-button>
    </form>

</x-app-layout>
