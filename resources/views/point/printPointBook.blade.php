<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }
        html{
            margin: 15px 20px 10px 20px;
            padding: 0px;
        }

        .header{
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            margin-top: 0px;
            padding-top: 0px;
        }

        .header p{
            margin: 2px 0 0 0;
            padding: 0px;
        }

        .title{
            font-size: 13px;
            text-align: center;
            font-weight: bold;
            margin: 0px;
            padding: 0px;
        }

        .brasao{
            width: 40px;
        }

        table{
            width: 100%;
            text-transform: uppercase;
            margin: 0px;
            padding: 0px;
        }

        td{
            border: 1px solid;
        }

        .table-header{
            font-size: 11px;
            margin-bottom: 5px;
        }

        .table-header .name{
            font-size: 13px;
        }

        .table-body{
            font-size: 12px;
            page-break-after: always;
            text-align: center;
        }

        .time{
            width: 72px;
        }

        .signature{
            width: 255px;
        }

        .column{
            font-size: 10px;
            font-weight: bold;
        }

        .obs{
            text-align: left;
            font-size: 10px;
        }

        .sign{
            margin-left: 30px;
        }

        .boss{
            margin-left: 230px;
        }

        .data-sign{
            padding-top: 25px;
            font-size: 10px;
        }

        .closed{
            background-color: rgb(138, 133, 133);
        }

    </style>
    <title>Impressão de Livro de ponto</title>
</head>
<body>
    @foreach($employees as $employee)
    <div class="header">
        <img src="{{asset('/img/brasao.png')}}" class="brasao">
        <p>
            PREFEITURA MUNICIPAL DE PALMAS<br>
        </p>
        <p class="title">
            FICHA DE FREQUÊNCIA
        </p>
    </div>
        <table cellspacing="0" class="table-header">
            <tr>
                <td colspan="2"><strong>Unidade/Gestão:</strong> Secretaria Municipal de Educação</td>
                <td colspan="2"><strong>Lotação:</strong>Escola Municipal Mestre Pacífico Siqueira Campos</td>
            </tr>
            <tr>
                <td><strong>Matrícula: </strong>{{$employee->registration}}</td>
                <td><strong>Servidor: <span class="name">{{$employee->employee->name}}</span></strong></td>
                <td><strong>Cargo: </strong>{{$employee->post}}</td>
                <td><strong>Função: </strong>{{$employee->role}}</td>
            </tr>
            <tr>
                <td><strong>Vínculo: </strong>{{$employee->bond}}</td>
                <td><strong>Carga horária semanal: </strong>{{$employee->workload}} H</td>
                <td><strong>Mês de Referência: </strong>{{$currentMonth->isoFormat('MMMM')}} de {{$currentMonth->isoFormat('Y')}}</td>
                <td><strong>Contato: </strong>{{$employee->employee->phone}}</td>
            </tr>
        </table>
        <table cellspacing="0" class="table-body">
            <tr class="column">
                <td rowspan="2">DATA</td>
                <td colspan="3">MATUTINO</td>
                <td colspan="3">VESPERTINO</td>
                <td rowspan="2">OBSERVAÇÃO</td>
            </tr>
            <tr class="column">
                <td class="time">Entrada</td>
                <td class="time">Saída</td>
                <td class="signature">Assinatura</td>
                <td class="time">Entrada</td>
                <td class="time">Saída</td>
                <td class="signature">Assinatura</td>
            </tr>
            @foreach($monthPeriod as $day)

            @if($employee->role === "VIGIA DIURNO" || $employee->role === "VIGIA DIURNO")
                <tr>
                    <td>{{$day->format('d/m')}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @else
                @if($day->englishDayOfWeek === 'Saturday' || $day->englishDayOfWeek === 'Sunday')
                    @if($saturdays && in_array($day->format('Y-m-d'), $saturdays))
                        <tr>
                            <td>{{$day->format('d/m')}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else()
                        <tr class="closed">
                            <td>{{$day->format('d/m')}}</td>
                            <td> - </td>
                            <td> - </td>
                            <td>{{$day->translatedFormat('l')}}</td>
                            <td> - </td>
                            <td> - </td>
                            <td>{{$day->translatedFormat('l')}}</td>
                            <td> - </td>
                        </tr>
                    @endif
                @elseif($holidays && in_array($day->format('Y-m-d'), $holidays))
                    <tr class="closed">
                        <td>{{$day->format('d/m')}}</td>
                        <td> - </td>
                        <td> - </td>
                        <td>FERIADO / RECESSO</td>
                        <td> - </td>
                        <td> - </td>
                        <td>FERIADO / RECESSO</td>
                        <td> - </td>
                    </tr>
                @else
                    <tr>
                        <td>{{$day->format('d/m')}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            @endif






               
            @endforeach
            <tr>
                <td colspan="4" class="obs">Obs:</td>
                <td colspan="4" class="data-sign">
                    <span>Palmas, ____ de ___________ de {{$currentMonth->format('Y')}}</span>
                    <span class="sign">___________________________________</span> <br />
                    <span class="boss"> Chefia imediata </span>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="obs">
                    
                        Obs.: Art. 38 da Lei Complementar 008, de 16 de novembro de 1999, o servidor perderá: II - A parcela de remuneração diária, 
                        proporcional aos atrasos não justificados.
                    
                </td>
            </tr>
        </table>
    @endforeach
    
</body>
</html>