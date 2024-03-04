<!-- Modal -->
<div class="modal fade" id="{{ 'editModal' . $product->id }}" tabindex="-1"
    aria-labelledby="{{ 'editModalLabel' . $product->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ 'editModalLabel' . $product->id }}">Editar produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                            placeholder="Nome" value="{{ $product->name }}">
                    </div>
                    <div class="mb-3 gap-3 d-flex flex-row">
                        <div class="col">
                            <label for="price" class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-control" name="price" id="price"
                            placeholder="Preço" value="{{ $product->price }}">
                        </div>
                        <div class="col">
                            <label for="amount" class="form-label">Quantidade</label>
                        <input type="number" step="0.01" class="form-control" name="amount" id="amount"
                            placeholder="Quantidade" value="{{ $product->amount }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto</label>
                        <input type="file" class="form-control" name="photo" id="photo"
                            placeholder="Foto">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
    </div>
    </form>
</div>
