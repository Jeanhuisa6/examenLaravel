<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return response()->json(Cliente::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
        ]);
        $cliente = Cliente::create($request->all());
        return response()->json($cliente, 201);
    }

    public function show(string $id)
    {
        $cliente = Cliente::with('pedidos')->find($id);
        if (!$cliente) return response()->json(['mensaje' => 'No encontrado'], 404);
        return response()->json($cliente, 200);
    }

    public function update(Request $request, string $id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) return response()->json(['mensaje' => 'No encontrado'], 404);
        $cliente->update($request->all());
        return response()->json($cliente, 200);
    }

    public function destroy(string $id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) return response()->json(['mensaje' => 'No encontrado'], 404);
        $cliente->delete();
        return response()->json(['mensaje' => 'Cliente eliminado'], 200);
    }
}