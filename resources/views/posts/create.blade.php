
<x-layout>
    <x-slot name="title">
        Add New Post - My BBS
    </x-slot>
    <div class="back-link">
        &laquo; <a href="{{ route('posts.index') }}">戻る</a>
    </div>
    <h1>Add New Post</h1>
    <form method="post" action="{{ route('posts.store')}}">
        @csrf
        <div class="form-grouop">
            <label>
                Title
                <input type="text" name="title" value="{{ old('title') }}">
            </label>
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-grouop">
            <label>
                Body
                <textarea name="body">{{ old('body') }}</textarea>
                @error('body')
                    <div class="error">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div class="form-grouop">
            <label>
                Priority
                <input type="number" name="priority" value="{{ old('priority') }}">
                @error('priority')
                    <div class="error">{{ $message }}</div>
                @enderror
            </label>
        </div>
        <div class="form-button">
            <button>Add</button>
        </div>

    </form>
</x-layout>
