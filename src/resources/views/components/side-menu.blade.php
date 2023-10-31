<div class="side-menu">
    <ul class="list-none p-4 space-y-4 bg-gray-100 border-r">
        <li class="text-xl font-semibold pb-4 border-b">サイドメニュー</li>
        <li>
            <x-nav-link :href="route('post.info')" :active="request()->routeIs('post.info')">
                サイト利用に関して
            </x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('post.index')" :active="request()->routeIs('post.index')">
                HOME
            </x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('post.create')" :active="request()->routeIs('post.create')">
                新規作成
            </x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('post.mypost')" :active="request()->routeIs('post.mypost')">
                投稿した記事
            </x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('post.mycomment')" :active="request()->routeIs('post.mycomment')">
                コメントした記事
            </x-nav-link>
        </li>
        <li>
            <x-nav-link :href="route('post.myProfile')" :active="request()->routeIs('post.myProfile')">
                プロフィール
            </x-nav-link>
        </li>

        <li>
            <x-nav-link :href="route('favorites.index')" :active="request()->routeIs('favorites.index')">
                お気に入り一覧
            </x-nav-link>
        </li>

        <li>
            @can('admin')
                <x-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.index')">
                    ユーザー一覧
                </x-nav-link>
            @endcan
        </li>
    </ul>
</div>
