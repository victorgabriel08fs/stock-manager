<!-- Modal -->
<div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newModalLabel">Nova categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="name" id="exampleFormControlInput1"
                            placeholder="Nome">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="description" id="exampleFormControlInput2"
                            placeholder="Descrição">
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
