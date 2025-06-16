<?php

// app/Http/Controllers/ReceiveDataController.php

namespace App\Http\Controllers;

use App\Models\ReceivedData;
use Illuminate\Http\Request;

class ReceiveDataController extends Controller
{
    // store: grava sempre usando o identifier do usuário logado
    public function store(Request $request)
    {
        $user = $request->user();
        $data = $request->all();           // todos os dados da payload
        // opcional: filtre apenas o que quer salvar
        unset($data['user_id']);           // já não usamos

        ReceivedData::create([
            'user_identifier' => $user->identifier,
            'payload'         => $data,
        ]);

        return response()->json(['message' => 'Dados salvos com sucesso!']);
    }

    // index: mostra só os dados do user autenticado
    public function index(Request $request)
    {
        $user = $request->user();

        $data = $user->receivedData()
            ->latest()
            ->get();

        return response()->json($data);
    }
}
