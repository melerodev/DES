import HttpClient from './HttpClient.js';
import ResponseContent from './ResponseContent.js';

export default class ModalEvents {

    constructor(url, csrf) {
        this.url = url;
        this.csrf = csrf;

        this.content = document.getElementById('content');
        this.userContent = document.getElementById('userContent');
        this.pagination = document.getElementById('pagination');
        this.responseContent = new ResponseContent(this.content, this.pagination, this.userContent);

        this.fetchUrl = '';
        this.httpClient = new HttpClient(this.url, this.csrf);

        this.modalCreate = document.getElementById('createModal');
        this.modalCreateButton = document.getElementById('modalCreateButton');
        this.createTitle = document.getElementById('createTitle');
        this.createArtist = document.getElementById('createArtist');
        this.createCategory = document.getElementById('createCategory');
        this.createImage = document.getElementById('createImage');
        this.createSong = document.getElementById('createSong');

        this.modalDelete = document.getElementById('deleteModal');
        this.modalDeleteButton = document.getElementById('modalDeleteButton');
        this.deleteName = document.getElementById('deleteName');
        this.deletePrice = document.getElementById('deletePrice');

        this.modalEdit = document.getElementById('editModal');
        this.modalEditButton = document.getElementById('modalEditButton');
        this.editTitle = document.getElementById('editTitle');
        this.editArtist = document.getElementById('editArtist');
        this.editCategory = document.getElementById('editCategory');

        this.modalLogin = document.getElementById('loginModal');
        this.modalLoginUserButton = document.getElementById('modalLoginUserButton');
        this.loginEmail = document.getElementById('loginEmail');
        this.loginPassword = document.getElementById('loginPassword');

        this.modalRegister = document.getElementById('registerModal');
        this.modalRegisterUserButton = document.getElementById('modalRegisterUserButton');
        this.registerConfirmPassword = document.getElementById('registerConfirmPassword');
        this.registerEmail = document.getElementById('registerEmail');
        this.registerName = document.getElementById('registerName');
        this.registerPassword = document.getElementById('registerPassword');

        this.modalView = document.getElementById('viewModal');
        this.viewId = document.getElementById('viewId');
        this.viewName = document.getElementById('viewName');
        this.viewArtist = document.getElementById('viewArtist');
        this.viewCategory = document.getElementById('viewCategory');

        this.productError = document.getElementById('productError');
        this.productSuccess = document.getElementById('productSuccess');

        this.logoutButton = document.getElementById('logoutButton');

        this.categories = {};

        this.assignEvents();
    }

