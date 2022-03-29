<x-layout>
    <x-slot name="title">
        Taskun
    </x-slot>

    <h1>
        <span>Taskun</span>
        <a href="{{ route('posts.create') }}">&raquo; 新規作成</a>
    </h1>
    <ul>
        @forelse ($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post) }}">
                    {{ $post->title }}
                </a>
            </li>
        @empty
            <li>No posts yet!</li>
        @endforelse
    </ul>
</x-layout>
