@extends('layouts.app')

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <a class="btn button-without-style btn-sm" href="{{ route('home') }}" role="button" data-toggle="tooltip" data-placement="top" title="Retornar ao app">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="align-middle">&nbsp;&nbsp;Processo estágio - 5</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('default.process_stage_five.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control panel-border" placeholder="Pesquise por cliente, usuário, técnico, cidade ou data (AAAA-MM-DD)">
                                    <div class="input-group-append">
                                        <button class="btn panel-border" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fas fa-search"></i></button>
                                        <a class="btn panel-border" href="{{ route('default.process_stage_five.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fas fa-undo-alt"></i></a>
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
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-borderless text-center" style="height: 100px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Ícone</th>
                                    <th>Cidade</th>
                                    <th>Técnico resp.</th>
                                    <th>Iniciado por</th>
                                    <th>Iniciado em</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $data)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $data->id }}</td>
                                    <td class="align-middle">{{ $customer->find($data->customers_id)->name }} {{ $customer->find($data->customers_id)->surname }}</td>
                                    <td class="align-middle"><i class="{{ $customer->find($data->customers_id)->m_icon }} fa-lg"></i></td>
                                    <td class="align-middle">{{ $city->find($address->find($data->customers_id)->cities_id)->name }}</td>
                                    <td class="align-middle">{{ $user->find($data->responsible_id)->name }}</td>
                                    <td class="align-middle">{{ $user->find($data->users_id)->name }}</td>
                                    <td class="align-middle">{{ $data->created_at }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                            @can('update-process-stage-five')
                                                <a href="{{ route('default.process.previous_stage', $data->id) }}"><button type="button" class="button-without-style mr-1"><i class="fas text-danger fa-arrow-left fa-lg"></i></button></a>
                                                <a href="{{ route('default.process_stage_five.edit', $data->id) }}"><button type="button" class="button-without-style mr-1"><i class="fas text-success fa-check fa-lg"></i></button></a>
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
                        <span class="align-middle">{{ __('Showing') }} {{ $response->count() }} {{ __('of') }} {{ $response->total() }} {{ __('results') }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection