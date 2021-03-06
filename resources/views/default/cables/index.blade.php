@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('vendor/bootstrap-notify-3.1.3/bootstrap-notify.js') }}"></script>
@endsection

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if(Session::has('message'))
        <script type='text/javascript'>
            $.notify({
                message: "{{Session::get('message')}}"
            }, {
                type: "danger"
            });
        </script>
        @endif

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <a class="btn button-without-style btn-sm" href="{{ route('home') }}" role="button" data-toggle="tooltip" data-placement="top" title="Retornar ao app">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="align-middle">&nbsp;&nbsp;Cabos</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('default.cables.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control panel-border" placeholder="Pesquise por nome">
                                    <div class="input-group-append">
                                        <button class="btn panel-border" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fas fa-search"></i></button>
                                        <a class="btn panel-border" href="{{ route('default.cables.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fas fa-undo-alt"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-right">
                        @can('create-cables')
                            <a class="btn btn-detail btn-sm" href="{{ route('default.cables.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="Criar um novo">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-borderless text-center" style="height: 100px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Cor</th>
                                    <th>Pontilhado</th>
                                    <th>Repetição</th>
                                    <th>Tamanho</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $data)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $data->id }}</td>
                                    <td class="align-middle">{{ $data->name }}</td>
                                    <td class="align-middle"><span style="color: {{ $data->color }};"><i class="fas fa-square fa-lg"></i></span> <span class="text-uppercase"></span></td>
                                    <td class="align-middle">
                                        @if($data->dotted === 1)
                                        <i class="fas text-success fa-check fa-lg"></i>
                                        @else
                                        <i class="fas text-danger fa-times fa-lg"></i>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if($data->dotted_repeat === null)
                                        <i class="fas text-danger fa-times fa-lg"></i>
                                        @else
                                        {{ $data->dotted_repeat }}
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $data->size }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                        @can('update-cables')
                                            <a href="{{ route('default.cables.edit', $data->id) }}"><button type="button" class="button-without-style mr-1" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas text-dark fa-edit fa-lg"></i></button></a>
                                        @endcan
                                        @can('delete-cables')
                                        <form class="form_d" action="{{ route('default.cables.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="button-without-style ml-1 testec" this-cable-id="{{ $data->id }}" data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas text-dark fa-trash fa-lg"></i></button>
                                        </form>
                                        @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                                {{ $response->onEachSide(1)->links() }}
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="align-middle">Mostrando {{ $response->count() }} de {{ $response->total() }} resultados</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('extra-scripts')
<script type='text/javascript'>
    $('.testec').on('click', function(e) {
        if(!confirm("Deseja mesmo deletar?"))
        {
            return false;
        }
    });
</script>
@endsection