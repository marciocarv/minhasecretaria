<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .content{
            margin: 2px;
            display:flex;
            justify-content: center;
        }
        .center{
            background-color: red;
        }

        #brasao{
            width: 50px;
        }

    </style>
    <title>Ficha Funcional</title>
</head>
<body>
    <div class="content">
        <p class="center"><img src="{{asset('img/brasao.png')}}" id="brasao"></p>
    </div>
</body>
</html>