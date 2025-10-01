@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="admin">
        <div class="admin__content">
            <div class="header">
                <h2>Admin</h2>
            </div>
            <div class="search">
                <input type="text" class="search_keyword">
            </div>
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
                                    data-last_name="{{ $contact->last_name }}" data-first_name="{{ $contact->first_name }}"
                                    data-gender="{{ $contact->gender }}" data-email="{{ $contact->email }}"
                                    data-tel="{{ $contact->tel }}" data-address="{{ $contact->address }}"
                                    data-building="{{ $contact->building }}"
                                    data-category="{{ $contact->category->content }}" data-detail="{{ $contact->detail }}"
                                    onclick="openModal(this)">
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
                    <td class="modal-data"><span id="modal-name">
                            {{ $contact['last_name'] }}
                            <span class="space"></span>
                            <span class="firstName">{{ $contact['first_name'] }}</span></span>
                    </td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">性別</th>
                    <td class="modal-data"><span id="modal-gender">
                            {{-- <input type="hidden" value="{{ $contact['gender'] }}" /> --}}
                            <?php
                            if ($contact['gender'] == '1') {
                                echo '男性';
                            } elseif ($contact['gender'] == '2') {
                                echo '女性';
                            } else {
                                echo 'その他';
                            }
                            ?></span> --}}
                    </td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">メールアドレス</th>
                    <td class="modal-data"><span id="modal-email">{{ $contact['email'] }}</span></td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">電話番号</th>
                    <td class="modal-data"><span id="modal-tel">{{ $contact['tell'] }}</span></td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">住所</th>
                    <td class="modal-data"><span id="modal-address">{{ $contact['address'] }}</span></td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">建物名</th>
                    <td class="modal-data"><span id="modal-building">{{ $contact['building'] }}</span></td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl">お問い合わせの種類</th>
                    <td class="modal-data"><span id="modal-category">{{ $contact['category']['content'] }}</span></td>
                </tr>
                <tr class="modal-inner">
                    <th class="modal-ttl--last">お問い合わせ内容</th>
                    <td class="modal-data--last"><span id="modal-detail">
                            {{ $contact['detail'] }}
                        </span> </td>
                    <input type="hidden" name="id" id="modal-id">
                </tr>

            </table>
            <form class="delete-form" action="/delete" method="post">
                @method('delete')
                @csrf
                <input type="hidden" name="id" value="{{ $contact['id'] }}" />
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
