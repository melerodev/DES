<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" class="csrf" content="{{ csrf_token() }}">
    <meta class="url-base" content="{{ url('') }}">
</head>
<body>
    <button id="fetch">fetch</button>
    <script>
        const fetchBtn = document.getElementById('fetch');

        fetchBtn.addEventListener('click', () => {
            console.log('fetching...');
            fetch(document.querySelector('.url-base').content + "/product", {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('.csrf').content
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