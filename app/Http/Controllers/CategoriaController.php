<?php

namespace sistemaLaravel\Http\Controllers;

use Illuminate\Http\Request;
use sistemaLaravel\Categoria;
use Illuminate\Support\Facedes\Redirect;
use sistemaLaravel\Http\Request\CategoriaFormRequest;
use DB;
class CategoriaController extends Controller
{
    public function __construct(){
        //
    }

    public function index(Request $request){
        if ($request){
            $searchText = trim($request->get('searchText'));
            $categorias = Categoria::where('nome', 'LIKE', '%'. $searchText .'%')
                ->where('condicao', '=', true)
                //->orderBy('id', 'desc')
                ->paginate(7);
            
            return view('estoque.categoria.index', compact('categorias', 'searchText'));
        }
    }
    
    public function create(){
        return view('estoque.categoria.create');
    }
    
    public function store(Request $request){
        $categoria = new Categoria;
        $categoria->nome = $request->get('nome');
        $categoria->descricao = $request->get('descricao');
        $categoria->condicao = true;
        $categoria->save();

        return Redirect('estoque/categoria');
    }
    
    public function show($id){
        return view('estoque.categoria.show', [
            'categoria' => Categoria::findOrFail($id)
        ]);
    }

    public function edit($id){
        $categoria = Categoria::findOrFail($id);
        return view('estoque.categoria.edit', compact('categoria')); 
    }

    public function update(Request $request, $id){
        $categoria = Categoria::findOrFail($id);
        $categoria->nome = $request->get('nome');
        $categoria->descricao = $request->get('descricao');
        $categoria->update();

        return Redirect('estoque/categoria');
    }

    public function destroy(Request $request, $id){
        $categoria = Categoria::findOrFail($id);
        $categoria->condicao = false;
        $categoria->update();

        return Redirect('estoque/categoria');
    }
}
