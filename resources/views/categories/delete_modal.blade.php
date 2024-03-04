<!-- Modal -->
<div class="modal fade" id="{{ 'deleteModal' . $category->id }}" tabindex="-1"
    aria-labelledby="{{ 'deleteModalLabel' . $category->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('categories.destroy', $category->id) }}" method="post" enctype="multipart/form-data">
            @method('delete')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ 'deleteModalLabel' . $category->id }}">Atenção</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p>Deseja apagar este registro?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </div>
    </div>
    </form>
</div>
