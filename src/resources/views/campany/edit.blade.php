<form method="post" action="/campany/{{ $campany->id }}">
    @csrf
    @method('patch')
    <div>
        <input type="text" name="name" placeholder="社名変更">
    </div>

    <div>
        <textarea name="text" placeholder="内容変更"></textarea>
    </div>
    <div>
        <input type="submit" value="変更">
    </div>
</form>
