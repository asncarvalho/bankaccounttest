@extends('layouts.app')
@php
$result = App\Models\Paydraw::select(DB::raw('YEAR(created_at) as year'))->distinct()->get();
$years = $result->pluck('year');
@endphp

@section('content')
<div class="container">
    <div class="row-justify-content">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{__("Extrato")}}</h3>
                </div>

                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success">{{session('status')}}</div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-inline d-flex justify-content-start mb-2">
                        <div class="form-group row ml-1">
                            <label for="month">{{__('Mês: ')}}</label>
                            <select name="month" id="month" class="form-control ml-2">
                                <option value="00">{{__('Todos')}}</option>
                                <option value="01">{{__('Janeiro')}}</option>
                                <option value="02">{{__('Fevereiro')}}</option>
                                <option value="03">{{__('Março')}}</option>
                                <option value="04">{{__('Abril')}}</option>
                                <option value="05">{{__('Maio')}}</option>
                                <option value="06">{{__('Junho')}}</option>
                                <option value="07">{{__('Julho')}}</option>
                                <option value="08">{{__('Agosto')}}</option>
                                <option value="09">{{__('Setembro')}}</option>
                                <option value="10">{{__('Outubro')}}</option>
                                <option value="11">{{__('Novembro')}}</option>
                                <option value="12">{{__('Dezembro')}}</option>
                            </select>
                        </div>
                        <div class="form-group row ml-5">
                            <label for="year">{{__('Ano: ')}}</label>
                            <select name="year" id="year" class="form-control ml-2">
                                <option value="0">{{__('Todos')}}</option>
                                @foreach ($years as $year)
                                <option value="{{$year}}">{{$year}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ml-5">
                            <button type="button" class="btn btn-success btn-sm form-control" id="btn-search">
                                <i class="fas fa-search">{{__('Pesquisar')}}</i>
                            </button>
                        </div>
                    </div>
                    <table id="main-table" class="table table-striped table-bordered">
                        <thead>
                            <th>ID da Transação</th>
                            <th>Tipo</th>
                            <th>Data</th>
                        </thead>
                        <tbody>
                            @foreach ($paydraws as $paydraw)
                            <tr>
                                <th>{{$paydraw->id}}</th>
                                <th>{{($paydraw->getType->description)}}</th>
                                <th>{{$paydraw->created_at}}</th>
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

@section('pagescript')
<script>
    jQuery.extend( jQuery.fn.dataTableExt.oSort, {
    "date-us-pre": function ( a ) {
        var x;

        if ( $.trim(a) !== '' ) {
            var frDatea = $.trim(a).split(' ');
            var frTimea = (undefined != frDatea[1]) ? frDatea[1].split(':') : [00,00,00];
            var frDatea2 = frDatea[0].split('/');
            x = (frDatea2[2] + frDatea2[0] + frDatea2[1] + frTimea[0] + frTimea[1] + frTimea[2]) * 1;
        }
        else {
            x = Infinity;
        }

        return x;
    },

    "date-us-asc": function ( a, b ) {
        return a - b;
    },

    "date-us-desc": function ( a, b ) {
        return b - a;
    }
    } );

    $(document).ready(function () {
        var mainTable = $('#main-table').dataTable( {
            columnDefs: [
                { type: 'date-us', targets: 0 }
            ]
        } );

        $("#btn-search").click(function() {
            var month = $('#month').val();
            var year = $('#year').val();
            if (month == 00) {
                month = '';
            }
            if (year == 00) {
                year = '';
            }

            mainTable
                .api()
                .search(`${year}-${month}`).draw();
        });
    });

</script>
@endsection
