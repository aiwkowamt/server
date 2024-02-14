<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
</head>
<body>
    <h1>{{$title}}</h1>
    <h2>{{$date}}</h2>
    <h3>Комментарии:</h3>
    @foreach($comments as $comment)
        <div class="comment">
            <p>Почта: {{$comment['email']}}</p>
            <p>Оценка: {{$comment['grade']}}</p>
            <p>Комментарий: {{$comment['text']}}</p>
        </div>
    @endforeach
</body>
<style>
    * {
        font-family: 'DejaVu Sans', sans-serif;
    }
</style>
</html>

