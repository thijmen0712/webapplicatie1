class MenuItem extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });

        const template = document.createElement('template');
        template.innerHTML = `
            <style>
            .product {
                display: flex;
                flex-direction: column;
                background-color: black;
                padding: 20px;
                box-sizing: border-box;
                width: 350px;
                border-radius: 20px;
                align-items: flex-start;
            }

            .product img {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-radius: 5px;
            }

            .product-onderkant {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
            }

            .product-onderkant button {
                background-color: #191919;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 10px;
                cursor: pointer;
            }

            .product-onderkant button:hover {
                background-color: #3D1E10;
            }
            </style>
            <div class="product">
            <img src="" alt="">
            <h2></h2>
            <p></p>
            <div class="product-onderkant">
                <p class="prijs"></p>
                <form method="post">
                <input type="hidden" name="product_id">
                <button type="submit">Toevoegen</button>
                </form>
            </div>
            </div>
        `;

        this.shadowRoot.appendChild(template.content.cloneNode(true));
    }

    connectedCallback() {
        this.shadowRoot.querySelector('img').src = this.getAttribute('foto');
        this.shadowRoot.querySelector('img').alt = this.getAttribute('titel');
        this.shadowRoot.querySelector('h2').innerText = this.getAttribute('titel');
        this.shadowRoot.querySelector('p').innerText = this.getAttribute('beschrijving');
        this.shadowRoot.querySelector('.prijs').innerText = '€' + this.getAttribute('prijs');
        this.shadowRoot.querySelector('input[name="product_id"]').value = this.getAttribute('id');
    }
}

customElements.define('menu-item', MenuItem);
