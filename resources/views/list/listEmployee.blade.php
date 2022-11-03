<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Servidores</title>
    <style>
        td{
            border: 1px solid;
        }
        table{
            width: 100%;
        }
        .cabecalho{
            text-align: center;
            font-size: 11px;
        }
        .title{
            text-align: center;
            font-weight: bold;
        }
        .signature{
            width: 35%;
        }
        .num{
            width: 2%;
            text-align: center;
        }
        .center{
            text-align: center;
        }
        .body{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <table cellspacing="0">
        <tr>
            <td colspan="{{count($request->options)+1}}">
                <p class="cabecalho">
                    PREFEITURA MUNICIPAL DE PALMAS<br>
                    SECRETARIA MUNICIPAL DE EDUCAÇÃO<br>
                    ESCOLA MUNICIPAL MESTRE PACÍFICO SIQUEIRA CAMPOS
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="{{count($request->options)+1}}">
                <p class="title">{{$request->title}}</p>
            </td>
        </tr>
        <tr>
            <td class="num">Nº</td>
            @foreach($request->options as $option)
            <td class="@if($option == 'signature' || $option == 'name') signature @endif">
                @if($option == 'name')
                    Nome
                @elseif($option == 'cpf')
                    CPF
                @elseif($option == 'signature')
                    Assinatura
                @elseif($option == 'registration')
                    Matrícula
                @elseif($option == 'post')
                    Cargo
                @elseif($option == 'role')
                    Função
                @elseif($option == 'phone')
                    Telefone
                @elseif($option == 'workload')
                    Carga Horária
                @elseif($option == 'date_birth')
                    Nascimento
                @elseif($option == 'id_censo')
                    ID Censo
                @elseif($option == 'schooling')
                    Escolaridade
                @elseif($option == 'lotation')
                    Data de Lotação
                @endif
            </td>
            @endforeach
        </tr>
        @foreach($employment_bonds as $eb)
            <tr class="body">
                <td class="center">{{$loop->index + 1}}</td>
                @foreach($request->options as $option)
                    @if($option == 'name' || $option == 'phone' || $option == 'cpf' || $option == 'id_censo' || $option == 'schooling')
                        <td>{{$eb->employee->$option}}</td>
                    @elseif($option == 'date_birth')
                        <td>{{$eb->employee->$option->format('d/m/Y')}}</td>
                    @elseif($option == 'lotation' && $eb->$option != null)
                        <td>{{$eb->$option->format('d/m/Y')}}</td>
                    @else
                        <td>{{$eb->$option}}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
</body>
</html>