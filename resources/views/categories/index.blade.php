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
                        <form id="form" class="d-flex align-items-end justify-content-between m-2 mb-4" method="post">
                            @csrf
                            @method('get')
                            <div class="form w-75">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $request['name']) }}" class="form-control">
                            </div>
                            <button type="submit" class="h-50 btn btn-primary"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                            <button type="button" onclick="limparInput('name')" class="h-50 btn btn-secondary"><i
                                    class="fa-solid fa-broom"></i></button>
                            <!-- Button trigger modal -->
                            <button type="button" class="h-50 btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#newModal">
                                Nova +
                            </button>
                        </form>
                        @include('categories.new_modal')

                        @if (count($categories) > 0)
                            <div class="overflow-auto">
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
                                                    <img src="{{ asset($category->icon ? 'storage/' . $category->icon : 'storage/assets/sem-imagem.png') }}"
                                                        class="rounded" style="width: 30%" alt="">
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
                            </div>
                        @else
                            Nenhum registro encontrado
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function limparInput(idDoInput) {
            document.getElementById(idDoInput).value = '';
            document.getElementById('form').submit();
        }
    </script>
@endsection
