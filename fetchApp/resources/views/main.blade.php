<html lang="es" class="h-100" data-bs-theme="auto"><head>
    <!-- https://getbootstrap.com/docs/5.3/examples/sticky-footer/ -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <meta name="theme-color" content="#712cf9">

    <meta name="csrf-token" content="{{ csrf_token() }}">    
    <meta name="url-base" content="{{ url('') }}">

    <title>Fetch</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .container {
            width: auto;
            max-width: 680px;
            padding: 0 15px;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        .alert {
            display: none;
            opacity: 1;
            transition: opacity 0.5s ease;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="createModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        ...
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        Are you sure you want to delete the product <span id="deleteModalName"></span>?
    </div>
    <div class="alert alert-warning" role="alert" id="productDeleteWarning">An error ocurred. The product is still avaliable.</div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="bt-confirm-delete">Delete product</button>
    </div>
    </div>
</div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="editModalLabel">Segunda</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    id: <span id="id-edit"></span>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Aplicar</button>
    </div>
    </div>
</div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="viewModalLabel">Segunda</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        id: <span id="id-view"></span>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Aplicar</button>
    </div>
    </div>
</div>
</div>
    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Product</h1>
            <p class="lead">
                Tercera versión de la misma aplicación de productos: fetch (ajax).
            </p>
            <div class="alert alert-success" role="alert" id="productDeleteSuccess">Product deleted successfully.</div>
            <div id="content">
            <!--
            <div>
                <button type="button" class="btn btn-primary" data-id="33" data-name="pepe" data-email="pepe@pepe.es" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Launch demo modal
                </button>
            </div>
            -->

        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-body-tertiary">
        <div class="container">
            <span class="text-body-secondary">Place sticky footer content here.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        const exampleModal = document.getElementById('exampleModal')
        if (exampleModal) {
            exampleModal.addEventListener('show.bs.modal', event => {
                console.log('example modal visualizado')
                // Button that triggered the modal
                const button = event.relatedTarget
                // Extract info from data-bs-* attributes
                const id = button.getAttribute('data-id')

                // Update the modal's content.
                const modalTitle = exampleModal.querySelector('.modal-title')
                //const modalBodyInput = exampleModal.querySelector('.modal-body input')

                modalTitle.textContent = `New message to ${id}`
                //modalBodyInput.value = recipient
            })
        }
    </script>

    <script>
        const content = document.getElementById('content')
        const csrf = document.querySelector('meta[name="csrf-token"]')['content']
        const mainUrl = document.querySelector('meta[name="url-base"]')['content']

        const renderFetchData = (data) => {
            console.log(data);
            while (content.firstChild) {
                content.removeChild(content.firstChild);
            }
            // content.innerHtml = '';
            const buttonCreate = document.createElement('button')
            buttonCreate.textContent = 'create'
            buttonCreate.setAttribute('data-bs-toggle', 'modal');
            buttonCreate.setAttribute('data-bs-target', '#createModal');
            buttonCreate.classList.add('btn', 'btn-success');
            buttonCreate.dataset.url = "/product";
            buttonCreate.dataset.method = "post";
            content.appendChild(buttonCreate);
            let contenido = '';
            data.product.forEach(element => {
                const div = document.createElement('div');
                /*for (const key in element) {
                    div.textContent = element[key];
                }*/
                const {id, name, price} = element //destructuring assignment
                div.textContent = id + ' ' + name + ' ' + price

                const buttonView = document.createElement('button')
                buttonView.textContent = 'view'
                //class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                buttonView.setAttribute('data-bs-toggle', 'modal');
                buttonView.setAttribute('data-bs-target', '#viewModal');
                buttonView.classList.add('btn', 'btn-primary');
                buttonView.dataset.id = id;
                buttonView.dataset.name = name;
                buttonView.dataset.value = price;
                buttonView.dataset.url = "/product/" + id;
                buttonView.dataset.method = "get";

                const buttonEdit = document.createElement('button')
                buttonEdit.textContent = 'edit'
                buttonEdit.setAttribute('data-bs-toggle', 'modal');
                buttonEdit.setAttribute('data-bs-target', '#editModal');
                buttonEdit.classList.add('btn', 'btn-warning');
                buttonEdit.dataset.id = id;
                buttonEdit.dataset.name = name;
                buttonEdit.dataset.value = price;
                buttonEdit.dataset.url = "/product/" + id;
                buttonEdit.dataset.method = "put";



                const buttonDelete = document.createElement('button')
                buttonDelete.textContent = 'delete'
                buttonDelete.setAttribute('data-bs-toggle', 'modal');
                buttonDelete.setAttribute('data-bs-target', '#deleteModal');
                buttonDelete.classList.add('btn', 'btn-danger');
                buttonDelete.dataset.id = id;
                buttonDelete.dataset.name = name;
                buttonDelete.dataset.value = price;
                buttonDelete.dataset.url = "/product/" + id;
                buttonDelete.dataset.method = "delete";

                div.appendChild(buttonView)
                div.appendChild(buttonEdit)
                div.appendChild(buttonDelete)
                
                content.appendChild(div);
            });
        }


const modalEdit = document.getElementById('editModal')
modalEdit.addEventListener('show.bs.modal', event => {
    console.log("Edit");
    console.log(event.relatedTarget.dataset.id);
});
const modalDeleteConfirm = document.getElementById('bt-confirm-delete');
const modalDelete = document.getElementById('deleteModal');
let deleteData;
const modalIdDelete = document.getElementById('deleteModalName');
modalDelete.addEventListener('show.bs.modal', event => {
    document.getElementById("productDeleteWarning").style.display= "none";

    console.log("Delete");
    console.log(event.relatedTarget.dataset.id);
    // modalDeleteConfirm.dataset.url = event.relatedTarget.dataset.url;
    // modalDeleteConfirm.dataset.method = event.relatedTarget.dataset.method;
    modalIdDelete.textContent = event.relatedTarget.dataset.name;
    deleteData = {
        url: event.relatedTarget.dataset.url,
        method: event.relatedTarget.dataset.method
    }
});

modalDeleteConfirm.addEventListener('click', ()=>{
    // genericFetch(modalDeleteConfirm.dataset.url, modalDeleteConfirm.dataset.method);
    genericFetch(deleteData.url, deleteData.method, (data)=> {
        if(data.result) {
            console.log("todo ha ido bien, cierra la ventana");
            document.getElementById("productDeleteSuccess").style.display= "block";
            bootstrap.Modal.getInstance(modalDelete).hide();
            renderFetchData(data);
            
            setTimeout(() => {
                document.getElementById("productDeleteSuccess").style.display= "none";

            }, 4000);

        } else {
        
            console.log("algo ha fallado");
            document.getElementById("productDeleteWarning").style.display= "block";

        }
    });
});




const modalView = document.getElementById('viewModal')
modalView.addEventListener('show.bs.modal', event => {
console.log("View");
console.log(event.relatedTarget.dataset.id);
});

function genericFetch(url, method, callBack) {
    fetch(mainUrl + url,{
        method: method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-Token': csrf
                },
        
    })
    .then(response => response.json())
    // .then(response => {
    //         return response.json()
    // })
    .then(data => {
        console.log(data);
        callBack(data)
    });
}
        //https://izvserver.hopto.org/laraveles/bootstrapApp/public/product
        //ejecucion diferida a lo largo del tiempo
        //1º fetch -> request/peticion a un ordenador -> tarda un tiempo
        //2º then  -> espera diferida de la llegada completa de la respuesta
        //3º then -> engtrega de respuesta transformada a json
        fetch(mainUrl + '/product')
        .then(response => response.json())
        .then(data => renderFetchData(data))

    </script>

</body></html>