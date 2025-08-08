<?php

namespace App\Http\Controllers;

use App\Models\{Producto, Categoria, SubCategoria, User};
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->rol_id == 1;

        $data = [
            'totalProductos'     => Producto::count(),
            'totalCategorias'    => Categoria::count(),
            'totalSubcategorias' => SubCategoria::count(),
            'productosRecientes' => Producto::latest()->take(5)->get(['id', 'nombre', 'estado', 'created_at']),
        ];

        if ($isAdmin) {
            $data['totalUsuarios'] = User::count();
        }

        return Inertia::render('Dashboard', [
            'datos'   => $data,
            'usuario' => [
                'nombre' => $user->name,
                'rol'    => $isAdmin ? 'Administrador' : 'Estandar',
            ],
        ]);
    }
}
