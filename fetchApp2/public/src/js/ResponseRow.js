import HttpClient from "./HttpClient.js";

export default class ResponseRow {
    constructor(parent, currentPage, url, csrf) {
        this.parent = parent;
        this.currentPage = currentPage;
        this.url = url;
        this.csrf = csrf;
        this.httpClient = new HttpClient(this.url, this.csrf);
        this.categories = {};

        // Cargar las categorías al inicializar
        this.loadCategories();
    }


    loadCategories() {
        this.httpClient.get(
            '/categories',
            {},
            (data) => {
                this.categories = data.categories;
            }
        );
    }

    add({ id, name, imageUrl, songUrl, artist, category }) {
        if (!this.rowDiv || this.rowDiv.children.length >= 3) {
            this.rowDiv = document.createElement('div');
            this.rowDiv.classList.add('row', 'mb-4');
            this.parent.appendChild(this.rowDiv);
        }

        const colDiv = document.createElement('div');
        colDiv.classList.add('col-md-4');

        const cardDiv = document.createElement('div');
        cardDiv.classList.add('card', 'mb-4');

        const img = document.createElement('img');
        img.src = '/laraveles/fetchApp2/storage/app/public/imgs/' + imageUrl;
        img.classList.add('card-img-top');
        img.alt = name;

        const cardBody = document.createElement('div');
        cardBody.classList.add('card-body');

        const title = document.createElement('h5');
        title.classList.add('card-title');
        title.textContent = name;

        const artistParagraph = document.createElement('p');
        artistParagraph.classList.add('card-text');
        artistParagraph.textContent = `Artist: ${artist}`;

        const categoryParagraph = document.createElement('p');
        categoryParagraph.classList.add('card-text');
        categoryParagraph.textContent = `Category: ${this.categories[category] || category}`;

        const buttonContainer = document.createElement('div');
        buttonContainer.classList.add('buttons');
        buttonContainer.style.display = 'flex';
        buttonContainer.style.justifyContent = 'space-between';

        const audio = document.createElement('audio');
        audio.src = '/laraveles/fetchApp2/storage/app/public/songs/' + songUrl;
        audio.controls = true;
        audio.style.width = '380px';
        audio.classList.add('card-text');

        const buttonView = document.createElement('a');
        let textNode = document.createTextNode('View');
        buttonView.appendChild(textNode);
        buttonView.setAttribute('data-bs-toggle', 'modal');
        buttonView.setAttribute('data-bs-target', '#viewModal');
        buttonView.classList.add('btn', 'btn-primary', 'col-auto');
        buttonView.dataset.id = id;
        buttonView.dataset.name = name;
        buttonView.dataset.artist = artist;
        buttonView.dataset.category = this.categories[category] || category;
        buttonView.dataset.url = "/song/" + id;
        buttonView.dataset.method = "get";

        const buttonEdit = document.createElement('a');
        buttonEdit.textContent = 'Edit';
        buttonEdit.setAttribute('data-bs-toggle', 'modal');
        buttonEdit.setAttribute('data-bs-target', '#editModal');
        buttonEdit.classList.add('btn', 'btn-warning', 'col-auto');
        buttonEdit.dataset.id = id;
        buttonEdit.dataset.title = title.textContent;
        buttonEdit.dataset.artist = artist;
        buttonEdit.dataset.category = this.categories[category] || category;
        buttonEdit.dataset.url = "/song/" + id;
        buttonEdit.dataset.method = "put";

        const buttonDelete = document.createElement('a');
        textNode = document.createTextNode('Delete');
        buttonDelete.appendChild(textNode);
        buttonDelete.setAttribute('data-bs-toggle', 'modal');
        buttonDelete.setAttribute('data-bs-target', '#deleteModal');
        buttonDelete.classList.add('btn', 'btn-danger', 'col-auto');
        buttonDelete.dataset.id = id;
        buttonDelete.dataset.name = name;
        buttonDelete.dataset.url = "/song/" + id;
        buttonDelete.dataset.method = "delete";

        buttonContainer.append(buttonView, buttonEdit, buttonDelete);

        cardBody.append(title, artistParagraph, categoryParagraph, audio, buttonContainer);
        cardDiv.append(img, cardBody);
        colDiv.appendChild(cardDiv);
        this.rowDiv.appendChild(colDiv);
    }
}