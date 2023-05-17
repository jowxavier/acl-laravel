<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $product->name ?? old('name') }}">
</div>
<div class="form-group">
    <label>Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço" value="{{ $product->price ?? old('price') }}">
</div>
<div class="form-group">
    <label>Imagem:</label>
    <input type="file" name="path" class="form-control">
</div>
<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" class="form-control" rows="3" placeholder="Digite uma Descrição">{{ $product->description ?? old('description') }}</textarea>
</div>

@if(isset($product->path))
    <div class="form-group">
        <img src="{{ $product->path }}" alt="{{ $product->name }}" style="max-width: 90px;">
    </div>
@endif

<div class="form-group">
    <button type="submit" class="btn btn-dark">Gravar</button>
</div>