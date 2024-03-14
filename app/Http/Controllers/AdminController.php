<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\repartidor;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $field = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [
            $field => $credentials['username'],
            'password' => $credentials['password']
        ];
        //validacion de inicio de sesion
        if (auth()->guard('admin')->attempt($credentials)) {
            $user = auth()->guard('admin')->user();
            session(['name' => $user->name, 'lastName' => $user->last_name]);
            return redirect()->route('admin.inicio');
        }
        return back()->withErrors(['message' => 'Credenciales incorrectas']);
    }    
    public function logout()
    {
        session()->forget(['name', 'lastName']);
        auth()->guard('admin')->logout();
        return redirect('/');
    }
    public function clientes()
    {
        $clientes = Cliente::all(); // Obtener todos los clientes de la base de datos
        return view('admin.clientes', ['clientes' => $clientes]); // Pasar los clientes a la vista
    }
    public function actualizarCliente(Request $request, $cliente_id)
    {
        $clienteData = $request->only('nombre', 'apellido', 'localidad', 'telefono', 'correo', 'verificado');
        $clienteData['cliente_id'] = $cliente_id;

        try {
            Cliente::rules($clienteData);
            
            $cliente = Cliente::findOrFail($cliente_id);
            $cliente->update($clienteData);    
            return redirect()->route('admin.clientes')->with('success', 'Cliente actualizado correctamente');

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error al actualizar el cliente: ' . $e->getMessage()], 500);
        }
    }
    public function eliminarCliente($cliente_id)
    {
        try {
            $cliente = Cliente::findOrFail($cliente_id);
            $cliente->delete();

            return response()->json(['message' => 'Cliente eliminado correctamente'], 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error al eliminar el cliente: ' . $e->getMessage()], 500);
        }
    }
    //funciones para la vista repartidor
    public function repartidores()
    {
        $repartidores = repartidor::all();
        return view('admin.repartidores', ['repartidores' => $repartidores]);
    }
}
