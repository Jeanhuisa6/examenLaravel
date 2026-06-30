<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    public function index()
    {
        return response()->json(DetallePedido::with(['pedido', 'producto'])->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
        ]);
        $detalle = DetallePedido::create($request->all());
        return response()->json($detalle, 201);
    }

    public function show(string $id)
    {
        $detalle = DetallePedido::with(['pedido', 'producto'])->find($id);
        if (!$detalle) return response()->json(['mensaje' => 'No encontrado'], 404);
        return response()->json($detalle, 200);
    }

    public function update(Request $request, string $id)
    {
        $detalle = DetallePedido::find($id);
        if (!$detalle) return response()->json(['mensaje' => 'No encontrado'], 404);
        $detalle->update($request->all());
        return response()->json($detalle, 200);
    }

    public function destroy(string $id)
    {
        $detalle = DetallePedido::find($id);
        if (!$detalle) return response()->json(['mensaje' => 'No encontrado'], 404);
        $detalle->delete();
        return response()->json(['mensaje' => 'Detalle eliminado'], 200);
    }
}