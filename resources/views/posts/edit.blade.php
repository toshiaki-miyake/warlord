
<x-layout>
    <x-slot name="title">
        Edit Post - My BBS
    </x-slot>
    <div class="back-link">
        &laquo; <a href="{{ route('posts.show', $post) }}">戻る</a>
    </div>
    <h1>Edit Post</h1>
    <form method="post" action="{{ route('posts.update', $post) }}">
        @method('PATCH')
        @csrf
        <div class="form-grouop">
            <label>
                Title
                <input type="text" name="title" value="{{ old('title', $post->title) }}">
            </label>
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-grouop">
            <label>
                Body
                <textarea name="body">{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <div class="error">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div class="form-grouop">
            <label>
                Priority
                <input type="number" name="priority" value="{{ old('priority', $post->priority) }}">
                @error('priority')
                    <div class="error">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div class="form-button">
            <button>Update</button>
        </div>
    </form>
</x-layout>
