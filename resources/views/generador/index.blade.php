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
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
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
    function fetchGeneradores(search, page, perPage, sort, direction) {
        $.ajax({
            url: '{{ route('generador.index') }}',
            method: 'GET',
            data: { search, page, perPage, sort, direction },
            success: function(data) {
                $('#table-container').html(data.html);
                $('#pagination-links').html(data.pagination);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    $(document).ready(function() {
        const sort = '{{ $sort }}';
        const direction = '{{ $direction }}';

        $('#search-input').on('keyup', _.debounce(function() {
            fetchGeneradores(this.value, null, $('#perPage-select').val(), sort, direction);
        }, 300));

        $('#perPage-select').on('change', function() {
            fetchGeneradores($('#search-input').val(), null, $(this).val(), sort, direction);
        });

        $(document).on('click', '#pagination-links a', function(e) {
            e.preventDefault();
            const page = $(this).attr('href').split('page=')[1];
            fetchGeneradores($('#search-input').val(), page, $('#perPage-select').val(), sort, direction);
        });
    });
</script>
@endsection
