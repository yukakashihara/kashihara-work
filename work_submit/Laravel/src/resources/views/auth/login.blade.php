@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header text-center py-3" style="background-color: #4A90E2;">
                <h4 class="text-white mb-0">ログイン</h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-moon" style="font-size: 80px; color: #4A90E2;"></i>
                </div>
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">メールアドレス</label>
                        <input type="email" name="email" class="form-control" required>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">パスワード</label>
                        <input type="password" name="password" class="form-control" required minlength="8" maxlength="20">
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @error('login')
                    <div class="text-danger mb-3">{{ $message }}</div>
                    @enderror
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">ログイン</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <div class="py-2">
                    <a href="#">パスワードをお忘れの方はこちら</a>
                </div>
                <hr class="m-1">
                <div class="py-2">
                    <a href="{{ route('register.index') }}">新規登録の方はこちら</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection