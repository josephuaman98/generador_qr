@extends('plantilla.layouts.panel')

@section('panel_blanco')
<div class="app-content content ">
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">QR Generados</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('generador.index') }}">QR</a></li>
                                <li class="breadcrumb-item active">Lista</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Listado de QR</h4>
                        <a class="btn btn-primary" href="{{ route('generador.create') }}">Nuevo QR</a>
                    </div>
                    <div class="card-body">
                        <form id="searchForm">
                            <div class="row mb-3">
                                <div class="col-md-1">
                                    <select name="perPage" id="perPage-select" class="form-control">
                                        <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                        <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                    </select>
                                </div>
                                <div class="col-md-4 ms-auto">
                                    <input type="text" id="search-input" name="search" class="form-control" placeholder="Buscar por descripción o link">
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>QR</th>
                                    <th>LINK</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>USUARIO</th>
                                    <th>ESTADO</th>
                                    <th>FECHA</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="table-container">
                                @include('generador.index_table', [
                                    'qrs' => $paginatedItems
                                ])
                            </tbody>
                        </table>
                    </div>

                        <div id="pagination-links" class="mt-2">
                            {{ $paginatedItems->links() }}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
    // Establecer valor inicial del select
    $('#perPage-select').val('{{ $perPage }}');

    function fetchGeneradores(page = 1) {
        const params = {
            search: $('#search-input').val(),
            perPage: $('#perPage-select').val(),
            sort: '{{ $sort }}',
            direction: '{{ $direction }}',
            page: page
        };

        $.ajax({
            url: '{{ route('generador.index') }}',
            type: 'GET',
            data: params,
            success: function(response) {
                $('#table-container').html(response.html);
                $('#pagination-links').html(response.pagination);
                // Mantener selección en el select
                $('#perPage-select').val(params.perPage);
                // Actualizar URL en el navegador
                updateUrl(params);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    function updateUrl(params) {
        let url = new URL(window.location.href);
        Object.keys(params).forEach(key => {
            if (params[key]) {
                url.searchParams.set(key, params[key]);
            } else {
                url.searchParams.delete(key);
            }
        });
        window.history.pushState({}, '', url);
    }

    // Evento de búsqueda
    $('#search-input').on('keyup', _.debounce(function() {
        fetchGeneradores(1); // Resetear a página 1 al buscar
    }, 300));

    // Evento de cambio en items por página
    $('#perPage-select').on('change', function() {
        fetchGeneradores(1); // Resetear a página 1 al cambiar
    });

    // Evento de paginación
    $(document).on('click', '#pagination-links a', function(e) {
        e.preventDefault();
        const url = new URL($(this).attr('href'));
        const page = url.searchParams.get('page');
        fetchGeneradores(page);
    });
});
</script>
@endsection
