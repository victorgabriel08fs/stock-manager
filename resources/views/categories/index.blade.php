@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="col">{{ __('Categorias') }}</span>
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-end m-2">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newModal">
                                Nova +
                            </button>
                            @include('categories.new_modal')
                        </div>

                        @if (count($categories) > 0)
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Ícone</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $category->id }}</th>
                                            <td>{{ $category->name }}</td>
                                            <td class="w-50">{{ $category->description }}</td>
                                            <td>
                                                <img src="{{ asset($category->icon?'storage/' . $category->icon:'storage/assets/doar.png') }}" class="rounded"
                                                    style="width: 30%" alt="">
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="{{ '#editModal' . $category->id }}">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger rounded-end"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="{{ '#deleteModal' . $category->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                    @include('categories.delete_modal', [
                                                        'category' => $category,
                                                    ])
                                                    @include('categories.edit_modal', [
                                                        'category' => $category,
                                                    ])
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                                {{ $categories->links() }}
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
