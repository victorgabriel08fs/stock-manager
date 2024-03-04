<!-- Modal -->
<div class="modal fade" id="{{ 'editModal' . $category->id }}" tabindex="-1"
    aria-labelledby="{{ 'editModalLabel' . $category->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ 'editModalLabel' . $category->id }}">Editar categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                            placeholder="Nome" value="{{ $category->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="description" id="exampleFormControlInput2"
                            placeholder="Descrição" value="{{ $category->description }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Ícone</label>
                        <input type="file" class="form-control" name="icon" id="exampleFormControlInput3"
                            placeholder="Ícone">

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
