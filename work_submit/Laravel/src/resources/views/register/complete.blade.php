@extends('layouts.app')

@section('title', '登録完了')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center py-3" style="background-color: #4A90E2;">
                <h4 class="text-white mb-0">登録完了</h4>
            </div>
            <div class="card-body text-center">
                <p>会員登録が完了しました！</p>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('login') }}">ログイン画面へ</a>
            </div>
        </div>
    </div>
</div>
@endsection