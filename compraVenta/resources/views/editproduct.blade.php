<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
        }

        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 94%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<div class="form-container">
    <h2>Editar Producto</h2>
    <form action="{{ route('sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="{{ $sale->product }}" required>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="4" required>{{ $sale->description }}</textarea>

        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio" step="0.01" value="{{ $sale->price }}" required>

        <label for="categoria">Categoria</label>
        <select id="categoria" name="categoria" class="categories" required>
            <option value="">Selecciona una categoría</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $sale->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit">Actualizar Producto</button>
    </form>
</div>