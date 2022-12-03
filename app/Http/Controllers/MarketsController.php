<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Market;
use App\Models\Product_Market;
use App\Models\Produto;

class MarketsController extends Controller
{
    //retorna a pagina inicial dos mercados
    //retorna: nada
    //view: markets.markets_main
    public function home(){
        return view('markets.markets_main');
    }
    //mostra a pagina de adição de mercados
    //retorna: nada
    //view: markets.market_insert_form
    public function create(){
        return view('markets.market_insert_form');
    }
    //valida os dados do CREATE e adiciona-os ao banco de mercados, 
    //retorna: (status) dizendo algum debug, 
    //view: markets.market_insert_form
    public function store(request $request){
        
        
        $motive = [

            'name' => 'required|min:3|max:100', 'type' => 'required',
            'cnpj' => 'required|min:15|max:18', 'address' => 'required|max:150'

        ];

        $reason = [
            'name.required' => 'A Ghost Market? With no name?',
            'type.required' => 'I do not work with random Markets, Tell me the Market type',
            'cnpj.required' => 'A Market without CNPJ is a Market waiting for a lawsuit',
            'address.required' => 'The Address for this Market is Nowhere, great',
            
            'cnpj.min' => 'If you are going to give me a CPF at least make it big enought',
            'cnpj.max' => 'That CNPJ is bigger than usual, make it less',
            'amount_stocked.min' => "you want to sell something that you don't have? right...",
            'address.max' => 'that address is too big'
        ];
        
        $request->validate($motive, $reason);
        

        Market::create([
            'name' => $request->name,
            'type' => $request->type,
            'cnpj' => $request->cnpj,
            'address' => $request->address,

        ]);
        return view('markets.market_insert_form', ['status' => 'Insertion done Successfully']);

    }
    //mostra a lista de todas os mercados
    //retorna: lista de mercados ($Ldata) e o ($request) recebido
    //view: markets.market_list_main
    //requer: (search) vazio ou não para fazer a busca filtrada
    public function index(request $request){
        
        $list_data = Market::orwhere('name', 'like', '%'.$request->input('search').'%' )
        ->orwhere('cnpj', 'like', '%'.$request->input('search').'%' )
        ->orwhere('address', 'like', '%'.$request->input('search').'%' )
        ->orwhere('type', 'like', '%'.$request->input('search').'%' )
        ->paginate(5);
        
        return view('markets.market_list_main', ['Ldata' => $list_data, 'request' => $request->all()]);
    
    }
    //mostra um mercado especifico
    //retorna: nomes dos produtos ($names), as ocorrencias do mercado em products_markets (order_history), 
    //  nome do mercado (market)
    //view: markets.market_list_show
    //requer: (id) de um mercado no url
    public function show($id){
        $market = Market::find($id);
        $market = $market->name;
        
        $products = Product_Market::where('market_id', '=', $id)->get();
        
        $products_names = [];
        $products_prices = [];
        $i = 0;
        //cria um array com todos os nomes dos produtos pertencentes ao mercado escolhido
        foreach($products as $product){
            //this for each gets the name names for the produto_id of the many to many table of product 
            //and markets, the index [0] is equal to the index [0] of the product_market
            $temp = Produto::find($products[$i]['produto_id']);
            
            array_push($products_names, $temp['name']);
            
            array_push($products_prices, $temp['price']);
            
            $i = $i+1;
        }
        
        return view('markets.market_list_show', [
            'order_history' => $products, 
            'names' => $products_names, 
            'market' => $market,
            'products_prices' => $products_prices,
        ]);

    }
    //recupera o mercado escolhido pra edição atravez do id no url, e retorna a view de edição 
    //retorna: mercado escolhido pra editar (current_data)
    //view: markets.market_list_show
    //requer: (id) de um mercado no url
    public function edit($id){
        $single_user = Market::find($id);

        return view('markets.market_edit_form', ['current_data' => $single_user]);
    }
    //valida os dados da edição de mercado e os atualiza no banco 
    //retorna: nada
    //redirect: site.markets.list
    //requer: (id) do mercado no url, e todos os dados para atualização do registro
    public function update($id, request $request){
        
        $motive = [

            'name' => 'required|min:3|max:100', 'type' => 'required',
            'cnpj' => 'required|min:15|max:18', 'address' => 'required|max:150'

        ];

        $reason = [
            'name.required' => 'A Ghost Market? With no name?',
            'type.required' => 'I do not work with random Markets, Tell me the Market type',
            'cnpj.required' => 'A Market without CNPJ is a Market waiting for a lawsuit',
            'address.required' => 'The Address for this Market is Nowhere, great',
            
            'cnpj.min' => 'If you are going to give me a CPF at least make it big enought',
            'cnpj.max' => 'That CNPJ is bigger than usual, make it less',
            'amount_stocked.min' => "you want to sell something that you don't have? right...",
            'address.max' => 'that address is too big'
        ];
        
        $request->validate($motive, $reason);
        
        $record_update = Market::find($id);
        $record_update->name = $request->name;
        $record_update->address = $request->address;
        $record_update->type = $request->type;
        $record_update->cnpj = $request->cnpj;
        
        $record_update->save();

        return redirect(route('site.markets.list'));
    }
    //mostra o registro selecionado e questiona a deleção do mesmo
    //retorna: o registro selecionado (Ldata), e o id do registro (id)
    //view: markets.market_remove_form
    //requer: id do registro pelo url (id)
    public function destroy_confirmation($id){
        
        $record_removal = Market::where('id', '=', $id)->get();
        
        $id = $record_removal->pluck('id');
        
        return view('markets.market_remove_form', ['Ldata' => $record_removal, 'id' => $id[0]]);
    }
    //deleta qualquer registro passado
    //retorna: nada
    //redirect: pro url anterior, 
    //requer: id do mercado a ser deletado (market_id)->post
    public function destroy(request $request){
        print_r($request->all());
        
        $product_deletion = Market::find($request->market_id)->delete();
        
        if(strpos(url()->previous(), '/markets/list/remove')){
            return redirect()->back();
            }
    
        return redirect(route('site.markets.list', ['msg' => 1]));
    }
    //acessa uma view, onde a deleção de registros não possui confirmação, e vai direto pro destroy
    //retorna: lista de mercados ($Ldata) e o ($request) recebido
    //view: markets.market_list_mass_remove
    //requer: (search) vazio ou não para fazer a busca filtrada
    public function mass_destroy(request $request){
        $list_data = Market::orwhere('name', 'like', '%'.$request->input('search').'%' )
        ->orwhere('cnpj', 'like', '%'.$request->input('search').'%' )
        ->orwhere('address', 'like', '%'.$request->input('search').'%' )
        ->orwhere('type', 'like', '%'.$request->input('search').'%' )
        ->paginate(5);
        
        return view('markets.market_list_mass_remove', ['Ldata' => $list_data, 
            'request' => $request->all()]);
    }
}



