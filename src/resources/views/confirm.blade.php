@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
    <div class="confirm__content">
        <div class="confirm__heading">
            <h2>Confirm</h2>
        </div>
        <form class="form" action="/thanks" method="POST">
            @csrf
            <div class="confirm-table">
                <table class="confirm-table__inner">
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お名前</th>
                        <td class="confirm-table__text">
                            <input type="text" name="first_name" value="{{ $contact['first_name'] }}"readonly />
                            <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">性別</th>
                        <td class="confirm-table__text">
                            <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
                            @if ($contact['gender'] == 1)
                                男性
                            @elseif ($contact['gender'] == 2)
                                女性
                            @else
                                その他
                            @endif
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">メールアドレス</th>
                        <td class="confirm-table__text">
                            <input type="text" name="email" value="{{ $contact['email'] }}" readonly />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">電話番号</th>
                        <td class="confirm-table__text">

                            <input type="tel" name="tel"
                                value="{{ $contact['tel1'] . $contact['tel2'] . $contact['tel3'] }}" readonly />
                            <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}" />
                            <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}" />
                            <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}" />

                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">住所</th>
                        <td class="confirm-table__text">
                            <input type="text" name="address" value="{{ $contact['address'] }}"readonly />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">建物名</th>
                        <td class="confirm-table__text">
                            <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせの種類</th>
                        <td class="confirm-table__text">
                            {{ $category['content'] }}
                            <input type="hidden" name="category_id" value="{{ $category->id }}" />
                        </td>
                    </tr>
                    <tr class="confirm-table__row">
                        <th class="confirm-table__header">お問い合わせ内容</th>
                        <td class="confirm-table__text">
                            <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="form__button">

                <button class="form__button-submit" type="submit">送信</button>
        </form>
        <a href="#" onclick="document.getElementById('back-form').submit(); return false;">修正する</a>

        {{-- <form id="back-form" action="{{ url('/') }}" method="POST">
            @csrf
            @foreach ($contact as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <input type="hidden" name="category_id" value="{{ $category->id }}">
        </form> --}}
    </div>

    </div>
@endsection
