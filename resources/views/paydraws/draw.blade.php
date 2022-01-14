<form action="{{route('paydraws.store')}}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Valor') }}</label>

        <div class="col-md-6">
            <input id="value" type="text" class="form-control @error('value') is-invalid @enderror" name="value"
                required autocomplete="name" autofocus>
        </div>
    </div>
    <div class="row-mb-0">
        <button type="submit" class="btn btn-sm btn-success">Realizar Transação</button>
    </div>
</form>

<script src="{{ asset('js/jquery.maskMoney.js') }}"></script>
<script>
    $(document).ready(function () {
        $("#value").mask("000000000,00R$", {reverse: true});
    });
</script>
