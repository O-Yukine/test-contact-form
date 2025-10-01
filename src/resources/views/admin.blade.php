@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="admin">
        <div class="admin__content">
            <div class="section__title">
                <h2>Admin</h2>
            </div>
            <form class="search-form" action="/admin" method="get">
                @csrf
                <div class="search-form__item">
                    <input class="search-form__item-input" type="text" name="keyword"
                        value="{{ old('keyword') }}"placeholder="名前やメールアドレスを入力してください" />
                    <select class="search-form__item-gender" name="gender">
                        <option value="" {{ old('gender') === '' ? 'selected' : '' }}>性別</option>
                        <option value="1" {{ old('gender') === '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ old('gender') === '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ old('gender') === '3' ? 'selected' : '' }}>その他</option>
                    </select>


                    <select class="search-form__item-category"name="category_id">
                        <option value="">お問い合わせの種類</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"{{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}</option>
                        @endforeach
                    </select>
                    <input type="date" class="search-form__item-date" name="created_at"
                        value="{{ old('created_at') }}" />
                </div>
                <div class="search-form__button">
                    <button class="search-form__button-submit" type="submit">検索</button>
                    <button type="button" class="search-form__button-reset" onclick="location.href='{{ url('/admin') }}'">
                        リセット
                    </button>

                </div>
            </form>
            <div class="buttons">
                <div class="export-btn">
                    <button class="export">エクスポート</button>
                </div>
                <div class="">
                    {{ $contacts->links() }}
                </div>
            </div>
            <div class="admin-table">
                <table class="admin-table__inner">
                    <tr class="admin-table__row">
                        <th class="admin-table__header">お名前</th>
                        <th class="admin-table__header">性別</th>
                        <th class="admin-table__header">メールアドレス</th>
                        <th class="admin-table__header">お問い合わせの種類</th>
                    </tr>
                    @foreach ($contacts as $contact)
                        <tr class="admin-table__row">
                            <td class="admin-table__item"><span>{{ $contact->last_name }}</span>
                                <span>{{ $contact->fist_name }}</span>
                            </td>
                            <td class="aadmin-table__item"><input type="hidden" name="gender"
                                    value="{{ $contact['gender'] }}" />
                                @if ($contact['gender'] == 1)
                                    男性
                                @elseif ($contact['gender'] == 2)
                                    女性
                                @else
                                    その他
                                @endif
                            </td>
                            <td class="admin-table__item">{{ $contact->email }}</td>
                            <td class="admin-table__item"> {{ $contact['category']['content'] }}

                            </td>
                            <td class="detail-button">
                                <button class="detail-btn" data-id="{{ $contact->id }}"
                                    data-last_name="{{ $contact->last_name }}"
                                    data-first_name="{{ $contact->first_name }}" data-gender="{{ $contact->gender }}"
                                    data-email="{{ $contact->email }}" data-tel="{{ $contact->tel }}"
                                    data-address="{{ $contact->address }}" data-building="{{ $contact->building }}"
                                    data-category="{{ optional($contact->category)->content }}"
                                    data-detail="{{ $contact->detail }}" onclick="openModal(this)">
                                    詳細
                                </button>


                                {{-- <button wire:click="openModal()" type="button" class="detail">詳細</button> --}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    {{-- @if ($showModal) --}}
    <div id="modal" class="modal-wrapper" style="display: none;">


        <div class="modal-window">
            <button onclick="document.getElementById('modal').style.display='none'">閉じる</button>

            {{-- <button wire:click="closeModal()" type="button" class="modal-close">
                ×
            </button> --}}
            <table class="modal__content">
                <tr class="modal-inner">
                    <th class="modal-ttl">お名前</th>
                    <td class="modal-data">
                        <span id="modal-name">
                            {{ $contacts['last_name'] }}
                            {{ $contacts['first_name'] }}</span>
                    </td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">性別</th>
                    <td class="modal-data"><span id="modal-gender">
                            {{-- <input type="hidden" value="{{ $contact['gender'] }}" /> --}}
                            <?php
                            if ($contacts['gender'] == '1') {
                                echo '男性';
                            } elseif ($contacts['gender'] == '2') {
                                echo '女性';
                            } else {
                                echo 'その他';
                            }
                            ?></span>
                    </td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">メールアドレス</th>
                    <td class="modal-data"><span id="modal-email">{{ $contacts['email'] }}</span></td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">電話番号</th>
                    <td class="modal-data"><span id="modal-tel">{{ $contacts['tell'] }}</span></td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">住所</th>
                    <td class="modal-data"><span id="modal-address">{{ $contacts['address'] }}</span></td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">建物名</th>
                    <td class="modal-data"><span id="modal-building">{{ $contacts['building'] }}</span></td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">お問い合わせの種類</th>
                    <td class="modal-data"><span id="modal-category">
                            {{-- {{ $contacts['category']['content'] }} --}}
                        </span></td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl--last">お問い合わせ内容</th>
                    <td class="modal-data--last"><span id="modal-detail">
                            {{ $contacts['detail'] }}
                        </span> </td>
                    <input type="hidden" name="id" id="modal-id">
                </tr>

            </table>
            <form class="delete-form" action="/delete" method="post">
                @method('delete')
                @csrf
                <input type="hidden" name="id" />
                <button class="delete-btn">削除</button>
            </form>

        </div>
    </div>
    {{-- @endif --}}
    <script>
        function openModal(button) {
            // 各値を取得
            const lastName = button.getAttribute('data-last_name');
            const firstName = button.getAttribute('data-first_name');
            const gender = button.getAttribute('data-gender');
            const email = button.getAttribute('data-email');
            const tel = button.getAttribute('data-tel');
            const address = button.getAttribute('data-address');
            const building = button.getAttribute('data-building');
            const category = button.getAttribute('data-category');
            const detail = button.getAttribute('data-detail');
            const id = button.getAttribute('data-id');

            // モーダル内にセット
            document.getElementById('modal-name').textContent = lastName + ' ' + firstName;
            document.getElementById('modal-gender').textContent =
                gender == 1 ? '男性' : gender == 2 ? '女性' : 'その他';
            document.getElementById('modal-email').textContent = email;
            document.getElementById('modal-tel').textContent = tel;
            document.getElementById('modal-address').textContent = address;
            document.getElementById('modal-building').textContent = building;
            document.getElementById('modal-category').textContent = category;
            document.getElementById('modal-detail').textContent = detail;

            // 削除フォームの hidden input にIDセット
            document.querySelector('.delete-form input[name="id"]').value = id;

            // モーダル表示
            document.getElementById('modal').style.display = 'flex';
        }
    </script>
@endsection
