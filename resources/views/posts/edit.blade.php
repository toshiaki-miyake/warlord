@if (Route::has('login'))
@auth
@else
<?php
    http_response_code( 301 );
    header( "Location: /" );
    exit;
?>
@endauth
@endif
<x-layout>
    <x-slot name="title">
        Edit Post - My BBS
    </x-slot>

    <div class="edit">
        <div class="head">
            <div class="back-link">
                &laquo; <a href="{{ route('posts.show', $post) }}">戻る</a>
            </div>
        </div>
        <div class="cont">
            <form method="post" action="{{ route('posts.update', $post) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label>
                        <div class="title-wrap">
                            <h3>タイトル</h3>
                        </div>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}" class="input">
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <div class="title-wrap">
                            <h3>詳細</h3>
                        </div>
                        <textarea name="body" class="input">{{ old('body', $post->body) }}</textarea>
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <div class="title-wrap">
                            <h3>優先度</h3>
                        </div>
                        <input type="number" min="1" max="50" name="priority" value="{{ old('priority', $post->priority) }}" class="priority input">
                    </label>
                </div>
                <div class="form-group">
                    <label>
                        <div class="title-wrap">
                            <h3>期限</h3>
                        </div>
                        <?php
                            $post_deadline = str_replace('-', '', $post->deadline);
                        ?>
                        <input type="text" name="deadline" value="{{ old('deadline', $post_deadline) }}" id="deadline" class="deadline input" maxlength="8">
                    </label>
                </div>
                <div class="form-button">
                    <button class="btn positive" id="confirm">確定</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const elemDeadline = document.getElementById('deadline');
        const currentNewDate = new Date();
        let currentNewDateGetY = currentNewDate.getFullYear();
        let currentNewDateGetM = ('00' + (currentNewDate.getMonth() + 1)).slice(-2);
        let currentNewDateGetD = ('00' + (currentNewDate.getDate())).slice(-2);
        const currentNewDate8 = currentNewDateGetY + currentNewDateGetM + currentNewDateGetD;
        elemDeadline.setAttribute('placeholder', currentNewDate8);

        const elemConfirm = document.getElementById('confirm');
        elemConfirm.addEventListener('click', function(e){
            const elemFormGroup = document.getElementsByClassName('form-group');
            for(let i = 0; i < elemFormGroup.length; i++){
                let elemInput = document.getElementsByClassName('input')[i];
                // inputに入力なし
                if(elemInput.value.length === 0){
                    e.preventDefault();
                    // エラーテキストなし
                    if(elemFormGroup[i].getElementsByTagName('p')[0] === undefined){
                        let elemH3Wrap = elemFormGroup[i].getElementsByClassName('title-wrap')[0];
                        let elemP = document.createElement('p');
                        elemP.innerHTML = '※入力してください';
                        elemH3Wrap.appendChild(elemP);
                    }
                    // エラーテキストあり
                    else {
                        elemFormGroup[i].getElementsByTagName('p')[0].innerHTML = '※入力してください';
                    };
                }
                // inputに入力あり
                else {
                    // エラーテキスト削除
                    if(elemFormGroup[i].getElementsByTagName('p')[0] !== undefined) {
                        elemFormGroup[i].getElementsByTagName('p')[0].remove();
                    };
                    const deadlineDate = elemDeadline.value;
                    const reg = new RegExp(/^[0-9]{8}$/);
                    const regTest = reg.test(deadlineDate);
                    // deadline入力が8文字以下または半角数字以外
                    if(!regTest){
                        e.preventDefault();
                        // inputに入力なし
                        if(elemFormGroup[3].getElementsByTagName('p')[0] === undefined){
                            let elemH3Wrap = elemFormGroup[3].getElementsByClassName('title-wrap')[0];
                            let elemP = document.createElement('p');
                                elemP.classList.add('error-deadline');
                                elemP.innerHTML = '半角で8文字数字を入力してください';
                                elemH3Wrap.appendChild(elemP);
                        } else {
                            // inputに入力あり
                            elemFormGroup[3].getElementsByTagName('p')[0].innerHTML = '半角で8文字数字を入力してください';
                        }
                    } else {
                        let deadlineDateY = deadlineDate.substr(0, 4);
                        let deadlineDateM = deadlineDate.substr(4, 2);
                        let deadlineDateD = deadlineDate.substr(6, 2);
                        let deadlineNewDate = new Date(deadlineDateY, deadlineDateM - 1, deadlineDateD, 23, 59, 59, 999);

                        let deadlineGetM = ('00' + (deadlineNewDate.getMonth() + 1)).slice(-2);
                        // 存在する日付かチェック
                        if(deadlineDateM === deadlineGetM){
                            if(currentNewDate > deadlineNewDate){
                                e.preventDefault();
                                if(elemFormGroup[3].getElementsByTagName('p')[0] === undefined){
                                    let elemH3Wrap = elemFormGroup[3].getElementsByClassName('title-wrap')[0];
                                    let elemP = document.createElement('p');
                                        elemP.classList.add('error-deadline');
                                        elemP.innerHTML = '日付が過ぎています';
                                        elemH3Wrap.appendChild(elemP);
                                } else {
                                    elemFormGroup[3].getElementsByTagName('p')[0].innerHTML = '日付が過ぎています';
                                };
                            };
                        } else {
                            e.preventDefault();
                            if(elemFormGroup[3].getElementsByTagName('p')[0] === undefined){
                                let elemH3Wrap = elemFormGroup[3].getElementsByClassName('title-wrap')[0];
                                let elemP = document.createElement('p');
                                    elemP.classList.add('error-deadline');
                                    elemP.innerHTML = '存在しない日付です';
                                    elemH3Wrap.appendChild(elemP);
                            } else {
                                elemFormGroup[3].getElementsByTagName('p')[0].innerHTML = '存在しない日付です';
                            };
                        };
                    };
                };
            };
        });
    </script>
</x-layout>
