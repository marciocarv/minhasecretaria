<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .header{
            text-align: center;
            font-size: 11px;
            font-weight: bold;
        }
        .title{
            font-size: 17px;
            text-align: center;
            font-weight: bold;
        }
        table{
            width: 100%;
            text-transform: uppercase;
        }
        td{
            border: 1px solid;
            padding: 2px;
        }
        .body{
            text-align: center;
        }
        .text_declaration{
            text-align: justify;
            font-size: 17px;
        }
        .city_date{
            text-align: right;
        }
        .signature{
            text-align: center;
            margin-top: 100px;
        }

    </style>
    <title>Declaração de Comprovação</title>
</head>
<body>
    <div class="header">
        <img src="{{asset('/img/brasao.png')}}">
        <p>
            PREFEITURA MUNICIPAL DE PALMAS<br>
            SECRETARIA MUNICIPAL DE EDUCAÇÃO<br>
            ESCOLA MUNICIPAL MESTRE PACÍFICO SIQUEIRA CAMPOS
        </p>
    </div>
    <div class="title">
        <p>DECLARAÇÃO DE COMPROVAÇÃO</p>
    </div>
    <div class="body">
        <p class="text_declaration">
            Declaramos, para fins de comprovação, que o(a) Servidor(a) {{$employment_bond->employee->name}}, portador do CPF nº: {{$employment_bond->employee->cpf}},
            Matrícula nº: {{$employment_bond->registration}}, cargo: {{$employment_bond->post}}, está atualmente lotado em nossa unidade de ensino na função: {{$employment_bond->role}},
            cumprindo carga horária de {{$employment_bond->workload}}H semanais.
        </p>
        <p class="text_declaration">
            Por ser verdade, firmamos a presente declaração.
        </p>
        <p class="city_date">
            Palmas-TO, {{$dia}} de {{$mes}} de {{$ano}}
        </p>
        <p class="signature">
            <span>________________________________________________</span><br>
            <span>Diretor</span>
        </p>
    </div>
    
</body>
</html>