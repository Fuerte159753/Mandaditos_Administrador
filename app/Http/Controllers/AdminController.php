<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\repartidor;
use App\Models\Ruta;
use App\Models\Vendedor;

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
        $clientes = Cliente::all();
        return view('admin.clientes', ['clientes' => $clientes]);
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

            return redirect()->route('admin.clientes')->with('success', '¡Cliente eliminado correctamente!');
        } catch (\Throwable $e) {
            // Registro de error en el registro de errores
            error_log('Error al eliminar el cliente: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Error al eliminar el cliente: ' . $e->getMessage()]);
        }
    }

    //funciones para la vista repartidor
    public function repartidores()
    {
        $repartidores = Repartidor::all();
        $rutas = Ruta::all();
        return view('admin.repartidores', compact('repartidores', 'rutas'));
    }
    public function updarepar(Request $request, $repartidor_id)
    {
        $repartidorData = $request->only('correo','username', 'nombre', 'apellido', 'telefono');
        $repartidorData['repartidor_id'] = $repartidor_id;
        
        try {
            Repartidor::rules1($repartidorData);
            $repartidor = Repartidor::findOrFail($repartidor_id);
            $repartidor->update($repartidorData);    
            return redirect()->route('admin.repartidor')->with('success', 'Repartidor actualizado correctamente');

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error al actualizar el repartidor: ' . $e->getMessage()], 500);
        }
    }
    public function registrarRepartidor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255|unique:repartidores',
            'username' => 'required|string|max:255|unique:repartidores',
            'password' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:255',
            'ruta_asignada' => 'nullable|exists:rutas,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $repartidor = new Repartidor();
            $repartidor->nombre = $request->input('nombre');
            $repartidor->apellido = $request->input('apellido');
            $repartidor->correo = $request->input('correo');
            $repartidor->username = $request->input('username');
            $repartidor->password = bcrypt($request->input('password'));
            $repartidor->telefono = $request->input('telefono');
            $repartidor->ruta_asignada = $request->input('ruta_asignada');
            $repartidor->save();

            return redirect()->route('admin.repartidor')->with('success', 'Repartidor registrado correctamente');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['error' => 'Error al registrar el repartidor: ' . $e->getMessage()])->withInput();
        }
    }
    public function deleterepar($repartidor_id)
    {
        try {
            $repartidor = repartidor::findOrFail($repartidor_id);
            $repartidor->delete();

            return redirect()->route('admin.repartidor')->with('success', '¡Repartidor eliminado correctamente!');
        } catch (\Throwable $e) {
            return back()->withErrors(['error' => 'Error al eliminar el Repartidor: ' . $e->getMessage()]);
        }
    }

    //vendedores
    public function vendedores()
    {   
        $vendedores = Vendedor::all();
        return view('admin.vendedores', compact('vendedores'));
    }
    public function registrarVendedor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_establecimiento' => 'required|string|max:255|unique:vendedores,nombre_establecimiento',
            'username' => 'required|string|max:255|unique: vendedores,username',
            'correo' => 'required|string|email|max:255|unique:vendedores,correo',
            'contraseña' => 'required|string|min:8',
            'telefono' => 'nullable|string|max:255',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $vendedores = new Vendedor();
        $vendedores->nombre = $request->input('nombre_establecimiento');
        $vendedores->username = $request->input('username');
        $vendedores->correo = $request->input('correo');
        $vendedores->password = bcrypt($request->input('contraseña'));
        $vendedores->telefono = $request->input('telefono');
        $vendedores->save();

        return redirect()->route('admin.vendedores')->with('success', 'Vendedor registrado correctamente');
    }
    public function actuavendedor(Request $request, $id)
    {
        $vendedorData = $request->only('correo','username', 'nombre', 'apellido', 'telefono');
        $vendedorData['id'] = $id;
        
        try {
            Vendedor::rules($vendedorData);
            $repartidor = Repartidor::findOrFail($id);
            $repartidor->update($vendedorData);    
            return redirect()->route('admin.Vendedor')->with('success', 'Vendedor actualizado correctamente');

        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error al actualizar el Vendedor: ' . $e->getMessage()], 500);
        }
    }
    public function eliminarVendedor($id)
    {
        try {
            $vendedor = Vendedor::findOrFail($id);
            $vendedor->delete();

            return redirect()->route('admin.clientes')->with('success', '¡Vendedor eliminado correctamente!');
        } catch (\Throwable $e) {
            error_log('Error al eliminar el Vendedor: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Error al eliminar el Vendedor: ' . $e->getMessage()]);
        }
    }
}