<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro de Ponto Interativo</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; margin: 0; padding: 0; }
        
        body { background-color: #52525b; padding: 20px; font-size: 12px; }

        .toolbar {
            position: fixed; top: 10px; right: 20px;
            background: #16a34a; color: white; padding: 15px;
            border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.3);
            z-index: 1000; text-align: center;
        }
        .toolbar button {
            background: white; color: #16a34a; font-weight: bold; border: none;
            padding: 10px 20px; cursor: pointer; border-radius: 5px; font-size: 14px;
        }

        .page {
            background-color: white;
            width: 297mm;
            min-height: 210mm;
            padding: 10mm 15mm;
            margin: 0 auto 30px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            position: relative;
            page-break-after: always;
        }

        .header-container { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
        .header-text { text-align: center; width: 100%; font-weight: bold; font-size: 15px; }
        .header-text p { margin: 2px 0; }
        
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 8px; font-size: 14px; font-weight: bold; }
        .info-table td { border: 1px solid #000; padding: 3px 6px; text-transform: uppercase; }

        .point-table { width: 100%; border-collapse: collapse; text-align: center; }
        .point-table th, .point-table td { border: 1px solid #000; padding: 4px; height: 24px; font-size: 14px; }
        .point-table th { background-color: #f3f4f6; font-size: 13px; border: 1px solid #000; font-weight: bold; }
        
        .col-dia { font-size: 11px !important; }
        .col-dia span { font-size: 7px !important; }
        
        .blocked-cell { background-color: #e5e7eb; letter-spacing: 1px; font-weight: bold; font-size: 12px; border: 1px solid #000; }
        .free-cell { border: 1px solid #000; }
        
        .obs-cell { border: 1px solid #000; padding: 0; }
        .obs-input { border: none; background: transparent; width: 100%; text-align: center; font-size: 12px; outline: none; height: 100%; }
        .obs-input:focus { background: #fef08a; }

        .action-btns { display: flex; gap: 1px; justify-content: center; flex-wrap: wrap; }
        .btn-action { cursor: pointer; font-size: 8px; padding: 2px 3px; border: 1px solid #ccc; background: #fff; border-radius: 2px; font-weight: bold; }
        .btn-action:hover { background: #e2e8f0; }

        .signatures { display: flex; justify-content: space-around; margin-top: 40px; font-size: 13px; font-weight: bold;}
        .sign-line { border-top: 1px solid #000; width: 300px; text-align: center; padding-top: 4px; }

        @media print {
            @page { size: landscape; margin: 5mm; }
            body { background: none; padding: 0; }
            .page { width: 100%; height: 100%; margin: 0; box-shadow: none; padding: 5mm; }
            .toolbar, .no-print { display: none !important; }
            
            /* Força as bordas na tabela durante a impressão */
            .point-table th, .point-table td, .obs-cell { border: 1px solid #000 !important; }
        }
    </style>
</head>
<body>

    <div class="toolbar no-print">
        <p style="margin-bottom: 10px;">Painel de Edição do Ponto</p>
        <button onclick="window.print()">🖨️ Imprimir Folhas</button>
    </div>

    @foreach($pointSheets as $index => $sheet)
        @php
            $bond = $sheet['bond'];
            $employee = $bond->employee;
        @endphp

        <div class="page" id="page-{{ $index }}">
            
            <div class="header-container">
                <div class="header-text">
                    <p>PREFEITURA MUNICIPAL DE PALMAS - SECRETARIA MUNICIPAL DA EDUCAÇÃO</p>
                    <p style="font-size: 16px; margin-top: 4px;">FOLHA DE PONTO</p>
                </div>
            </div>

            <table class="info-table">
                <tr>
                    <td colspan="2">SERVIDOR(A): {{ $employee->name ?? '' }}</td>
                    <td>MÊS: {{ $monthName }}</td>
                </tr>
                <tr>
                    <td>UNIDADE/GESTÃO: SEMED</td>
                    <td>LOTAÇÃO: {{ $bond->lotation_name ?? 'ESCOLA MUNICIPAL MESTRE PACÍFICO SIQUEIRA CAMPOS' }}</td>
                    <td>CPF: {{ $employee->cpf ?? '' }}</td>
                </tr>
                <tr>
                    <td>CARGO: {{ $bond->post ?? '' }}</td>
                    <td>FUNÇÃO: {{ $bond->role ?? '' }}</td>
                    <td>MATRÍCULA: {{ $bond->registration ?? '' }}</td>
                </tr>
                <tr>
                    <td colspan="2">VÍNCULO EMPREGATÍCIO: {{ $bond->bond ?? '' }}</td>
                    <td>CARGA HORÁRIA SEMANAL: {{ $bond->workload ?? '' }} HORAS</td>
                </tr>
            </table>

            <table class="point-table">
                <thead>
                    <tr>
                        <th style="width: 3%;" rowspan="2" class="col-dia">DIA</th>
                        
                        @if(isset($sheet['isNightVigia']) && $sheet['isNightVigia'])
                            <th colspan="7" style="background-color: #e2e8f0;">NOITE</th>
                            <th class="no-print" rowspan="2" style="width: 6%; background-color: #e2e8f0;">CTRL</th>
                        @else
                            <th colspan="3" style="background-color: #e2e8f0;">MANHÃ</th>
                            <th class="no-print" rowspan="2" style="width: 6%; background-color: #e2e8f0;">CTRL</th>
                            
                            <th colspan="3" style="background-color: #e2e8f0;">TARDE</th>
                            <th class="no-print" rowspan="2" style="width: 6%; background-color: #e2e8f0;">CTRL</th>
                        @endif
                        
                        <th style="width: 14%;" rowspan="2">OBSERVAÇÃO</th>
                    </tr>
                    <tr>
                        <th style="width: 6%;">ENTRADA</th>
                        <th style="width: 6%;">SAÍDA</th>
                        <th style="width: auto;">ASSINATURA</th>
                        
                        <th style="width: 6%;">ENTRADA</th>
                        <th style="width: 6%;">SAÍDA</th>
                        <th style="width: auto;">ASSINATURA</th>
                    </tr>
                </thead>
                <tbody id="tbody-{{ $index }}">
                    @foreach($sheet['days'] as $dIndex => $dayData)
                        
                        <tr id="row-{{ $index }}-{{ $dIndex }}">
                            <td class="col-dia"><strong>{{ $dayData['day'] }}</strong> - <span>{{ $dayData['day_name'] }}</span></td>
                            
                            @if($dayData['t1_status'] === 'BLOCKED')
                                <td colspan="3" class="blocked-cell text-center">
                                    {{ $dayData['t1_obs'] === '---' ? '---' : '--- ' . $dayData['t1_obs'] . ' ---' }}
                                </td>
                                <td style="display:none;"></td>
                                <td style="display:none;"></td>
                            @else
                                <td class="free-cell"></td>
                                <td class="free-cell"></td>
                                <td class="free-cell"></td>
                            @endif

                            <td class="no-print">
                                <div class="action-btns">
                                    <button class="btn-action" style="color: #2563eb;" onclick="setTurnState('{{ $index }}', '{{ $dIndex }}', 1, 'BLOCKED', 'H.ATIV')">H.A</button>
                                    <button class="btn-action" style="color: #d97706;" onclick="setTurnState('{{ $index }}', '{{ $dIndex }}', 1, 'BLOCKED', 'FOLGA')">Folga</button>
                                    <button class="btn-action" style="color: #dc2626;" onclick="setTurnState('{{ $index }}', '{{ $dIndex }}', 1, 'BLOCKED', 'BLOQ')">Bloq</button>
                                    <button class="btn-action" style="color: #16a34a;" onclick="setTurnState('{{ $index }}', '{{ $dIndex }}', 1, 'NORMAL', '')">Liberar</button>
                                </div>
                            </td>

                            @if($dayData['t2_status'] === 'BLOCKED')
                                <td colspan="3" class="blocked-cell text-center">
                                    {{ $dayData['t2_obs'] === '---' ? '---' : '--- ' . $dayData['t2_obs'] . ' ---' }}
                                </td>
                                <td style="display:none;"></td>
                                <td style="display:none;"></td>
                            @else
                                <td class="free-cell"></td>
                                <td class="free-cell"></td>
                                <td class="free-cell"></td>
                            @endif

                            <td class="no-print">
                                <div class="action-btns">
                                    <button class="btn-action" style="color: #2563eb;" onclick="setTurnState('{{ $index }}', '{{ $dIndex }}', 2, 'BLOCKED', 'H.ATIV')">H.A</button>
                                    <button class="btn-action" style="color: #d97706;" onclick="setTurnState('{{ $index }}', '{{ $dIndex }}', 2, 'BLOCKED', 'FOLGA')">Folga</button>
                                    <button class="btn-action" style="color: #dc2626;" onclick="setTurnState('{{ $index }}', '{{ $dIndex }}', 2, 'BLOCKED', '---')">Bloq</button>
                                    <button class="btn-action" style="color: #16a34a;" onclick="setTurnState('{{ $index }}', '{{ $dIndex }}', 2, 'NORMAL', '')">Liberar</button>
                                </div>
                            </td>

                            <td class="obs-cell">
                                <input type="text" class="obs-input" placeholder="...">
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>

            <div class="signatures">
                <div class="sign-line">Assinatura do(a) Gestor(a) Escolar</div>
                <div class="sign-line">Assinatura do(a) Secretário(a) Escolar</div>
            </div>
        </div>
    @endforeach

    <script>
        function setTurnState(sheetIdx, dayIdx, turnNum, state, text) {
            const tr = document.getElementById('row-' + sheetIdx + '-' + dayIdx);
            const startCell = (turnNum === 1) ? 1 : 5;

            if (state === 'BLOCKED') {
                tr.cells[startCell].colSpan = 3;
                tr.cells[startCell].className = 'blocked-cell text-center';
                tr.cells[startCell].innerHTML = (text === '---' || !text) ? '---' : `--- ${text} ---`;
                tr.cells[startCell].style.display = '';

                for (let i = 1; i < 3; i++) {
                    tr.cells[startCell + i].style.display = 'none';
                }
            } else {
                for (let i = 0; i < 3; i++) {
                    const cell = tr.cells[startCell + i];
                    cell.style.display = '';
                    cell.colSpan = 1;
                    cell.className = 'free-cell';
                    cell.innerHTML = '';
                }
            }
        }
    </script>
</body>
</html>