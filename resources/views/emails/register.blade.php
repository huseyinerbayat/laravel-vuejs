<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kayıt Maili</title>
</head>
<body>
    <p>
        Sayın {{$user->family->name}} {{$user->family->surname}}, <br>
        Sistemimize kayıt olduğunuz için teşekkür ederiz. 
    </p>
    <p>
        Öğrenci Bilgileri; <br>
        <b>Ad:</b> {{$student->name}} <br>
        <b>Soyad:</b> {{$student->surname}}
    </p>
    <p>{{env('APP_NAME')}}</p>
</body>
</html>