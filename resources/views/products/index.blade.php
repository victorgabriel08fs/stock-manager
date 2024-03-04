@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="col">{{ __('Produtos') }}</span>
                    </div>

                    <div class="card-body">
                        <form id="form" class="d-flex align-items-end justify-content-between m-2 mb-4" method="post">
                            @csrf
                            @method('get')
                            <div class="d-flex flex-row gap-3 w-75">
                                <div class="col">
                                    <label for="name" class="form-label">Nome</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $request['name']) }}" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="category_id" class="form-label">Categoria</label>
                                    <select type="text" name="category_id" id="category_id"
                                        value="{{ $request['name'] }}" class="form-control">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            <option {{ $request['category_id'] == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="h-50 btn btn-primary"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                            <button type="button" onclick="limparInputsComClasse('form-control')"
                                class="h-50 btn btn-secondary"><i class="fa-solid fa-broom"></i></button>
                            <!-- Button trigger modal -->
                            <button type="button" class="h-50 btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#newModal">
                                Nova +
                            </button>
                        </form>
                        @include('products.new_modal')

                        @if (count($products) > 0)
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col">Quantidade</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ number_format($product->price, '2', ',', '.') }}</td>
                                            <td>{{ number_format($product->amount, '2', ',', '.') }}</td>
                                            <td class="w-25">
                                                <img src="{{ asset($product->photo ? 'storage/' . $product->photo : 'storage/assets/sem-imagem.png') }}"
                                                    class="rounded" style="width: 30%" alt="">
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="{{ '#editModal' . $product->id }}">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger rounded-end"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="{{ '#deleteModal' . $product->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    @include('products.delete_modal', [
                                                        'product' => $product,
                                                        'categories' => $categories,
                                                    ])
                                                    @include('products.edit_modal', [
                                                        'product' => $product,
                                                        'categories' => $categories,
                                                    ])
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                                {{ $products->links() }}
                            </nav>
                        @else
                            Nenhum registro encontrado
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
