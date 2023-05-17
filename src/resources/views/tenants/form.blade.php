<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="company" class="form-control" placeholder="Nome" value="{{ $tenant->company ?? old('company') }}">
</div>
<div class="form-group">
    <label>CNPJ:</label>
    <input type="text" name="cnpj" class="form-control" placeholder="CNPJ" value="{{ $tenant->cnpj ?? old('cnpj') }}">
</div>
<div class="form-group">
    <label>Email:</label>
    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $tenant->email ?? old('email') }}">
</div>

@if(isset($tenant))
    <div class="form-group">
        <label>Logo:</label>
        <input type="file" name="logo" class="form-control">
    </div>
@endif


@if(isset($tenant->logo))
    <div class="form-group">
        <img src="{{ $tenant->logo }}" alt="{{ $tenant->company }}" style="max-width: 90px;">
    </div>
@endif

<div class="form-group">
    <button type="submit" class="btn btn-dark">Gravar</button>
</div>