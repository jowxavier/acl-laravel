<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $role->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" class="form-control" rows="3" placeholder="Digite uma Descrição">{{ $role->description ?? old('description') }}</textarea>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Gravar</button>
</div>