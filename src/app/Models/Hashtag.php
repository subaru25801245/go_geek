<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

    class Hashtag extends Model
    {

    use HasFactory;

    // 代入を許可するカラム
    protected $fillable = ['name'];

    /**
    * このハッシュタグに関連する投稿を取得する。
    */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_hashtag');
    }

    /**
    * ハッシュタグ名を元にハッシュタグを取得または作成する。
    *
    * @param string $tagName
    * @return Hashtag
    */
    public static function findOrCreateByName(string $tagName): Hashtag
    {
        return self::firstOrCreate(['name' => $tagName]);
    }

    /**
    * 名前を元にハッシュタグを検索するスコープ
    *
    * @param $query
    * @param string $name
    * @return mixed
    */
    public function scopeWithName($query, string $name)
    {
        return $query->where('name', $name);
    }


}
