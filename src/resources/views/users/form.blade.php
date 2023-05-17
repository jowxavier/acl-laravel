<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $user->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Email:</label>
    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email ?? old('email') }}">
</div>
@can('isManager')
    <div class="form-group">
        <label>Empresa:</label>
        <select name="tenant_id" class="form-control">
            @foreach($tenants as $tenant)
                <option {{ isset($user->tenant_id) && $user->tenant_id == $tenant->id ? 'selected' : '' }} value="{{ $tenant->id }}">{{ $tenant->company }}</option>
            @endforeach
        </select>
    </div>
@endcan
<div class="form-group">
    <label>Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha">
</div>
<div class="form-group">
    <label>Confirmar Senha:</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Senha">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Gravar</button>
</div>
