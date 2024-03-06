@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="col">{{ __('Venda #') . $sale->id }}</span>
                    </div>

                    <div class="card-body">
                        <div class="overflow-auto">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Produto</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <form action="{{ route('sales.update', $sale->id) }}" method="post">
                                            @method('patch')
                                            @csrf
                                            <th scope="row"></th>
                                            <td class="w-50"><select name="product_id" id="product_id"
                                                    class="form-control">
                                                    <option value="">Selecione um produto</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select></td>
                                            <td><input type="number" step="0.01" min="1" value="1"
                                                    name="product_amount" class="form-control"></td>
                                            <td></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-success"><i
                                                            class="fas fa-plus"></i></button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    @foreach ($sale->products as $product)
                                        <tr>
                                            <form action="{{ route('sales.removeItem', [$product->id, $sale->id]) }}"
                                                method="post">
                                                @method('delete')
                                                @csrf
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td class="w-50">{{ $product->name }}</td>
                                                <td class="w-25">
                                                    {{ number_format($product->pivot->product_amount, '2', ',', '.') }}</td>
                                                <td>{{ number_format($product->price * $product->pivot->product_amount, '2', ',', '.') }}
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fas fa-trash"></i></button>
                                                    </div>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th colspan="2" scope="row">Total</th>
                                        <td>{{ number_format($sale->total_amount, '2', ',', '.') }}</td>
                                        <td>{{ number_format($sale->total_value, '2', ',', '.') }}</td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end gap-3">
                        @if ($sale->status == 'PENDING')
                            @if ($sale->products()->count() == 0)
                                <form action="{{ route('sales.destroy', $sale->id) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="{{ '#deleteModal' . $sale->id }}">
                                        Excluir <i class="fas ps-2 fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('sales.changeStatus', [$sale->id, 'CANCELED']) }}" method="post">
                                    @method('post')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="{{ '#deleteModal' . $sale->id }}">
                                        Cancelar <i class="fas ps-2 fa-cancel"></i>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('sales.changeStatus', [$sale->id, 'FINISHED']) }}" method="post">
                                @method('post')
                                @csrf
                                <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="{{ '#deleteModal' . $sale->id }}">
                                    Finalizar <i class="ps-2 fas fa-check"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
