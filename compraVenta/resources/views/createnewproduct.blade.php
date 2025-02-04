<!-- FILE: compraVenta3/resources/views/index.blade.php -->

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
        .form-container textarea {
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

        .form-container .img-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-container .img-container img {
            border-radius: 4px;
            padding: 1px;
            width: 30%;
            height: 30%;
        }

        textarea {
            resize: unset;
        }

        .categories {
            margin-bottom: 10px;
            width: 100%;
        }
</style>

<body>
    @if (Auth::user()->email_verified_at) 
        <div class="form-container">
            <h2>Crear Producto</h2>
            <form action="{{ route('sales.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
    
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
    
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" step="0.01" required>
    
                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria" class="categories" required>
                    <option value="">Selecciona una categoría</option>
                    @php
                        $categories = App\Models\Category::all();
                    @endphp
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
    
                <label for="imagenes">Imágenes</label>
                <input type="file" id="imagenes" name="imagenes[]" multiple required>
                <div class="img-container"></div>
                <button type="submit">Crear Producto</button>
            </form>
            <script>
                // cuando se suba una imagen, añadirlo al container de imagenes
                document.getElementById('imagenes').addEventListener('change', function (e) {
                    const container = document.querySelector('.img-container');
                    container.innerHTML = '';
                    for (let i = 0; i < e.target.files.length; i++) {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(e.target.files[i]);
                        container.appendChild(img);
                    }
                });
            </script>
        </div>
    @else
        <p>Debes verificar tu email para poder publicar productos</p>
    @endif

</body>

</html>