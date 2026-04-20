<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function create()
    {
        // dd(Usuario::all());
        $usuarios = Usuario::all();
        return view('usuarios', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'cellPhone_number' => 'required|numeric',
            'role' => 'required',
            'city' => 'required',
            'country' => 'required'
        ], [
            'name.required' => 'El nombre es obligatorio',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo no es válido',
            'cellPhone_number.required' => 'El número de telefono es obligatorio',
            'role.required' => 'El rol del usuario es obligatorio',
            'city.required' => 'La ciudad es obligarotio',
            'country.required' => 'El país es obligarotio'
        ]);

        Usuario::create($validated);

        return redirect()->route('usuarios.create')
            ->with('success', 'Usuario guardado correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email',
            'cellPhone_number' => 'required|numeric',
            'role' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);

        $usuario = Usuario::findOrFail($id);

        $usuario->update($request->all());

        return redirect()->route('usuarios.create')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        Usuario::findOrFail($id)->delete();

        return redirect()->route('usuarios.create')
            ->with('success', 'Usuario eliminado correctamente');
    }
    
}
