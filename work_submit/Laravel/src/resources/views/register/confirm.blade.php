@extends('layouts.app')

@section('title', '登録内容確認')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center py-3" style="background-color: #4A90E2;">
                <h4 class="text-white mb-0">登録内容確認</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>姓</th>
                        <td>{{ $data['last_name'] }}</td>
                    </tr>
                    <tr>
                        <th>名</th>
                        <td>{{ $data['first_name'] }}</td>
                    </tr>
                    <tr>
                        <th>姓カナ</th>
                        <td>{{ $data['last_name_kana'] }}</td>
                    </tr>
                    <tr>
                        <th>名カナ</th>
                        <td>{{ $data['first_name_kana'] }}</td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>{{ $data['email'] }}</td>
                    </tr>
                </table>

                <form method="POST" action="{{ route('register.confirm.post') }}">
                    @csrf
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">登録する</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('register.index') }}">入力画面に戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection