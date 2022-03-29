<x-layout>
    <x-slot name="title">
        新規作成 - Taskun
    </x-slot>

    <div class="back-link">
        &laquo; <a href="{{ route('posts.index') }}">戻る</a>
    </div>

    <h1>新規作成</h1>

    <form method="post" action="{{ route('posts.store') }}">
        @csrf

        <div class="form-group">
            <label>
                タイトル
                <input type="text" name="title" value="{{ old('title') }}">
            </label>
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>
                詳細
                <textarea name="body">{{ old('body') }}</textarea>
            </label>
            @error('body')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>
                期限日
                <input type="text" name="deadline" value="{{ old('deadline') }}">
            </label>
            @error('deadline')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-button">
            <button>追加</button>
        </div>
    </form>
</x-layout>
