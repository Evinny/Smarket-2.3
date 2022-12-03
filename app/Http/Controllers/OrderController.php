<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Market;
use App\Models\product_market;
use App\Models\product_market_log;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $market_names = Market::all()->pluck('name', 'id');
        $product_names = Produto::all()->pluck('name', 'id');
        return view('orders.order_make_form', ['market_names' => $market_names, 'product_names' => $product_names]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //lembrar de arrumar este codigo, ele so funciona se o request tiver os dados PERFEITOS das tabelas
        //do mercado e do produto e que nao atualiza o tanto de produto que um mercado tem, so troca pelo
        
        

        $motive = [

            'market_name' => 'required', 'market_cnpj' => 'required|min:15|max:18',
            'product_names' => 'required', 'product_amount' => 'integer|required' 

        ]; //need to do the redirect to corresponding routes to go through the controller in order to let the search for the
        //names of markets and products to be searched again

        $reason = [
            'market_name.required' => 'Order to wich Market? Nordestão?',
            'market_cnpj.required' => 'So the Market is illegal by not having a CNPJ/CPF?',
            'product_names.required' => 'Order nothing? How does that work',
            'product_amount.required' => 'Sending nothing right away!',
            
            'cnpj.min' => 'If you are going to give me a CPF at least make it big enought',
            'cnpj.max' => 'That CNPJ is bigger than usual, make it less',
            
            'product_amount.integer' => 'The amount must be a number kiddo'
        ];
        
        $request->validate($motive, $reason);
                
                
        
        
        
        
        $market = Market::where('name', 'like', '%'.$request->market_name.'%')
                    ->where('cnpj', '=', $request->market_cnpj) //searches for the market with the matching
                    ->get(); //cnpj and name send in the form
                
                if($market->isEmpty()){ //checks if the search found anything, if not, returns error
                    return redirect()->route('order.create')->with(['status' => "Market doesn't exist"]);
                }
            
            $market = $market[0]; //simplifies things, instead of $market[0]['name'], its just $market['name']
                
                
            $product = Produto::where('name', 'like', '%'.$request->product_names.'%')->get();
                //searches of the product name in the table produtos

                if($product->isEmpty()){ //checkes if there was found any product with corresponding name
                    return redirect()->route('order.create')->with(['status' => "Product doesn't exist"]);
                }

                elseif($product[0]['amount_stocked'] < $request->product_amount){
                    return redirect()->route('order.create')->with(['status' => "Sorry, we only have x of that product"]);
                } //checks if the order quantity is greater than the amount stocked
            
            $product = $product[0];
                
            $repeated_entry = Product_Market::where('produto_id', '=', $product->id)
            ->where('market_id', '=', $market->id)->get();
            
            $repeated_entry_update = Product_Market::where('produto_id', '=', $product->id)
            ->where('market_id', '=', $market->id);
            
            $repeated_entry = $repeated_entry[0];
            
                
                
                if($repeated_entry->count())
                {
                
                    $repeated_entry_update->update(['amount_requested' => $repeated_entry->amount_requested + $request->product_amount,
                        'amount_left' => $repeated_entry->amount_requested + $request->product_amount,
                        
                    ]);
                }
                else
                {
                        
                        product_market::create(['produto_id' => $product['id'],
                        'market_id' => $market['id'], //saves the info ghatered to the product_market relationship
                        'amount_requested' => $request->product_amount, //table
                        'amount_left' => $request->product_amount,
                        'amount_sold' => '0'
                        
                    ]);
                }
                
                
                
                
                
                    
                
                
                $product_upd = Produto::where('name', 'like', '%'.$request->product_names.'%')
                ->update(['amount_stocked' => strval($product['amount_stocked'] - $request->product_amount),
                'amount_in_markets' => strval($product['amount_in_markets'] + $request->product_amount)
                    ]); //after the checks, now it updates the amount in stock and in markets to be according,
                        //only does that
                
                
                $total_price = $product->price * $request->product_amount;
                product_market_log::create(['produto_id' => $product['id'],
                    'market_id' => $market['id'], //saves the info ghatered to the product_market_log logs
                    'amount_requested' => $request->product_amount, //table
                    'amount_left' => $request->product_amount,
                    'amount_sold' => '0',
                    'total_price' => $total_price
                
                ]);
                
                

                return redirect()->route('order.create')->with(['status' => "Order Successfull"]);
                
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
