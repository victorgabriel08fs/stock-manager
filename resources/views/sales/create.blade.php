@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="col">{{ __('Nova venda') }}</span>
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
                                        <form action="{{ route('sales.store') }}" method="post">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
