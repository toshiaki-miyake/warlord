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
            <div class="head">
                <a href="{{ route('posts.edit', $post) }}" class="btn edit">編集</a>
                <form method="post" action="{{ route('posts.destroy', $post) }}" id="delete_post">
                    @method('DELETE')
                    @csrf

                    <button class="delete">×</button>
                </form>
            </div>
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
            </ul>
            <div class="comment">
                <h3>コメント</h3>
                <ul>
                    <li>
                        <form method="post" action="{{ route('comments.store', $post) }}" class="comment-form">
                            @csrf

                            <textarea name="body"></textarea>
                            <button class="btn positive" id="confirm">追加</button>
                        </form>
                    </li>
                    @foreach ($post->comments()->latest()->get() as $comment)
                        <li>
                            {!! nl2br(e($comment->body)) !!}
                            <form method="post" action="{{ route('comments.destroy', $comment) }}" class="delete-comment">
                                @method('DELETE')
                                @csrf

                                <button class="btn">[x]</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('delete_post').addEventListener('submit', e => {
            e.preventDefault();

            if (!confirm('削除してよろしいでしょうか?')) {
                return;
            }

            e.target.submit();
        });

        document.querySelectorAll('.delete-comment').forEach(form => {
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
