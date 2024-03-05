@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="col">{{ __('Vendas') }}</span>
                    </div>

                    <div class="card-body">
                        <div class="d-flex align-items-end justify-content-end m-2 mb-4">
                            <!-- Button trigger modal -->
                            <a href="{{ route('sales.create') }}" class="h-50 btn btn-success">
                                Nova +
                            </a>
                        </div>

                        @if (count($sales) > 0)
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Preço total</th>
                                        <th scope="col">Quantidade de items</th>
                                        <th scope="col">Criado em</th>
                                        <th scope="col">Atualizado em</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <th scope="row">{{ $sale->id }}</th>
                                            <td>{{ number_format($sale->total_value, '2', ',', '.') }}</td>
                                            <td>{{ number_format($sale->total_amount, '2', ',', '.') }}</td>
                                            <td>{{ $sale->created_at->format('d/m/y H:i:s') }}</td>
                                            <td>{{ $sale->updated_at->format('d/m/y H:i:s') }}</td>
                                            @switch($sale->status)
                                                @case('FINISHED')
                                                    <td class="opacity-75 bg-success">
                                                        <p class="fw-bold text-light">Concluída</p>
                                                    </td>
                                                @break

                                                @case('CANCELED')
                                                    <td class="opacity-75 bg-danger">
                                                        <p class="fw-bold text-light">Cancelada</p>
                                                    </td>
                                                @break

                                                @default
                                                    <td class="opacity-75 bg-warning">
                                                        <p class="fw-bold text-light">Pendente</p>
                                                    </td>
                                                @break
                                            @endswitch
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    @if ($sale->status == 'PENDING')
                                                        <a href="{{ route('sales.edit', $sale->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-pen"></i></a>
                                                        <form
                                                            action="{{ route('sales.changeStatus', [$sale->id, 'FINISHED']) }}"
                                                            method="post">
                                                            @method('post')
                                                            @csrf
                                                            <button type="submit" class="btn btn-success rounded-0"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="{{ '#deleteModal' . $sale->id }}">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                        <form
                                                            action="{{ route('sales.changeStatus', [$sale->id, 'CANCELED']) }}"
                                                            method="post">
                                                            @method('post')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger rounded-end"
                                                                style="border-radius: 0" data-bs-toggle="modal"
                                                                data-bs-target="{{ '#deleteModal' . $sale->id }}">
                                                                <i class="fas fa-cancel"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a disabled href="{{ route('sales.show', $sale->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                    @endif

                                                    {{-- @include('sales.delete_modal', [
                                                        'sales' => $sales,
                                                    ]) --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                                {{ $sales->links() }}
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
