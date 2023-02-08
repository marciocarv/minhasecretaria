<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        td{
            border-top: 1px solid;
            padding: 3px;
        }
        .brasao{
            text-align: center;
            border: 0px;
        }
        .header{
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            border: 0px;
        }
        .title{
            text-align: center;
            font-weight: bold;
            border: 0px;
        }
        .photo{
            height: 130px;
            text-align: center;
            border: 1px solid;
        }
        .subtitle{
            font-weight: bold;
        }
        .field{
            font-weight: bold;
        }

    </style>
    <title>Ficha Funcional</title>
</head>
<body>
    <table cellspacing="0">
        <tr>
            <td colspan="6" class="brasao"><img src="{{asset('/img/brasao.png')}}"></td>
        </tr>
        <tr>
            <td colspan="6" class="header">PREFEITURA MUNICIPAL DE PALMAS<br>
                SECRETARIA MUNICIPAL DE EDUCAÇÃO<br>
                ESCOLA MUNICIPAL MESTRE PACÍFICO SIQUEIRA CAMPOS
            </td>
        </tr>
        <tr>
            <td colspan="5" class="title">FICHA FUNCIONAL</td>
            <td class="photo">Foto 3x4</td>
        </tr>
        <tr>
            <td colspan="6" class="title">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" class="subtitle">1. DADOS PESSOAIS</td>
        </tr>
        <tr>
            <td class="field">Nome:</td>
            <td colspan="5" class="field_response">{{$employment_bond->employee->name}}</td>
        </tr>
        <tr>
            <td class="field">Filiação:</td>
            <td colspan="5" class="field_response">{{$employment_bond->employee->father}} E {{$employment_bond->employee->mother}}</td>
        </tr>
        <tr>
            <td class="field">Naturalidade:</td>
            <td colspan="3" class="field_response">{{$employment_bond->employee->naturalness}}</td>
            <td class="field">Estado Civil:</td>
            <td class="field_response">{{$employment_bond->employee->marital_status}}</td>
        </tr>
        <tr>
            <td class="field">Data de<br> Nascimento:</td>
            <td class="field_response">{{$employment_bond->employee->date_birth->format('d/m/Y')}}</td>
            <td class="field">Telefone:</td>
            <td class="field_response" colspan="3">{{$employment_bond->employee->phone}}</td>
        </tr>
        <tr>
            <td class="field">Sexo:</td>
            <td class="field_response">{{$employment_bond->employee->sex}}</td>
            <td class="field">Cor:</td>
            <td class="field_response">{{$employment_bond->employee->color}}</td>
            <td class="field">CEP:</td>
            <td class="field_response">{{$employment_bond->employee->cep}}</td>
        </tr>
        <tr>
            <td class="field">Endereço:</td>
            <td colspan="5" class="field_response">{{$employment_bond->employee->address}}</td>
        </tr>
        <tr>
            <td colspan="6" class="subtitle">2. DOCUMENTOS</td>
        </tr>
        <tr>
            <td class="field">Tipo de certidão:</td>
            <td class="field_response">{{$employment_bond->employee->certificate_type}}</td>
            <td class="field">Termo:</td>
            <td colspan="3" class="field_response">{{$employment_bond->employee->certificate_term}}</td>
        </tr>
        <tr>
            <td class="field">Livro:</td>
            <td class="field_response">{{$employment_bond->employee->certificate_book}}</td>
            <td class="field">Folha:</td>
            <td colspan="3" class="field_response">{{$employment_bond->employee->certificate_sheet}}</td>
        </tr>
        <tr>
            <td class="field">CPF:</td>
            <td class="field_response">{{$employment_bond->employee->cpf}}</td>
            <td class="field">RG:</td>
            <td class="field_response">{{$employment_bond->employee->rg}}</td>
            <td class="field">Expedição RG:</td>
            <td class="field_response">{{$employment_bond->employee->rg_expedition->format('d/m/Y')}}</td>
        </tr>
        <tr>
            <td colspan="6" class="subtitle">3. DADOS BANCÁRIOS</td>
        </tr>
        <tr>
            <td class="field">Banco:</td>
            <td class="field_response">{{$employment_bond->employee->bank_name}}</td>
            <td class="field">Agência:</td>
            <td class="field_response">{{$employment_bond->employee->bank_agency}}</td>
            <td class="field">Conta Corrente:</td>
            <td class="field_response">{{$employment_bond->employee->bank_number}}</td>
        </tr>
        <tr>
            <td colspan="6" class="subtitle">4. ESCOLARIDADE</td>
        </tr>
        <tr>
            <td class="field">Grau de Escolaridade:</td>
            <td colspan="2" class="field_response">{{$employment_bond->employee->schooling}}</td>
            <td class="field">Situção:</td>
            <td colspan="2" class="field_response">{{$employment_bond->employee->course_status}}</td>
        </tr>
        <tr>
            <td class="field">Curso:</td>
            <td colspan="5" class="field_response">{{$employment_bond->employee->course_name}}</td>
        </tr>
        <tr>
            <td class="field">Instituição:</td>
            <td colspan="2" class="field_response">{{$employment_bond->employee->name_college}}</td>
            <td class="field">Ano de Conclusão:</td>
            <td colspan="2" class="field_response">{{$employment_bond->employee->conclusion}}</td>
        </tr>
        <tr>
            <td colspan="6" class="subtitle">5. SITUAÇÃO FUNCIONAL</td>
        </tr>
        <tr>
            <td class="field">Matrícula:</td>
            <td class="field_response">{{$employment_bond->registration === '0' ? ' ' : $employment_bond->registration}}</td>
            <td class="field">Admissão Concurso:</td>
            <td class="field_response">{{$employment_bond->employee->admission == null ? ' ' : $employment_bond->employee->admission->format('d/m/Y')}}</td>
            <td class="field">Data de <br> Lotação:</td>
            <td class="field_response">{{$employment_bond->lotation == NULL ? '--' : $employment_bond->lotation->format('d/m/Y')}}</td>
        </tr>
        <tr>
            <td class="field">Início de Atividade:</td>
            <td class="field_response">{{$employment_bond->activity_start->format('d/m/Y')}}</td>
            <td class="field">Vínculo:</td>
            <td class="field_response">{{$employment_bond->bond}}</td>
            <td class="field">Carga Horária:</td>
            <td class="field_response">{{$employment_bond->workload}}</td>
        </tr>
        <tr>
            <td class="field">Cargo:</td>
            <td colspan="2" class="field_response">{{$employment_bond->post}}</td>
            <td class="field">Função:</td>
            <td colspan="2" class="field_response">{{$employment_bond->role}}</td>
        </tr>
    </table>
</body>
</html>