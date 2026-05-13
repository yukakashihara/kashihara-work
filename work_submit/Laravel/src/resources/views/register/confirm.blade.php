<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>登録内容確認</title>
</head>

<body>
    <h1>登録内容確認</h1>

    <table>
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
        <button type="submit">登録する</button>
    </form>

    <a href="{{ route('register.index') }}">入力画面に戻る</a>

</body>

</html>