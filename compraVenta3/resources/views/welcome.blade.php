<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Ventas</title>
</head>
<body>
    <h1>Listado de Ventas</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Producto</th>
                
                <th>Precio</th>
                <th>Miniatura</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->product }}</td>
                    <td>${{ number_format($sale->price, 2) }}</td>
                    <td>
                        @if ($sale->thumbnail)
                            dd($sale->thumbnail->route);
                            <img src="{{ asset('storage/' . $sale->thumbnail->route) }}" alt="Miniatura" width="100">
                        @else
                            Sin imagen
                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>