    assignEvents() {

        this.modalCreate.addEventListener('show.bs.modal', event => {
            document.getElementById('modalCreateWarning').style.display = 'none';
            this.fetchUrl = event.relatedTarget.dataset.url;
            this.createTitle.value = '';
            this.createArtist.value = '';
            this.createCategory.value = '';
            this.createImage.value = '';
            this.createSong.value = '';
        });

        this.modalDelete.addEventListener('show.bs.modal', event => {
            document.getElementById('modalDeleteWarning').style.display= 'none';
            this.fetchUrl = event.relatedTarget.dataset.url;
            this.deleteName.value = event.relatedTarget.dataset.name;
            this.deletePrice.value = event.relatedTarget.dataset.price;
        });

        this.modalEdit.addEventListener('show.bs.modal', event => {
            this.httpClient.get(
                '/categories',
                {},
                (data) => {
                    console.log('Response from /categories:', data); // Agrega esto para depuración
                    this.categories = data.categories;
                    console.log(this.categories);
        
                    // Llenar el select con las categorías
                    const editCategorySelect = this.editCategory;
                    editCategorySelect.innerHTML = ''; // Limpiar el select
                    for (const [key, value] of Object.entries(this.categories)) {
                        const option = document.createElement('option');
                        option.value = key;
                        option.textContent = value;
                        editCategorySelect.appendChild(option);
                    }
                }
            );
        
            document.getElementById('modalEditWarning').style.display = 'none';
            this.fetchUrl = event.relatedTarget.dataset.url;
            this.editTitle.value = event.relatedTarget.dataset.title;
            this.editArtist.value = event.relatedTarget.dataset.artist;
        });

        this.modalLogin.addEventListener('show.bs.modal', event => {
            this.fetchUrl = event.relatedTarget.dataset.url;
            this.loginEmail.value = '';
            this.loginPassword.value = '';
        });

        this.modalRegister.addEventListener('show.bs.modal', event => {
            this.fetchUrl = event.relatedTarget.dataset.url;
            this.registerConfirmPassword.value = '';
            this.registerEmail.value = '';
            this.registerName.value = '';
            this.registerPassword.value = '';
        });

        this.modalView.addEventListener('show.bs.modal', event => {
            document.getElementById('modalViewWarning').style.display= 'none';
            this.viewId.value = event.relatedTarget.dataset.id;
            this.viewName.value = event.relatedTarget.dataset.name;
            this.viewArtist.value = "XD";
            console.log(event.relatedTarget.dataset.category);
            this.viewCategory.value = event.relatedTarget.dataset.category;
            const url = event.relatedTarget.dataset.url;
            this.httpClient.get(
                url,
                {
                },
                data => this.responseShow(data)
            );
        });

        this.modalCreate.addEventListener('show.bs.modal', event => {
            document.getElementById('modalCreateWarning').style.display = 'none';
            this.fetchUrl = event.relatedTarget.dataset.url;
            this.createTitle.value = '';
            this.createArtist.value = '';
            this.createCategory.value = '';
            this.createImage.value = '';
            this.createSong.value = '';
        
            // Llenar el select con las categorías
            this.httpClient.get(
                '/categories',
                {},
                (data) => {
                    console.log('Response from /categories:', data); // Agrega esto para depuración
                    this.categories = data.categories;

                    const createCategorySelect = this.createCategory;
                    createCategorySelect.innerHTML = ''; // Limpiar el select
                    
                    for (const [key, value] of Object.entries(this.categories)) {
                        const option = document.createElement('option');
                        option.value = key;
                        option.textContent = value;
                        createCategorySelect.appendChild(option);
                    }
                }
            );
        });

        // this.modalCreateButton.addEventListener('click', event => {
        //     console.log(this.createImage.files[0]); 
        //     console.log(this.createSong.files[0]);
        //     this.httpClient.post(
        //         this.fetchUrl,
        //         {
        //             title: this.createTitle.value,
        //             artist: this.createArtist.value,
        //             category_id: this.createCategory.value,
        //             route_image: this.createImage.value,
        //             route_song: this.createSong.value
        //         },
        //         data => this.responseCreate(data)
        //     );
        // });

        this.modalCreateButton.addEventListener('click', event => {
            const formData = new FormData();
            formData.append('title', this.createTitle.value);
            formData.append('artist', this.createArtist.value);
            formData.append('category_id', this.createCategory.value);
            formData.append('route_image', this.createImage.files[0]);
            formData.append('route_song', this.createSong.files[0]);

            console.log(this.createImage.files[0]);
            
            this.httpClient.postFormData(
                this.fetchUrl,
                formData,
                data => this.responseCreate(data)
            );
        });

        this.modalDeleteButton.addEventListener('click', event => {
            this.httpClient.delete(
                this.fetchUrl,
                {
                    page: this.responseContent.currentPage
                },
                data => this.responseDelete(data));
        });

        this.modalEditButton.addEventListener('click', event => {
            this.httpClient.put(
                this.fetchUrl,
                {
                    title: this.editTitle.value,
                    artist: this.editArtist.value,
                    category_id: this.editCategory.value, // Asegúrate de enviar el valor de category_id
                    page: this.responseContent.currentPage
                },
                data => this.responseEdit(data)
            );
        });

        this.modalLoginUserButton.addEventListener('click', event => {
            this.httpClient.post(
                this.fetchUrl,
                {
                    email: this.loginEmail.value,
                    password: this.loginPassword.value,
                },
                data => this.responseLogin(data)
            );
        });

        this.modalRegisterUserButton.addEventListener('click', event => {
            this.httpClient.post(
                this.fetchUrl,
                {
                    name: this.registerName.value,
                    email: this.registerEmail.value,
                    password: this.registerPassword.value,
                    password_confirmation: this.registerConfirmPassword.value
                },
                data => this.responseRegister(data)
            );
        });

        /*this.logoutButton.addEventListener('click', event => {
            console.log('adios');
        });*/
    }

    formattedDate(date) {
        date = new Date(date);
        return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
    }

    responseCommonContent(data) {
        this.responseContent.setContent(data);
        let link = document.getElementById('logoutLink');
        if(link) {
            link.addEventListener('click', event => {
                this.httpClient.post(
                    link.dataset.url,
                    {},
                    data => console.log(data) //this.responseCommonContent(data)
                );
            });
        }
    }

    responseCreate(data) {
        console.log('responseCreate', data);
        if(data.result) {
            this.productSuccess.style.display = 'block';
            bootstrap.Modal.getInstance(this.modalCreate).hide();
            this.responseCommonContent(data);
            setTimeout(() => {
                this.productSuccess.style.display= 'none';
            }, 4000);
        } else {
            document.getElementById('modalCreateWarning').style.display = 'block';
        }
    }

    responseDelete(data) {
        if(data.result) {
            this.productSuccess.style.display = 'block';
            bootstrap.Modal.getInstance(this.modalDelete).hide();
            this.responseCommonContent(data);
            setTimeout(() => {
                this.productSuccess.style.display= 'none';
            }, 4000);
        } else {
            document.getElementById('modalDeleteWarning').style.display = 'block';
        }
    }

    responseEdit(data) {
        if(data.result) {
            this.productSuccess.style.display = 'block';
            bootstrap.Modal.getInstance(this.modalEdit).hide();
            this.responseCommonContent(data);
            setTimeout(() => {
                this.productSuccess.style.display= 'none';
            }, 4000);
        } else {
            document.getElementById('modalEditWarning').style.display = 'block';
        }
    }

    responseLogin(data) {
        data = {
            name: 'Juan'
        }
        console.log('login ' + data);
        this.responseContent.setUserContent(data);
    }

    responseRegister(data) {
        console.log('register ' + data);
    }

    responseShow(data) {
        const {id, artist} = data.song;
        this.viewId.value = id;
        this.viewArtist.value = artist;
    }

    init() {
        this.httpClient.get(
            '/song',
            {},
            (data) => {
                this.responseCommonContent(data);
            }
        );
    }
}