@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="panel-panel-default">
                        <div class="panel-heading ml-2 mb-2">Gráficos</div>
                        <div id="canvas_container" class="row">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagescript')
<script>
    var user_id = "{{Auth::user()->id}}"
    var url = "{{route('paydraws.chart', ":user_id")}}";
    url = url.replace(':user_id', user_id);
    $(document).ready(function() {
        $.get(url, function(response) {
            console.log(Object.keys(response));
            for(const [key, value] of Object.entries(response)){
                jQuery('<div>', {
                    id: `canva-container_${key}`,
                    class: 'canva-container'
                }).appendTo('#canvas_container');

                jQuery('<canvas>', {
                    id: `canvas_${key}`,
                    title: `${key}`,
                }).appendTo(`#canva-container_${key}`);

                var ano = key;
                var saque = value[0][0];
                var deposito = value[1][0];

                var ctx = document.getElementById(`canvas_${key}`).getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                            'Saque',
                            'Depósito'
                        ],
                        datasets: [{
                            data: [saque, deposito],
                            backgroundColor: [
                            '#FF6550',
                            '#7386D5',
                            ],
                            hoverOffset: 4
                        }],
                    },
                    options:{
                        plugins: {
                            title: {
                                display: true,
                                text: `${ano}`
                            }
                        }
                    }
                });
            }
        });
    });

</script>
@endsection

<style>
    #canvas_container {
        display: grid;
        grid-template-rows: 1fr 1fr;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px;
    }

    .canva-container {
        display: flex;
    }
</style>
