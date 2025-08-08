<?php

namespace App\Http\Controllers;

use App\Models\{Producto, SubCategoria};
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with('subCategorias')->get();
        return Inertia::render('Producto/Index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subcategorias = SubCategoria::with('categoria')->where('estado', true)->get();
        return Inertia::render('Producto/Create', compact('subcategorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'subcategorias' => 'array',
            'subcategorias.*' => 'exists:subcategoria,id',
        ]);

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        // Asegurarse de que subcategorias sea un array (aunque esté vacío)
        $subcategorias = $request->input('subcategorias', []);

        // Relacionar el producto con las subcategorías
        $producto->subCategorias()->sync($subcategorias);

        // Incrementar cantidad_productos en cada subcategoría relacionada
        foreach ($subcategorias as $subId) {
            SubCategoria::find($subId)?->increment('cantidad_productos');
        }

        return redirect()->route('productos.index')->with('success', '¡Producto creado!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $producto->load('subCategorias');
        $subcategorias = SubCategoria::with('categoria')->where('estado', 1)->get();

        return Inertia::render('Producto/Edit', compact('producto', 'subcategorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'subcategorias' => 'array',
            'subcategorias.*' => 'exists:subcategoria,id'
        ]);

        $producto->update($request->only(['nombre', 'estado']));
        $producto->subCategorias()->sync($request->subcategorias);

        return redirect()->route('productos.index')->with('success', '¡Producto actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->update(['estado' => 0]);
        return redirect()->route('productos.index')->with('success', '¡Producto desactivado!');
    }
}
