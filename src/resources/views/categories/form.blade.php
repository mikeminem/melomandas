{{-- Modal Form --}}
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Datos de la Categoría</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-12">
                            <label for="name" class="form-label fw-bold">Nombre <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required maxlength="120">
                        </div>

                        <div class="col-md-3">
                            <label for="age_initial" class="form-label fw-bold">Edad inicial</label>
                            <input type="number" class="form-control" id="age_initial" name="age_initial" min="1"
                                max="99">
                        </div>

                        <div class="col-md-3">
                            <label for="age_final" class="form-label fw-bold">Edad final</label>
                            <input type="number" class="form-control" id="age_final" name="age_final" min="1" max="99">
                        </div>

                        <div class="col-md-12">
                            <label for="overview" class="form-label fw-bold">Descripción</label>
                            <input type="text" class="form-control" id="overview" name="overview" maxlength="255">
                        </div>

                    </div>

                    <p class="text-muted small mt-3 mb-0">* Campos obligatorios</p>
                    <input type="hidden" id="id" name="id">
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-save me-1"></i> Guardar
                    </button>
                    <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Form --}}
