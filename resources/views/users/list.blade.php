@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row-justify-content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{__("Lista de Usuários")}}</div>

                <div class="card-body">
                    <table id="main-table" class="table table-striped table-bordered">
                        <thead>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Saldo</th>
                            <th>Ações</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th>{{$user->name}}</th>
                                <th>{{$user->cpf}}</th>
                                <th>{{$user->bank_balance}}</th>
                                <th class="row justify-content-around">

                                    <form action="{{route('users.edit', $user->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-warning btn-sm">
                                            <i class="far fa-edit"></i>
                                            {{__('Editar')}}
                                        </button>
                                    </form>



                                    <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE')}}
                                        <button class="btn btn-danger btn-sm">
                                            <i class="far fa-trash-alt"></i>
                                            {{__('Deletar')}}
                                        </button>
                                    </form>

                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection