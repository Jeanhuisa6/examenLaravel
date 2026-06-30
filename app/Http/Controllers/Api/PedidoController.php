<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        return response()->json(Pedido::with(['cliente', 'detalles.producto'])->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_pedido' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);
        $pedido = Pedido::create($request->all());
        return response()->json($pedido, 201);
    }

    public function show(string $id)
    {
        $pedido = Pedido::with(['cliente', 'detalles.producto'])->find($id);
        if (!$pedido) return response()->json(['mensaje' => 'No encontrado'], 404);
        return response()->json($pedido, 200);
    }

    public function update(Request $request, string $id)
    {
        $pedido = Pedido::find($id);
        if (!$pedido) return response()->json(['mensaje' => 'No encontrado'], 404);
        $pedido->update($request->all());
        return response()->json($pedido, 200);
    }

    public function destroy(string $id)
    {
        $pedido = Pedido::find($id);
        if (!$pedido) return response()->json(['mensaje' => 'No encontrado'], 404);
        $pedido->delete();
        return response()->json(['mensaje' => 'Pedido eliminado'], 200);
    }
}