<x-app-layout>

    <form method="post" action="/campany/store">
        @csrf
        <div>
            <input type="text" name="name" placeholder="社名">
        </div>

        <div>
            <textarea name="text" placeholder="内容"></textarea>
        </div>

        <div>
            <input type="submit" value="新規登録">
        </div>

    </form>

</x-app-layout>
