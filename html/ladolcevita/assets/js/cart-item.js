class CartItem extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
    }

    connectedCallback() {
        const image = this.getAttribute('image');
        const title = this.getAttribute('title');
        const description = this.getAttribute('description');
        const price = this.getAttribute('price');
        const cartId = this.getAttribute('cart-id');

        const style = document.createElement('style');
        style.textContent = `
            .winkelwagen-product {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            width: 550px;
            background-color: #191919;
            border-radius: 10px;
            padding: 10px;
            box-sizing: border-box;
            }

            .winkelwagen-foto {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 10px;
            }

            .product-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 300px;
            }

            .product-info h3,
            .product-info p {
            margin: 0;
            }

            .product-actions {
            display: flex;
            flex-direction: column;
            gap: 25px;
            }

            .prijs {
            margin-top: auto;
            align-self: flex-end;
            font-weight: bold;
            }

            .verwijder-knop {
            background: none;
            border: none;
            cursor: pointer;
            }
        `;

        this.shadowRoot.appendChild(style);
        this.shadowRoot.innerHTML += `
            <div class="winkelwagen-product">
            <img class="winkelwagen-foto" src="${image}" alt="Product afbeelding">
            <div class="product-info">
                <h3>${title}</h3>
                <p>${description}</p>
            </div>
            <div class="product-actions">
                <form action="" method="post">
                <input type="hidden" name="winkelwagen_id" value="${cartId}">
                <button type="submit" class="verwijder-knop"><img src="../assets/images/delete_icon.png" alt="Verwijder"></button>
                </form>
                <p class="prijs">€${parseFloat(price).toFixed(2)}</p>
            </div>
            </div>
        `;
    }
}

customElements.define('cart-item', CartItem);
