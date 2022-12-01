<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Provider;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function home(){
        return view('products.Products_main');
    }
    
     public function index(request $request){
        $list_data = Produto::orwhere('name', 'like', '%'.$request->input('search').'%' )
        ->orwhere('details', 'like', '%'.$request->input('search').'%' )
        ->orwhere('price', 'like', '%'.$request->input('search').'%' )
        ->orwhere('amount_stocked', 'like', '%'.$request->input('search').'%' )
        ->orwhere('amount_in_markets', 'like', '%'.$request->input('search').'%' )
        ->paginate(10);
        
        
        

        return view('products.product_list_main', ['Ldata' => $list_data, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $provider_names = Provider::all()->pluck('name', 'id');
        
        return view('products.product_insert_form', ['provider_names' => $provider_names]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        print_r($request->all());

        $motive = [

            'name' => 'required|min:3|max:50', 'details' => 'required|min:5|max:300',
            'price' => 'required|integer|min:1', 'amount_stocked' => 'required|integer|min:1',
            'provider_name' => 'required|exists:providers,name'
        ];

        $reason = [
            'name.required' => 'A product without a name, how so?',
            'price.required' => 'do you even know how sales works? give me a price',
            'amount_stocked.required' => "you want to sell something that you don't have? right...",
            'required' => ':attribute is a necessary input',
            'price.min' => 'the best price that i can do is 1$',
            'min' => ':attribute is too small',
            'max' => ':attribute is too much, make it less',
            'amount_stocked.min' => "you want to sell something that you don't have? right...",
            'provider_name.exists' => "that provider doesn't exist",
        ];
        
        $request->validate($motive, $reason);
        
        
        $provider = Provider::where('name', '=', $request->provider_name)->get();
        print_r($provider[0]['id']);
        $insert = Produto::create([
            'name' => $request->name, 'details' => $request->details,
            'price' => $request->price,
            'amount_stocked' => $request->amount_stocked,
            'amount_in_markets' => $request->amount_in_markets,
            'providers_id' => (int)$provider[0]['id']
        ]);

        return redirect()->route('site.products.record.form')->with(['status' => 'Record done Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $product_data = Produto::where('name', '=', $name)->get();
        
        $provider = Provider::find($product_data[0]->providers_id);
        dd($provider);

        return view('display this');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $single_user = Produto::find($id);

        return view('products.product_edit_form', ['current_data' => $single_user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        print_r($request->all());
        print_r($id);
        

        
        $motive = [

            'name' => 'required|min:3|max:50', 'details' => 'required|min:5|max:300',
            'price' => 'required|integer|min:1', 'amount_stocked' => 'required|integer|min:1'

        ];

        $reason = [
            'name.required' => 'A product without a name, how so?',
            'price.required' => 'do you even know how sales works? give me a price',
            'amount_stocked.required' => "you want to sell something that you don't have? right...",
            'required' => ':attribute is a necessary input',
            'price.min' => 'the best price that i can do is 1$',
            'min' => ':attribute is too small',
            'max' => ':attribute is too much, make it less',
            'amount_stocked.min' => "you want to sell something that you don't have? right...",
        ];
        
        $request->validate($motive, $reason);
        
        
        
        $record_update = Produto::find($id);
        $record_update->name = $request->name;
        $record_update->details = $request->details;
        $record_update->amount_stocked = $request->amount_stocked;
        $record_update->price = $request->price;
        $record_update->amount_in_markets = $request->amount_in_markets;
        $record_update->save();

        return redirect(route('site.products.list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request){
    
        
        $product_deletion = Produto::find($request->product_id)->delete();


        if(strpos(url()->previous(), '/products/list/remove')){
        
            return redirect()->back();
        }


        return redirect(route('site.products.list', ['msg' => 1,]));
    }

    public function destroy_confirmation($id){
        $record_removal = Produto::where('id', '=', $id)->get();
        
        $id = $record_removal->pluck('id');
        print_r($id[0]);
    
        return view('products.product_remove_form', ['Ldata' => $record_removal, 'id' => $id[0]]);
    }

    public function mass_destroy(request $request){
        $list_data = Produto::orwhere('name', 'like', '%'.$request->input('search').'%' )
        ->orwhere('details', 'like', '%'.$request->input('search').'%' )
        ->orwhere('price', 'like', '%'.$request->input('search').'%' )
        ->orwhere('amount_stocked', 'like', '%'.$request->input('search').'%' )
        ->orwhere('amount_in_markets', 'like', '%'.$request->input('search').'%' )
        ->paginate(10);
        
        return view('products.product_list_mass_remove', ['Ldata' => $list_data, 'request' => $request->all()]);
    }
}
