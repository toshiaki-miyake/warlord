<x-layout>
    <x-slot name="title">
        Add New Post
    </x-slot>
    <div class="create">
        <div class="head">
            <div class="back-link">
                &laquo; <a href="{{ route('posts.index') }}">戻る</a>
            </div>
        </div>
        <div class="cont">
            <form method="post" action="{{ route('posts.store')}}">
                @csrf
                <div class="form-group">
                    <label>
                        <div class="title-wrap">
                            <h3>タイトル</h3>
                        </div>
                        <input type="text" name="title" value="{{ old('title') }}" class="input">
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <div class="title-wrap">
                            <h3>詳細</h3>
                        </div>
                        <textarea name="body" class="input">{{ old('body') }}</textarea>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <div class="title-wrap">
                            <h3>優先度</h3>
                        </div>
                        <input type="number" min="1" max="50" name="priority" value="{{ old('priority') }}" class="priority input">
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <div class="title-wrap">
                            <h3>期限</h3>
                        </div>
                        <input type="text" name="deadline" value="{{ old('deadline') }}" id="deadline" class="deadline input" maxlength="8" placeholder="20220501">
                    </label>
                </div>
                <div class="form-button">
                    <button class="btn positive" id="confirm">確定</button>
                </div>

            </form>
        </div>
    </div>
    <script>
        const elemConfirm = document.getElementById('confirm');
        elemConfirm.addEventListener('click', function(e){
            const elemFormGroup = document.getElementsByClassName('form-group');
            for(let i = 0; i < elemFormGroup.length; i++){
                let elemInput = document.getElementsByClassName('input')[i];
                // inputのテキストが空の時
                if(elemInput.value.length === 0){
                    if(i === 0){
                        e.preventDefault();
                    };
                    if(elemFormGroup[i].getElementsByTagName('p')[0] === undefined){
                        let elemH3Wrap = elemFormGroup[i].getElementsByClassName('title-wrap')[0];
                        let elemP = document.createElement('p');
                        elemP.innerHTML = '※入力してください' + i;
                        elemH3Wrap.appendChild(elemP);
                    };
                } else if(elemFormGroup[i].getElementsByTagName('p')[0] !== undefined) {
                    if(i === 0){
                        e.preventDefault();
                    };
                    elemFormGroup[i].getElementsByTagName('p')[0].remove();
                };
            };
            const deadlineDate = document.getElementById('deadline').value;
            if(deadlineDate.length === 8){
                let deadlineDateY = deadlineDate.substr(0, 4);
                let deadlineDateM = deadlineDate.substr(4, 2);
                let deadlineDateD = deadlineDate.substr(6, 2);
                let deadlineNewDate = new Date(deadlineDateY, deadlineDateM - 1, deadlineDateD);

                let currentNewDate = new Date();

                if(currentNewDate > deadlineNewDate){
                    e.preventDefault();

                    if(elemFormGroup[3].getElementsByTagName('p')[0] === undefined){
                        let elemH3Wrap = elemFormGroup[3].getElementsByClassName('title-wrap')[0];
                        let elemP = document.createElement('p');
                            elemP.innerHTML = '期限日が過ぎています';
                            elemH3Wrap.appendChild(elemP);
                    };
                };
            } else {
                e.preventDefault();
            }
        });


    </script>
</x-layout>
