class LoginForm extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
    }

    connectedCallback() {
        this.shadowRoot.innerHTML = `
            <style>
                .inlog {
                    width: 600px;
                    height: auto;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    background-color: #8F9F5D;
                    padding: 20px;
                    border-radius: 10px;
                    position: relative;
                }

                .inlog h2 {
                    font-style: italic;
                    color: white;
                    margin-bottom: 10px;
                }

                .inlog-box {
                    width: 100%;
                    display: flex;
                    align-items: center;
                    flex-direction: column;
                    gap: 10px;
                }

                .inlog-box input {
                    width: calc(100% - 20px);
                    height: 30px;
                    padding: 10px;
                    border-radius: 5px;
                    border: none;
                }

                .inlog-box input[type="submit"] {
                    background-color: #3D1E10;
                    color: white;
                    cursor: pointer;
                    height: 40px;
                    width: 30%;
                }

                .inlog-box input[type="submit"]:hover {
                    background-color: #5a2d16;
                }

                .signup {
                    margin-top: 10px;
                    color: #36160A;
                    font-style: italic;
                    font-size: 14px;
                    text-align: right;
                }

                .close-btn {
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    cursor: pointer;
                }

                .close-btn img {
                    width: 30px;
                    height: 30px;
                }
            </style>
            <div class="inlog">
                <span class="close-btn"><img src="../assets/images/kruis.png" alt="kruis"></span>
                <h2 style="text-align: center;">login</h2>
                <form class="inlog-box" action="inloggen.php" method="post">
                    <input type="email" name="email" placeholder="E-mailadres" required>
                    <input type="password" name="wachtwoord" placeholder="Wachtwoord" required>
                    <input type="submit" value="doorgaan">
                </form>
                <div class="signup">nog geen account? <a href="#" style="color: #36160A;">maak er een!</a></div>
            </div>
        `;
    }
}

customElements.define('login-form', LoginForm);
