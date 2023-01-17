<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Api Documentation</title>
    <link href="../swagger/style.css" rel="stylesheet">
</head>

<body>
    <form action="/api/docs" method="POST">
        <input name="_method" type="hidden" value="GET"></br>
        <label for="key">Chave da documentação</label></br>
        <input type="password" name="key" id="key"></br></br>
        <button type="submit">Enviar</button>
    </form>
</body>

</html>