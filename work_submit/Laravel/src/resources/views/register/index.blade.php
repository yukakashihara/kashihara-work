@extends('layouts.app')

@section('title', '新規登録')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-center py-3" style="background-color: #4A90E2;">
                <h4 class="text-white mb-0">新規登録</h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <i class="fa-solid fa-store" style="font-size: 80px; color: #4A90E2;"></i>
                </div>
                <form method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">姓</label>
                            <input type="text" name="last_name" class="form-control" required maxlength="50">
                            @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">名</label>
                            <input type="text" name="first_name" class="form-control" required maxlength="50">
                            @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">姓（カナ）</label>
                            <input type="text" name="last_name_kana" class="form-control" required maxlength="50">
                            @error('last_name_kana')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">名（カナ）</label>
                            <input type="text" name="first_name_kana" class="form-control" required maxlength="50">
                            @error('first_name_kana')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">メールアドレス</label>
                        <input type="email" name="email" class="form-control" required maxlength="255">
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
                    <div class="mb-3">
                        <label class="form-label">パスワード（確認）</label>
                        <input type="password" name="password_confirmation" class="form-control" required minlength="8" maxlength="20">
                        @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">新規登録</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('login') }}">アカウントをお持ちの方はこちら</a>
            </div>
        </div>
    </div>
</div>

@endsection