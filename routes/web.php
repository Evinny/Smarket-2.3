<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Marketscontroller;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProvidersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('site.home');




##================================================================##
Route::get('/products', [ProductsController::class, 'home'
])->name('site.products'); //só retorna a view da
//pagina inicial dos produtos



Route::get('/products/record', [ProductsController::class, 'create'
])->name('site.products.record.form'); 
//mostra o formulario para salvar produtos nos arquivos




route::post('/products/record', [ProductsController::class, 'store'
])->name('site.products.record');
//recebe um array com os atributos da tablea produtos, e salva elas seguindo o validate
//retorna apenas um msg dizendo q deu certo



route::get('/products/list{error?}', [ProductsController::class, 'index'
])->name('site.products.list');
//recebe uma string e procura em todas as tabelas de produtos se tem aquela string, e retorna tudo q achar
//nota: se ele precisa de uma variavel chamada $search, e se tiver em null, retorna tudo, e é paginado

route::post('/products/list', [ProductsController::class, 'index'
])->name('site.products.list');
//serve para mandar a variavel $search para o controlador list retornar a collecion com as devidas informaçoes



route::get('/products/edit/{id}', [ProductsController::class, 'edit'
])->name('site.products.edit.form');
//mostra o formulario para editar produtos, junto ao irl tem o id do produto a editar, que o controlador
//busca na hora e retorna os valores pra view 'product_edit_form' para o usuario visualizar oq esta editando


route::put('/products/edit{id}', [ProductsController::class, 'update'
])->name('site.products.edit');
//valida os dados enviados para edição do produto, recebendo o id do produto e todos os dados e as
//atualiza retornando a view 'product_list_main'



route::get('/products/remove/{id}', [ProductsController::class, 'destroy_confirmation'
])->name('site.products.remove.form');
//recebe o id do produto escolhido pra remoção, e mostra uma view com os dados do produto escolhido
//perguntando se realmente quer apagar, se sim, passa pra rota pra apagar de vez


route::post('/products/remove', [ProductsController::class, 'destroy'
])->name('site.products.remove');
//se essa rota for acessada diretamente se o id do produto for enviado com o nome de 'product_id'
//e com esse id, o apaga do banco


route::get('/products/list/remove', [ProductsController::class, 'mass_destroy'
])->name('site.products.mass.remove');


route::post('/products/list/remove', [ProductsController::class, 'mass_destroy'
])->name('site.products.mass.remove');


route::get('/products/show/{product}', [ProductsController::class, 'show'
])->name('site.products.show');

##================================================================##

##================================================================##
route::get('/markets', [MarketsController::class, 'home'
])->name('site.markets');
//só retorna a view da pagina inicial dos mercados




Route::get('/markets/insert', [MarketsController::class, 'create'
])->name('site.markets.insert.form'); 


route::post('/markets/insert', [MarketsController::class, 'store'
])->name('site.markets.insert');
//recebe um array com os atributos da tabela markets, e salva elas seguindo o validate
//retorna apenas um msg dizendo q deu certo



route::get('/markets/list', [MarketsController::class, 'index'
])->name('site.markets.list');
//recebe uma string e procura em todas as tabelas de markets se tem aquela string, e retorna tudo q achar
//nota: se ele precisa de uma variavel chamada $search, e se tiver em null, retorna tudo, e é paginado


route::post('/markets/list', [MarketsController::class, 'index'
])->name('site.markets.list');
//serve para mandar a variavel $search para o controlador list retornar a collecion com as devidas informaçoes



route::get('/markets/edit/{id}', [MarketsController::class, 'edit'
])->name('site.markets.edit.form');
//mostra o formulario para editar os mercados, junto ao irl tem o id do mercado a editar, que o controlador
//busca na hora e retorna os valores pra view 'markets.market_edit_form' para o usuario visualizar oq esta editando


route::put('/markets/edit{id}', [MarketsController::class, 'update'
])->name('site.markets.edit');
//valida os dados enviados para edição do mercado, recebendo o id do mercado e todos os dados e as
//atualiza retornando a view 'markets.market_list_main'



route::get('/markets/remove/{id}', [MarketsController::class, 'destroy_confirmation'
])->name('site.markets.remove.form');
//recebe o id do mercado escolhido pra remoção, e mostra uma view com os dados do mercado escolhido
//perguntando se realmente quer apagar, se sim, passa pra rota de apagar de vez


route::post('/markets/remove', [MarketsController::class, 'destroy'
])->name('site.markets.remove');
//se essa rota for acessada diretamente se o id do mercado for enviado com o nome de 'market_id'
//e com esse id, o apaga do banco


route::get('/markets/list/remove', [MarketsController::class, 'mass_destroy'
])->name('site.markets.mass.remove');


route::post('/markets/list/remove', [MarketsController::class, 'mass_destroy'
])->name('site.markets.mass.remove');


route::get('/markets/list/{id}', [MarketsController::class, 'show'
])->name('site.markets.show');


route::get('/markets/list/search', [MarketsController::class, 'show'
]);

##================================================================##
##============================ORDERS==============================##
##================================================================##

route::resource('/order', OrderController::class);



route::resource('/provider', ProvidersController::class);

