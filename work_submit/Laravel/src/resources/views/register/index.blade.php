<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>新規登録</title>
</head>

<body>
    <h1>新規登録</h1>

    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div>
            <label>姓</label>
            <input type="text" name="last_name" required maxlength="50">
            @error('last_name')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>名</label>
            <input type="text" name="first_name" required maxlength="50">
            @error('first_name')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>姓（カナ）</label>
            <input type="text" name="last_name_kana" required maxlength="50">
            @error('last_name_kana')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>名（カナ）</label>
            <input type="text" name="first_name_kana" required maxlength="50">
            @error('first_name_kana')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>メールアドレス</label>
            <input type="email" name="email" required maxlength="255">
            @error('email')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>パスワード</label>
            <input type="password" name="password" required minlength="8" maxlength="20">
            @error('password')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>パスワード（確認）</label>
            <input type="password" name="password_confirmation" required minlength="8" maxlength="20">
            @error('password_confirmation')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">新規登録</button>
    </form>

    <a href="{{ route('login') }}">アカウントをお持ちの方はこちら</a>

</body>

</html>