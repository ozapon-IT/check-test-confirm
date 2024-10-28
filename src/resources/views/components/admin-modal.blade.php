<div class="modal" id="modal-{{ $contact->id }}">
    <div class="modal__content">
        <!-- 閉じるボタン -->
        <a href="#" class="modal__close"><i class="bi bi-x-circle"></i></a>

        <!-- お問い合わせ詳細 -->
        <div class="contact__box">
            <div class="contact__item">
                <p>お名前</p>
            </div>
            <div class="contact__content">
                <p>{{ $contact->full_name }}</p>
            </div>
        </div>
        <div class="contact__box">
            <div class="contact__item">
                <p>性別</p>
            </div>
            <div class="contact__content">
                <p>{{ $contact->gender_text }}</p>
            </div>
        </div>
        <div class="contact__box">
            <div class="contact__item">
                <p>メールアドレス</p>
            </div>
            <div class="contact__content">
                <p>{{ $contact->email }}</p>
            </div>
        </div>
        <div class="contact__box">
            <div class="contact__item">
                <p>電話番号</p>
            </div>
            <div class="contact__content">
                <p>{{ $contact->tell }}</p>
            </div>
        </div>
        <div class="contact__box">
            <div class="contact__item">
                <p>住所</p>
            </div>
            <div class="contact__content">
                <p>{{ $contact->address }}</p>
            </div>
        </div>
        <div class="contact__box">
            <div class="contact__item">
                <p>建物名</p>
            </div>
            <div class="contact__content">
                <p>{{ $contact->building ?? 'なし' }}</p>
            </div>
        </div>
        <div class="contact__box">
            <div class="contact__item">
                <p>お問い合わせの種類</p>
            </div>
            <div class="contact__content">
                <p>{{ $contact->category->content }}</p>
            </div>
        </div>
        <div class="contact__box">
            <div class="contact__item">
                <p>お問い合わせ内容</p>
            </div>
            <div class="contact__content">
                <p>{{ $contact->detail }}</p>
            </div>
        </div>

        <!-- 削除ボタン -->
        <form action="{{ route('admin.destroy', ['id' => $contact->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="button__box">
                <button type="submit" class="modal__delete-button">削除</button>
            </div>
        </form>
    </div>
</div>
