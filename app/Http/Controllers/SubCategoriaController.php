<?php

namespace App\Http\Controllers;

use App\Models\{Categoria, SubCategoria};
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubCategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategorias = SubCategoria::with('categoria')->get();
        return Inertia::render('SubCategoria/Index', compact('subcategorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::where('estado', 1)->get();
        return Inertia::render('SubCategoria/Create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categoria,id',
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $data = $request->all();
        $data['cantidad_productos'] = 0;

        SubCategoria::create($data);

        return redirect()->route('subcategorias.index')->with('success', '¡Subcategoría creada!');
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
    public function edit(SubCategoria $subcategoria)
    {
        $categorias = Categoria::where('estado', 1)->get();
        return Inertia::render('SubCategoria/Edit', compact('subcategoria', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategoria $subcategoria)
    {
        $request->validate([
            'categoria_id' => 'required|exists:categoria,id',
            'nombre' => 'required|string|max:255',
            'estado' => 'required|boolean',
        ]);

        $subcategoria->update($request->all());

        return redirect()->route('subcategorias.index')->with('success', '¡Subcategoría actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategoria $subcategoria)
    {
        $subcategoria->update(['estado' => 0]);
        return redirect()->route('subcategorias.index')->with('success', '¡Subcategoría desactivada!');
    }
}
