@extends('layouts.dashboard')

@section('title', config('app.name') . ' :: Categorías')
@section('description', 'Administrador de Categorías')

@section('content')
<div class="container">
    <div class="row py-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-left mb-3">
                        <h1>Categorías</h1>
                    </div>

                    <a role="button" class="btn btn-dark" href="javascript:void(0);" id="btnAddCategory">
                        <i class="bi bi-plus-circle me-1"></i> Nuevo
                    </a>

                    <a role="button" class="btn btn-dark" href="javascript:void(0);" id="btnRefresh">
                        <i class="bi bi-arrow-clockwise me-1"></i> Refrescar
                    </a>

                    <hr />

                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Descripción</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('categories.form')
@include('categories.deleteform')

@endsection

@section('js')
<script type="text/javascript">
jQuery(document).ready(function ($) {

    const table = $('#table').DataTable({
        language: {
            sProcessing:    'Procesando...',
            sLengthMenu:    'Mostrar _MENU_ registros',
            sZeroRecords:   'No se encontraron resultados',
            sEmptyTable:    'Sin categorías registradas',
            sInfo:          'Mostrando registros del _START_ al _END_ de _TOTAL_',
            sInfoEmpty:     'Mostrando 0 registros',
            sInfoFiltered:  '(filtrado de _MAX_ registros)',
            sSearch:        'Buscar:',
            sLoadingRecords: 'Cargando...',
            oPaginate: {
                sFirst:    'Primero',
                sLast:     'Último',
                sNext:     'Siguiente',
                sPrevious: 'Anterior',
            },
        },
        processing: true,
        serverSide: true,
        ajax: { url: '{{ route('categories.index') }}' },
        columns: [
            { data: 'name',       name: 'name' },
            { data: 'image', name: 'image' },
            { data: 'description', name: 'description' },
            { data: 'action',     name: 'action', orderable: false, searchable: false, className: 'text-center' },
        ],
    });

    // Abrir modal nueva categoría
    $(document).on('click', '#btnAddCategory', function () {
        $('#updateForm')[0].reset();
        $('#id').val('');
        new bootstrap.Modal(document.getElementById('formModal')).show();
    });

    // Actualizar tabla
    $(document).on('click', '#btnRefresh', function () {
        table.ajax.reload();
    });

    // Abrir modal editar
    $(document).on('click', '#btnUpdate', function (e) {
        e.preventDefault();
        $('#updateForm')[0].reset();

        $.ajax({
            type: 'GET',
            url: $(this).attr('href'),
            dataType: 'json',
            success: function (data) {
                $.each(data, function (key, val) {
                    $('#' + key).val(val);
                });
                new bootstrap.Modal(document.getElementById('formModal')).show();
            },
        });

        return false;
    });

    // Abrir modal borrar
    $(document).on('click', '#btnDelete', function (e) {
        e.preventDefault();
        $('#row_name').text($(this).attr('data-name'));
        $('#deleteForm').attr('action', $(this).attr('href'));
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });

    // Submit guardar
    $(document).on('submit', '#updateForm', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '{{ route('categories.store') }}',
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                if (data.type === 'error') {
                    var errors = Object.values(data.errors || {}).flat().join('\n');
                    $.notify(data.message + '\n' + errors, data.type);
                    return;
                }

                $('#updateForm')[0].reset();
                bootstrap.Modal.getInstance(document.getElementById('formModal')).hide();
                table.ajax.reload();
                $.notify(data.message, data.type);
            },
            error: function () {
                $.notify('Hubo un error al intentar guardar el registro.', 'error');
            },
        });

        return false;
    });

    // Submit borrar
    $(document).on('submit', '#deleteForm', function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: $(this).serialize(),
            success: function (data) {
                if (data.type === 'error') {
                    $.notify(data.message, data.type);
                    return;
                }

                $('#deleteForm')[0].reset();
                bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                table.ajax.reload();
                $.notify(data.message, data.type);
            },
            error: function () {
                $.notify('Hubo un error al intentar borrar el registro.', 'error');
            },
        });

        return false;
    });

});
</script>
@endsection
