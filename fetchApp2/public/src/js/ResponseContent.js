import PageItem from './PageItem.js';
import ResponseRow from './ResponseRow.js';

export default class ResponseContent {

    constructor(content, paginationContent, userContent) {
        this.content = content;
        this.currentPage = 1;
        this.paginationContent = paginationContent;
        this.userContent = userContent;
        this.pageItem = new PageItem(this.paginationContent);
        this.responseRow = new ResponseRow(this.content, null, document.querySelector('meta[name="url-base"]')['content'], document.querySelector('meta[name="csrf-token"]')['content']);
    }

    cleanContent(element) {
        while (element.firstChild) {
            element.removeChild(element.firstChild);
        }
    }

    currentPage() {
        return this.currentPage;
    }

    setContent(result) {
        this.cleanContent(this.content);
        this.cleanContent(this.paginationContent);

        this.currentPage = result.songs.current_page;

        this.setUserContent(result.user);

        const buttonCreate = document.createElement('button');
        buttonCreate.textContent = 'Create';
        // un margen a la derecha y otro abajo
        buttonCreate.style.margin = '5px 5px 5px';
        buttonCreate.setAttribute('data-bs-toggle', 'modal');
        buttonCreate.setAttribute('data-bs-target', '#createModal');
        buttonCreate.classList.add('btn', 'btn-success');
        buttonCreate.dataset.url = "/song";
        buttonCreate.dataset.method = "post";
        this.content.appendChild(buttonCreate);

        const buttonCreateCategory = document.createElement('button');
        buttonCreateCategory.textContent = 'Create Category';
        buttonCreate.style.margin = '5px 5px 5px';
        buttonCreateCategory.setAttribute('data-bs-toggle', 'modal');
        buttonCreateCategory.setAttribute('data-bs-target', '#createCategoryModal');
        buttonCreateCategory.classList.add('btn', 'btn-warning');
        buttonCreateCategory.dataset.url = "/category";
        buttonCreateCategory.dataset.method = "post";
        this.content.appendChild(buttonCreateCategory);

        result.songs.links.forEach(link => {
            this.pageItem.add(link, (data) => {
                this.setContent(data);
            });
        });

        result.songs.data.forEach(song => {
            this.responseRow.add({
                id: song.id,
                name: song.title,
                imageUrl: song.route_image,
                songUrl: song.route_song,
                artist: song.artist,
                category: song.category_id,
                created_at: song.created_at,
                updated_at: song.updated_at
            });
        });
    }

    setUserContent(user) {
        this.cleanContent(this.userContent);
        if(user === null) {
            this.setNoUserContent();
        } else {
            this.setCurrentUserContent(user);
        }
    }

    setCurrentUserContent(user) {
        let listItem = document.createElement('li');
        listItem.classList.add('nav-item', 'dropdown');
        let a = document.createElement('a');
        a.classList.add('nav-link', 'dropdown-toggle');
        a.setAttribute('data-bs-toggle', 'dropdown');
        let textNode = document.createTextNode(user.name);
        a.appendChild(textNode);
        listItem.appendChild(a);
        this.userContent.appendChild(listItem);

        let div = document.createElement('div');
        div.classList.add('dropdown-menu', 'dropdown-menu-end');
        a = document.createElement('a');
        a.id = 'logoutLink';
        a.classList.add('dropdown-item');
        a.setAttribute('data-url', '/logout');
        textNode = document.createTextNode('Logout');
        a.appendChild(textNode);
        div.appendChild(a);
        listItem.appendChild(div);
        this.userContent.appendChild(listItem);
    }

    setNoUserContent() {
        let listItem = document.createElement('li');
        listItem.classList.add('nav-item');

        let aElement = document.createElement('a');
        aElement.classList.add('nav-link');
        aElement.dataset.url = '/login';
        aElement.setAttribute('data-bs-toggle', 'modal');
        aElement.setAttribute('data-bs-target', '#loginModal');
        let textNode = document.createTextNode('Login');

        aElement.appendChild(textNode);
        listItem.appendChild(aElement);
        this.userContent.appendChild(listItem);

        listItem = document.createElement('li');
        listItem.classList.add('nav-item');
        aElement = document.createElement('a');
        aElement.classList.add('nav-link');
        aElement.dataset.url = '/register';
        aElement.setAttribute('data-bs-toggle', 'modal');
        aElement.setAttribute('data-bs-target', '#registerModal');
        textNode = document.createTextNode('Register');

        aElement.appendChild(textNode);
        listItem.appendChild(aElement);
        this.userContent.appendChild(listItem);
    }
}