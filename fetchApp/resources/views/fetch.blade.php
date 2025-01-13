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
    <button id="fetch">Fetch</button>
    <button id="update">Update</button>
    <button id="delete">Delete</button>
    <script>
        const csrf = document.querySelector('.csrf').content;
        const urlBase = document.querySelector('.url-base').content;

        document.getElementById('fetch').addEventListener('click', () => {
            console.log('fetching...');
            fetch (urlBase + "/product", {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                method: "POST",
                body: JSON.stringify({
                    "name": "Manzana",
                    "price": 100
                })
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { console.log(data); })
            .catch(function(error) { console.log(error); });
        });

        let fetchUpdateBt = document.getElementById('update')
        fetchUpdateBt.addEventListener('click', (event) => {
            fetch(urlBase + '/product/2', {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrf
                },
                body: JSON.stringify({
                        'name': '34',
                        'price': 1.78
                    })
                }).
            then(response => response.json()).
            then(data => {
                console.log(data)
            });
        });

        document.getElementById('delete').addEventListener('click', () => {
            console.log('deleting...');
            fetch (urlBase + "/product/15", {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                method: "DELETE"
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { console.log(data); })
            .catch(function(error) { console.log(error); });
        });
    </script>
</body>
</html>