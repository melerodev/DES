<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <button id="fetch">fetch</button>
    <script>
        const fetchBtn = document.getElementById('fetch');

        fetchBtn.addEventListener('click', () => {
            console.log('fetching...');
            fetch("http://34.227.116.43/laraveles/fetchApp/public/product", {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                method: "POST",
                body: JSON.stringify({
                    "name": "cebolla",
                    "price": 100
                })
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { console.log(data); })
            .catch(function(error) { console.log(error); });
        });
    </script>
</body>
</html>