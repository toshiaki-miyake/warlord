<x-layout>
    <x-slot name="title">WARLOAD</x-slot>

    <div class="home">
        @if (Route::has('login'))
        @auth
            <div class="head">
                <a href="{{ route('posts.create') }}" class="btn positive">追加する</a>
            </div>
        {{-- @else --}}

        @endauth
        @endif
        <div class="cont">
            <div class="head">
                <h3>タイトル</h3>
                <div class="set">
                    <h3 class="priority">優先度</h3>
                    <h3 class="deadline">期限</h3>
                </div>
            </div>
            <ul id="list">
                @forelse ($posts as $post)
                    <li>
                        <a href="{{ route('posts.show', $post) }}">
                            <span class="title">{{ $post->title }}</span>
                            <span class="wrap">
                                <span class="priority">{{ $post->priority }}</span>
                                <span class="deadline">{{ $post->deadline }}</span>
                            </span>
                        </a>
                    </li>
                @empty
                    <li>No posts yet!</li>
                @endforelse
            </ul>
        </div>
    </div>
    <script>
        const elemDeadline = document.getElementById('list').getElementsByClassName('deadline');
        let deadlineDate,
            deadlineDateY,
            deadlineDateM,
            deadlineDateD,
            datelineNewDate,
            currentNewDate;

        for(let i = 0; i < elemDeadline.length; i++) {
            deadlineDate = elemDeadline[i].textContent;
            deadlineDateY = deadlineDate.substr(0, 4);
            deadlineDateM = deadlineDate.substr(5, 2);
            deadlineDateD = deadlineDate.substr(8, 2);
            datelineNewDate = new Date(deadlineDateY, deadlineDateM - 1, deadlineDateD, 23, 59, 59, 999);
            currentNewDate = new Date();
            if(datelineNewDate < currentNewDate){
                elemDeadline[i].classList.add('heat');
            };
        };
    </script>
</x-layout>
