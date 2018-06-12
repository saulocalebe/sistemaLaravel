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
            $query=trim($request->get('searchText'));
            $categorias = DB::table('categoria')
                ->where('nome', 'LIKE', '%'. $query .'%')
                ->where('condicao', '=', true)
                ->orderBy('id', 'desc')
                ->paginate(7);
            
            return view('estoque.categoria.index', [
                'categorias '=> $categorias, 'searchText' => $query
            ]);
        }
    }
    
    public function create(){
        //'estoque.categoria.create'
    }
    
    public function store(CategoriaFormRequest $request){
        $categoria = new Categoria;
        $categoria->nome = $request->get('nome');
        $categoria->descricao = $request->get('descricao');
        $categoria->condicao = true;
        $categoria->save();

        return Redirect::to('estoque/categoria');
    }
    
    public function show($id){
        return view('estoque.categoria.show', [
            'categoria' => Categoria::findOrFail($id)
        ]);
    }

    public function edit($id){
        return view('estoque.categoria.edit', [
            'categoria' => Categoria::findOrFail($id)
        ]); 
    }

    public function update(CategoriaFormRequest $request, $id){
        $categoria = Categoria::findOrFail($id);
        $categoria->nome = $request->get('nome');
        $categoria->descricao = $request->get('descricao');
        $categoria->update();

        return Redirect::to('estoque/categoria');
    }

    public function destroy($id){
        $categoria = Categoria::findOrFail($id);
        $categoria->condicao = false;
        $categoria->update();

        return Redirect::to('estoque/categoria');
    }
}
