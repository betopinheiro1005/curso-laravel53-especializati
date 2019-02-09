<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Product;
use App\Http\Requests\Painel\ProductFormRequest;

class ProdutoController extends Controller
{

    private $product;
    private $totalPage = 3;

    public function __construct(Product $product){
         $this->product = $product;
    }

    public function index()
    {

        $title = "Listagem dos produtos";
        // $products = $this->product->all();
        $products = $this->product->paginate($this -> totalPage);

        return view('painel.products.index', compact('products','title'));
    }

    public function create()
    {
        // return "#form Cad";

        $title = "Cadastrar novo produto";
        $categorys = ['eletronicos','moveis','limpeza','banho'];

        return view('painel.products.create-edit', compact('title','categorys'));
    }

    public function store(ProductFormRequest $request)
    {
        // dd($request->all());
        // dd($request->only(['name','number']));
        // dd($request->except(['_token']));
        // dd($request->input('name'));

        /* Pega todos os dados que vem do formulário */
        // $dataForm = $request->except('_token');
        $dataForm = $request->all();

        $dataForm['active'] = (!isset($dataForm['active']) ) ? 0 : 1;

        /* Valida os dados */
        // $this->validate($request, $this->product->rules);

        // $messages = [
        //     'name.required' => 'O campo Nome é de preenchimento obrigatório!',
        //     'number.numeric' => "No campo Número, digite apenas números!",
        //     'number.required' => 'O campo Número é de preenchimento obrigatório!',
        // ];

        // $validate = validator($dataForm, $this->product->rules, $messages);

        // if( $validate->fails()){
        //     return redirect()
        //     ->route('produtos.create')
        //     ->withErrors($validate)
        //     ->withInput();
        // }

        /* Faz o cadastro */
        // $insert = $this->product->insert($dataForm);
        $insert = $this->product->create($dataForm);

        if($insert)
            return redirect()->route('produtos.index');
        else 
            return redirect()->route('produtos.create');

        // return "Cadastrando...";
    }

    public function show($id)
    {

        $title = "Deletar produto {$id}";        
        $product = $this->product->find($id);

        return view('painel.products.show', compact('title','product'));

        // return "Show {$id}";

    }

    public function edit($id)
    {
        
        //Recupera o produto pelo seu id
        $product = $this->product->find($id);
        
        $title = "Editar Produto: {$product->name}";
        
        $categorys = ['eletronicos', 'moveis', 'limpeza', 'banho'];
        
        return view('painel.products.create-edit', compact('title', 'categorys', 'product'));

        // return "Editar item {$id}";
    }

    public function update(ProductFormRequest $request, $id)
    {
        
        // Recupera todos os dados do formulário
        $dataForm = $request -> all();

        // Recupera o item para editar    
        $product = $this->product->find($id);

        // Verifica se o produto está ativado    
        $dataForm['active'] = (!isset($dataForm['active']) ) ? 0 : 1;

        // Altera os itens    
        $update = $product->update($dataForm);

        // Verifica se realmente editou    
        if($update){
                return redirect()->route('produtos.index');
        } else {
                return redirect()->route('produtos.edit', $id)->with(['errors'=>'Falha ao editar!']);
        }

        // return "Editando o item {$id}";
    }

    public function destroy($id)
    {
        $product = $this->product->find($id);
        
        $delete = $product->delete();
        
        if( $delete )
            return redirect()->route('produtos.index');
        else
            return redirect()->route('produtos.show', $id)->with(['errors' => 'Falha ao deletar']);
        
        // return "Deletando o item {$id}";
    }

    public function tests(){
        // return 'tests';

        // $this->product->insert();

        // $prod = $this->product;

        // $prod->name="Nome do produto";
        // $prod->number=131231;
        // $prod->active=true;
        // $prod->category='eletronicos';
        // $prod->description='Descrição do produto';
        // $insert = $prod->save();
        
        // if($insert){
        //     return 'Inserido com sucesso!';
        // } else {
        //     return 'Falha ao inserir!';
        // }   



        // $insert = $this->product->create([
        //     'name'          => 'Nome do produto 2',
        //     'number'        => 434435,
        //     'active'        => false,
        //     'category'      => 'eletronicos',
        //     'description'   => 'Descrição do produto'
        // ]);

        // if($insert){
        //     return "Inserido com sucesso, ID: {$insert -> id}";
        // } else {
        //     return 'Falha ao inserir!';
        // }   

        // $prod = $this->product->find(5);
        // $prod->name="Update";
        // $prod->number=79789;
        // $prod->active=true;
        // $prod->category='eletronicos';
        // $prod->description='Desc. Update';
        // $update = $prod->save();

        // $prod = $this->product->find(5);
        // $prod->name="Update 2";
        // $prod->number=797890;
        // $update = $prod->save();

        // $prod = $this->product->find(5);
        // $prod->name="Update 2";
        // $prod->number=797890;
        // $update = $prod->save();

        // $prod = $this->product->find(6);
        // $update = $prod->update([
        //    'name'          => 'Update test',
        //    'number'        => 6765756,
        //    'active'        => true
        // ]);

        // $prod = $this->product->where('number',6765756);
        // $update = $prod->update([
        //    'name'          => 'Update test 2',
        //    'number'        => 67657560,
        //    'active'        => false
        // ]);

        // if($update){
        //     return "Alterado com sucesso 2!";
        // } else {
        //     return 'Falha ao alterar!';
        // }   

        // $prod = $this->product->find(3);
        // $delete = $prod->delete();

        // if($delete){
        //     return "Deletado com sucesso!";
        // } else {
        //     return 'Falha ao deletar!';
        // }   

        $delete = $this->product->where('number',67657560)->delete();

        if($delete){
            return "Deletado com sucesso 2!";
        } else {
            return 'Falha ao deletar!';
        }   


    }

}
