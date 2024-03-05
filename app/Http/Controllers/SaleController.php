<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Product;
use App\Models\ProductSale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sales = Sale::orderBy('updated_at', 'desc')->orderBy('created_at', 'desc')->orderBy('id', 'desc')->paginate(10);

        return view('sales.index', ['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('amount', '>', 0)->orderBy('name')->get();

        return view('sales.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request)
    {
        $data = $request->validated();

        $sale = Sale::create();
        $product = Product::find($data['product_id']);
        if ($product->amount > $data['product_amount'])
            ProductSale::create(['product_id' => $product->id, 'sale_id' => $sale->id, 'product_amount' => $request['product_amount']]);

        $products = $sale->products;
        $total_amount = 0;
        $total_value = 0;

        foreach ($products as $product) {
            $total_amount = $total_amount + $product->pivot->product_amount;
            $total_value = $total_value + ($product->pivot->product_amount * $product->price);
        }

        $sale->update(['total_amount' => $total_amount, 'total_value' => $total_value]);

        toastr()->success('Venda iniciada.', 'Sucesso');

        return redirect()->route('sales.edit', $sale->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('sales.show', ['sale' => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $products = Product::where('amount', '>', 0)->whereDoesntHave('sales', function ($query) use ($sale) {
            $query->where('sale_id', $sale->id);
        })->orderBy('name')->get();

        return view('sales.edit', ['sale' => $sale, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        $data = $request->validated();

        $product = Product::find($data['product_id']);
        if ($product->amount > $data['product_amount']) {
            ProductSale::create(['product_id' => $product->id, 'sale_id' => $sale->id, 'product_amount' => $request['product_amount']]);

            $products = $sale->products;
            $total_amount = 0;
            $total_value = 0;

            foreach ($products as $product) {
                $total_amount = $total_amount + $product->pivot->product_amount;
                $total_value = $total_value + ($product->pivot->product_amount * $product->price);
            }

            $sale->update(['total_amount' => $total_amount, 'total_value' => $total_value]);

            toastr()->info('Item adicionado.');
        } else
            toastr()->error('Não há itens suficientes no estoque.', 'Erro');

        return redirect()->route('sales.edit', $sale->id);
    }

    public function changeStatus(Sale $sale, $status)
    {
        if ($sale->status == "PENDING") {
            $can_changeStatus = false;
            foreach ($sale->products as $product) {
                $can_changeStatus = ($product->amount > $product->pivot->product_amount);
            }
            if ($can_changeStatus || $status == "CANCELED")
                $sale->update(['status' => $status]);
        }

        if ($status != $sale->status)
            toastr()->error('Não há itens suficientes no estoque.', 'Erro');
        else
            toastr()->success($sale->status == 'FINISHED' ? 'Venda concluída.' : 'Venda cancelada.', 'Sucesso');

        return redirect()->route('sales.index');
    }

    public function removeItem($product, $sale)
    {
        $item = ProductSale::where('product_id', $product)->where('sale_id', $sale)->get()->first();

        if (isset($item->id))
            $item->delete();

        toastr()->info('Item removido.');
        return redirect()->route('sales.edit', $sale);
    }
}
