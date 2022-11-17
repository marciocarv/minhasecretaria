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
        li{
            text-align: left;
            list-style: none;
            margin-bottom: 20px;
        }

    </style>
    <title>Declaração de Vínculo</title>
</head>
<body>
    <div class="header">
        <img src="{{asset('/img/brasao.png')}}">
        <p>
            <span>PREFEITURA MUNICIPAL DE PALMAS</span><br>
            SECRETARIA MUNICIPAL DE EDUCAÇÃO<br>
            DIRETORIA DE RECURSOS HUMANOS<br>
            104 Norte, Rua NE 01, Lote 16, Plano Diretor Norte, Palmas – TO<br>
            Telefone: (63)3212-7530/7512
        </p>
    </div>
    <div class="title">
        <p>DECLARAÇÃO DE VÍNCULO</p>
    </div>
    <div class="body">
        <p class="text_declaration">
            Declaro, para os devidos fins que o(a) Servidor(a) {{$employee->name}}, inscrito(a) no CPF nº: {{$employee->cpf}}, exerceu
            suas atividades na Escola Municipal Mestre Pacífico Siqueira Campos nos períodos abaixo relacionados:
            <ul>
            @foreach($employment_bonds as $employment_bond)
                <li>
                Matrícula: {{$employment_bond->registration}}, Vínculo: {{$employment_bond->bond}}, Cargo: {{$employment_bond->post}}, 
                Função: {{$employment_bond->role}}, Carga Horária: {{$employment_bond->workload}}H - 
                no período de {{$employment_bond->activity_start->format('d/m/Y')}} até 
                @if($employment_bond->activity_end == null)
                    os dias atuais
                @else
                    {{$employment_bond->activity_end->format('d/m/Y')}}
                @endif
                </li>
            @endforeach
            </ul>
        </p>
        <p class="text_declaration">
            Por ser verdade, firmo o presente.
        </p>
        <p class="city_date">
            Palmas-TO, {{$dia}} de {{$mes}} de {{$ano}}
        </p>
        <p class="signature">
            <span>________________________________________________</span><br>
            <span>Unidade de Ensino</span>
        </p>
    </div>
    
</body>
</html>