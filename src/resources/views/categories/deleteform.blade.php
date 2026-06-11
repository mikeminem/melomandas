{{-- Modal Delete --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Borrar Registro</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteForm">
                @method('DELETE')
                <div class="modal-body">
                    <h4>Deseas borrar la categoría <mark><span id="row_name"></span></mark>?</h4>
                </div>
                {{ csrf_field() }}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-lg">
                        <i class="bi bi-trash me-1"></i> Borrar
                    </button>
                    <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
