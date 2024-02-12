<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use App\Models\User; // Adicionado para importar a classe User
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        // Corrigido para usar um array de ações no middleware 'can:level'
        $this->middleware('can:level')->only(['index']);
    }

    public function meus_cientes(User $user)
    {
        // Corrigido para usar o método find para buscar um usuário com base no ID
        $user = User::find($user->id);
        $clientes = $user->customers()->get();

        return view('clientes.meus_clientes', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clientes.index', [
            'clientes' => Cliente::orderBy('nome')->paginate(5)
        ]);
    }

    public function show(Cliente $cliente)
    {

          return view('cliente.show',['cliente' => $cliente]);


    }
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->user_id = $request->user_id;
        $cliente->nome = $request->nome;
        $cliente->email = $request->email;
        $cliente->telefone = $request->telefone;
        $cliente->empresa = $request->empresa;
        $cliente->tel_comercial = $request->tel_comercial;

        $cliente->save();
        // Corrigido para redirecionar para 'cliente.index'
        return redirect()->route('cliente.index')->with('msg', 'Cliente Cadastrado Com Sucesso!');
    }

    // ... (métodos restantes permanecem inalterados)
}
