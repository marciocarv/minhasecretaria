<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro de Ponto - {{ $monthName }}</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f3f4f6;
            padding: 20px;
        }

        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-print {
            background-color: #16a34a;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .btn-print:hover {
            background-color: #15803d;
        }

        .page {
            background-color: white;
            width: 210mm;
            min-height: 297mm;
            padding: 12mm;
            margin: 0 auto 20px auto;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }

        /* Cabeçalho da Folha de Ponto */
        .header {
            text-align: center;
            border: 1px solid #000;
            padding: 6px;
            margin-bottom: 8px;
        }

        .header h2 {
            font-size: 14px;
            text-transform: uppercase;
        }

        .header h3 {
            font-size: 12px;
            margin-top: 2px;
            font-weight: normal;
        }

        /* Tabela de Informações do Servidor */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
            font-size: 10px;
        }

        .info-table td {
            border: 1px solid #000;
            padding: 4px;
        }

        /* Tabela Principal de Registro de Ponto */
        .point-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        .point-table th, .point-table td {
            border: 1px solid #000;
            padding: 3px 2px;
            text-align: center;
            height: 18px;
        }

        .point-table th {
            background-color: #e5e7eb;
            text-transform: uppercase;
            font-size: 8px;
        }

        .blocked-row {
            background-color: #f3f4f6;
            font-weight: bold;
            letter-spacing: 1px;
            color: #374151;
        }

        .signature-line {
            width: 80%;
            border-bottom: 1px solid #000;
            margin: 25px auto 5px auto;
        }

        .footer-signatures {
            margin-top: 15px;
            display: flex;
            justify-content: space-around;
            text-align: center;
            font-size: 10px;
        }

        /* Regras estritas de impressão A4 */
        @media print {
            body {
                background: none;
                padding: 0;
            }

            .no-print {
                display: none;
            }

            .page {
                border: none;
                box-shadow: none;
                margin: 0;
                padding: 10mm;
                width: 100%;
                height: 100%;
                page-break-after: always; /* Quebra de página automática por servidor */
            }

            @page {
                size: A4 portrait;
                margin: 0;
            }
        }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" class="btn-print">
            🖨️ Imprimir Folhas de Ponto
        </button>
    </div>

    @foreach($pointSheets as $sheet)
        @php
            $bond = $sheet['bond'];
            $employee = $bond->employee;
        @endphp

        <div class="page">
            <div class="header">
                <h2>SECRETARIA MUNICIPAL DE EDUCAÇÃO</h2>
                <h3>FOLHA DE FREQUÊNCIA DE SERVIDOR - {{ $monthName }}</h3>
            </div>

            <table class="info-table">
                <tr>
                    <td colspan="2"><strong>SERVIDOR:</strong> {{ mb_strtoupper($employee->name ?? 'N/A') }}</td>
                    <td><strong>MATRÍCULA:</strong> {{ $bond->registration ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td><strong>CARGO/FUNÇÃO:</strong> {{ mb_strtoupper($bond->post ?? 'N/A') }}</td>
                    <td><strong>CARGA HORÁRIA:</strong> {{ $bond->workload }}H</td>
                    <td><strong>TURNO:</strong> {{ mb_strtoupper(str_replace('_', ' ', $bond->work_shift ?? 'N/A')) }}</td>
                </tr>
            </table>

            <table class="point-table">
                <thead>
                    <tr>
                        <th style="width: 4%;">DIA</th>
                        <th style="width: 5%;">SEM</th>
                        <th style="width: 15%;">ENTRADA 1</th>
                        <th style="width: 15%;">SAÍDA 1</th>
                        <th style="width: 15%;">ENTRADA 2</th>
                        <th style="width: 15%;">SAÍDA 2</th>
                        <th style="width: 31%;">ASSINATURA / OBSERVAÇÃO</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sheet['days'] as $dayData)
                        @if($dayData['status'] === 'BLOCKED')
                            <tr class="blocked-row">
                                <td>{{ $dayData['day'] }}</td>
                                <td>{{ $dayData['day_name'] }}</td>
                                <td colspan="5" style="text-align: center;">--- {{ $dayData['observation'] }} ---</td>
                            </tr>
                        @else
                            <tr>
                                <td><strong>{{ $dayData['day'] }}</strong></td>
                                <td>{{ $dayData['day_name'] }}</td>
                                
                                {{-- Horários pré-sugeridos com base no turno --}}
                                @if($bond->work_shift === 'matutino')
                                    <td>07:00</td>
                                    <td>11:00</td>
                                    <td>-</td>
                                    <td>-</td>
                                @elseif($bond->work_shift === 'vespertino')
                                    <td>-</td>
                                    <td>-</td>
                                    <td>13:00</td>
                                    <td>17:00</td>
                                @elseif($bond->work_shift === '12x36_diurno')
                                    <td>06:30</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>18:30</td>
                                @elseif($bond->work_shift === '12x36_noturno')
                                    <td>18:30</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>06:30</td>
                                @else
                                    {{-- Integral / Padrão 40h --}}
                                    <td>07:00</td>
                                    <td>11:00</td>
                                    <td>13:00</td>
                                    <td>17:00</td>
                                @endif

                                <td></td> {{-- Campo em branco para assinatura --}}
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <div class="footer-signatures">
                <div>
                    <div class="signature-line"></div>
                    Assinatura do Servidor
                </div>
                <div>
                    <div class="signature-line"></div>
                    Visto da Chefia Imediata / Direção
                </div>
            </div>
        </div>
    @endforeach

</body>
</html>