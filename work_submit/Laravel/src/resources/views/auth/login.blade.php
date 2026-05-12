<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>ログイン</title>
</head>

<body>
    <h1>ログイン</h1>

    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div>
            <label>メールアドレス</label>
            <input type="email" name="email" required>
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
        <button type="submit">ログイン</button>
        @error('login')
        <p>{{ $message }}</p>
        @enderror
    </form>

    <a href="{{ route('register.index') }}">新規登録の方はこちら</a>

</body>

</html>