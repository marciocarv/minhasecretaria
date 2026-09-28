<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HelpTicket;

class HelpController extends Controller
{
    public function index()
    {
        // Ordena por Status (Finalizados ficam por último) e depois pelos mais recentes
        $tickets = HelpTicket::orderByRaw("FIELD(status, 'Solicitado', 'Atendido', 'Finalizado')")
                             ->orderBy('created_at', 'desc')
                             ->get();
                             
        return view('help.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'responsible' => 'required|string|max:255',
            'subject'     => 'required|string',
            'report'      => 'required|string',
        ]);

        HelpTicket::create([
            'responsible' => $request->responsible,
            'subject'     => $request->subject,
            'report'      => $request->report,
            'status'      => 'Solicitado',
        ]);

        return redirect()->back()->with('success', 'Chamado aberto com sucesso!');
    }

    public function edit($id)
    {
        $ticket = HelpTicket::findOrFail($id);
        return view('help.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'responsible' => 'required|string|max:255',
            'subject'     => 'required|string',
            'report'      => 'required|string',
        ]);

        $ticket = HelpTicket::findOrFail($id);
        $ticket->update($request->only(['responsible', 'subject', 'report']));

        return redirect()->route('help.index')->with('success', 'Chamado atualizado com sucesso!');
    }

    public function updateStatus(Request $request, $id)
    {
        $ticket = HelpTicket::findOrFail($id);
        
        $ticket->status = $request->status;
        
        if ($request->status == 'Atendido' && !$ticket->attended_at) {
            $ticket->attended_at = now();
        } elseif ($request->status == 'Finalizado' && !$ticket->finished_at) {
            $ticket->finished_at = now();
        }

        $ticket->save();

        return redirect()->back()->with('success', 'Status do chamado atualizado!');
    }

    public function destroy($id)
    {
        HelpTicket::findOrFail($id)->delete();
        return redirect()->route('help.index')->with('success', 'Chamado excluído com sucesso!');
    }
}