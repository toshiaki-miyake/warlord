<x-layout>
    <x-slot name="title">
        {{ $post->title }} - My BBS
    </x-slot>
    <div class="show">
        <div class="head">
            <div class="back-link">
                &laquo; <a href="{{ route('posts.index') }}">戻る</a>
            </div>
        </div>
        <div class="cont">
            @if (Route::has('login'))
            @auth
            <div class="head">
                <a href="{{ route('posts.edit', $post) }}" class="btn edit">編集</a>
                <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete_post">
                    @method('DELETE')
                    @csrf

                    <button class="delete">×</button>
                </form>
            </div>
            @endauth
            @endif
            <ul>
                <li>
                    <h3>タイトル</h3>
                    <p>{{ $post->title }}</p>
                </li>
                <li>
                    <h3>詳細</h3>
                    <p>{!! nl2br(e($post->body)) !!}</p>
                </li>
                <li>
                    <h3>優先度</h3>
                    <p>{{ $post->priority }}</p>
                </li>
                <li>
                    <h3>期限</h3>
                    <p>{{ $post->deadline }}</p>
                </li>
                <li class="comment">
                    <h3>コメント</h3>
                    @if (Route::has('login'))
                    @auth
                    <form method="post" action="{{ route('comments.store', $post) }}" class="comment-form">
                        @csrf

                        <textarea name="body"></textarea>
                        <button class="btn positive" id="confirm">追加</button>
                    </form>
                    @endauth
                    @endif
                    <ul>
                        @foreach ($post->comments()->latest()->get() as $comment)
                            <li>
                                <span>{!! nl2br(e($comment->body)) !!}</span>
                                @if (Route::has('login'))
                                @auth
                                <form method="post" action="{{ route('comments.destroy', $comment) }}" class="delete-comment">
                                    @method('DELETE')
                                    @csrf

                                    <button class="close-btn">[x]</button>
                                </form>
                                @endauth
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <script>
        if(!!document.getElementById('delete_post')){
            document.getElementById('delete_post').addEventListener('submit', e => {
                e.preventDefault();

                if (!confirm('削除してよろしいでしょうか?')) {
                    return;
                }

                e.target.submit();
            });
        };

        document.querySelectorAll('li .delete-comment').forEach(form => {
            form.addEventListener('submit', e => {
                e.preventDefault();
                if (!confirm('削除してよろしいでしょうか?')) {
                    return;
                }
                form.submit();
            });
        });

    </script>
</x-layout>
