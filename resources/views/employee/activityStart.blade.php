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
            font-size: 15px;
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
        }
        .city_date{
            text-align: right;
        }
        .signature{
            text-align: center;
            margin-top: 100px;
        }

    </style>
    <title>Declaração de Início de Atividade</title>
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
        <p>DECLARAÇÃO DE INÍCIO DE ATIVIDADE</p>
    </div>
    <div class="body">
        <p class="text_declaration">
            Declaramos, para fins de comprovação junto a Secretaria Municipal da Educação,
            que o(a) Servidor(a) qualificado(a) iniciou suas atividades nesta Unidade de Ensino a
            partir de: {{$employment_bond->activity_start->format('d/m/Y')}}.
        </p>
        <table cellspacing="0">
            <tr>
                <td>
                    Matrícula:
                </td>
                <td>
                    {{$employment_bond->registration === '0' ? ' ' : $employment_bond->registration}}
                </td>
            </tr>
            <tr>
                <td>
                    Nome:
                </td>
                <td>
                    {{$employment_bond->employee->name}}
                </td>
            </tr>
            <tr>
                <td>
                    CPF:
                </td>
                <td>
                    {{$employment_bond->employee->cpf}}
                </td>
            </tr>
            <tr>
                <td>
                    Vínculo:
                </td>
                <td>
                    {{$employment_bond->bond}}
                </td>
            </tr>
            <tr>
                <td>
                    Cargo:
                </td>
                <td>
                    {{$employment_bond->post}}
                </td>
            </tr>
            <tr>
                <td>
                    Função:
                </td>
                <td>
                    {{$employment_bond->role}}
                </td>
            </tr>
            <tr>
                <td>
                    Carga Horária:
                </td>
                <td>
                    {{$employment_bond->workload}}H
                </td>
            </tr>
            <tr>
                <td>
                    Unidade de Lotação:
                </td>
                <td>
                    Escola Municipal Mestre Pacífico Siqueira Campos
                </td>
            </tr>
            <tr>
                <td>
                    Código da Unidade de Lotação:
                </td>
                <td>
                    514.3.35
                </td>
            </tr>
        </table>
        <p class="city_date">
            Palmas-TO, {{$dia}} de {{$mes}} de {{$ano}}
        </p>
        <p class="signature">
            <span>________________________________________________</span><br>
            <span>Assinatura da Chefia Imediata</span>
        </p>
    </div>
    
</body>
</html>