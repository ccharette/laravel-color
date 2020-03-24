<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
    <form action="/color/categories" method="post">
        @csrf
        <label>Enter your HEX :</label>
        <input type="text" name="hex" id="hex">
        <input type="submit" value="Submit">
    </form>

    <br>

    @if (isset($hex))
        <label>Your color :</label>
        <div id="your-color" style="background-color: {{$hex}}; padding: 16px">{{$hex}}</div>
    @endif

    <br>

    @if (isset($hexCategorie))
        <label>Categorie color :</label>
        <div id="your-color" style="background-color: {{$hexCategorie}}; padding: 16px">{{$hexCategorie}}</div>
    @endif


</body>
</html>