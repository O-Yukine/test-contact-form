@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="attendance__content">
        <div class="buttons">
            <div class="export-btn">
                <button class="export">エクスポート</button>
            </div>
            <div class="paginate">
                {{-- {{ $contacts->links() }} --}}
            </div>
        </div>

        <div class="attendance-table">
            <table class="attendance-table__inner">
                <tr class="attendance-table__row">
                    <th class="attendance-table__header">お名前</th>
                    <th class="attendance-table__header">性別</th>
                    <th class="attendance-table__header">メールアドレス</th>
                    <th class="attendance-table__header">お問い合わせの種類</th>

                </tr>
                <tr class="attendance-table__row">
                    <td class="attendance-table__item">サンプル</td>
                    <td class="attendance-table__item">サンプル</td>
                    <td class="attendance-table__item">サンプル</td>

                    <td class="detail-button">
                        <button wire:click="openModal()" type="button" class="detail">詳細</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    {{-- @if ($showModal)
            <div class="modal-wrapper">
                <div class="modal-window">
                    <button wire:click="closeModal()" type="button" class="modal-close">
                        ×
                    </button>
                    <table class="modal__content">
                        <tr class="modal-inner">
                            <th class="modal-ttl">お名前</th>
                            <td class="modal-data">
                                {{ $contact['last_name'] }}
                                <span class="space"></span>
                                <span class="firstName">{{ $contact['first_name'] }}</span>
                            </td>
                        </tr>
                        <tr class="modal-inner">
                            <th class="modal-ttl">性別</th>
                            <td class="modal-data">
                                <input type="hidden" value="{{ $contact['gender'] }}" /> --}}
    {{-- <?php
    if ($contact['gender'] == '1') {
        echo '男性';
    } elseif ($contact['gender'] == '2') {
        echo '女性';
    } else {
        echo 'その他';
    }
    ?>  --}}
    {{-- </td>
                        </tr>
                        <tr class="modal-inner">
                            <th class="modal-ttl">メールアドレス</th>
                            <td class="modal-data">{{ $contact['email'] }}</td>
                        </tr>
                        <tr class="modal-inner">
                            <th class="modal-ttl">電話番号</th>
                            <td class="modal-data">{{ $contact['tell'] }}</td>
                        </tr> --}}
    {{-- <tr class="modal-inner">
                            <th class="modal-ttl">住所</th>
                            <td class="modal-data">{{ $contact['address'] }}</td>
                        </tr>
                        <tr class="modal-inner">
                            <th class="modal-ttl">建物名</th>
                            <td class="modal-data">{{ $contact['building'] }}</td>
                        </tr>
                        <tr class="modal-inner">
                            <th class="modal-ttl">お問い合わせの種類</th>
                            <td class="modal-data">{{ $contact['category']['content'] }}</td>
                        </tr> --}}
    {{-- <tr class="modal-inner">
                            <th class="modal-ttl--last">お問い合わせ内容</th>
                            <td class="modal-data--last">
                                {{ $contact['detail'] }}
                            </td>
                        </tr>
                    </table>
                    <form class="delete-form" action="/delete" method="post">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id" value="{{ $contact['id'] }}" />
                        <button class="delete-btn">削除</button>
                    </form>
                </div>
            </div> --}}
    {{-- @endif  --}}
    </td>
    </tr>

    </table>
    </div>
    </div>
@endsection
