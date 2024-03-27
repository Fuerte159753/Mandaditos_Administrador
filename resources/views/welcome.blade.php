<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #222327;
    }
    .navigation{
        position: relative;
        width: 400px;
        height: 60px;
        background: #EAEDED;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
    }
    .navigation ul{
        display: flex;
        width: 350px;
    }
    .navigation ul li{
        list-style: none;
        position: relative;
        /* 350 / 4 = 70*/
        width: 87.5px;
        height: 60px;
        z-index: 2;
    }
    .navigation ul li a{
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
        text-align: center;
        cursor: pointer;
    }
    .navigation ul li a .icon{
        position: relative;
        display: block;
        line-height: 65px;
        font-size: 1.5rem;
        transition: 0.5s;
        color: #222327;
    }
    .navigation ul li.active a .icon{
        transform: translateY(-32px);
        color: #12CD26;
    }
    /*.navigation ul li a .text{
        position: absolute;
        background: #2196f3;
        color: #000000;
        padding: 2px 7px;
        border-radius: 12px;
        font-weight: 400;
        font-size: 0.75em;
        letter-spacing: 0.05em;
        transition: 0.5s;
        opacity:0; 
        transform: translateY(15px);
    }*/
    .navigation ul li a .text {
    position: absolute;
    background: linear-gradient(to right, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5, #1a73e8, #6f96ff);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    padding: 2px 7px;
    border-radius: 12px;
    font-weight: 400;
    font-size: 0.75em;
    letter-spacing: 0.05em;
    transition: 0.5s;
    opacity: 0;
    transform: translateY(15px);
    text-shadow: 0 0 8px rgba(0,0,0,0.3); /* Agrega sombra al texto para crear el fondo gris */
    }
    .navigation ul li.active a .text{
        transform: translateY(-4px);
        opacity:1;
    }
    .indicator{
        position: absolute;
        top: -35px;
        width: 85.7px;
        height: 85.7px;
        background: #EAEDED;
        border-radius: 50%;
        z-index: 1;
        transition: 0.5s;
    }
    .indicator::before{
        content: '';
        position: absolute;
        top: 5px;
        left: -25.5px;
        width: 30px;
        height: 30px;
        background: transparent;
        border-radius: 50%;
        box-shadow: 15px 18px #EAEDED;
    }
    .indicator::after{
        content: '';
        position: absolute;
        top: 5px;
        right: -25.5px;
        width: 30px;
        height: 30px;
        background: transparent;
        border-radius: 50%;
        box-shadow: -15px 18px #EAEDED;
    }
    .navigation ul li:nth-child(1).active ~ .indicator{	
        transform: translateX(calc(87.5px*0));
    }
    .navigation ul li:nth-child(2).active ~ .indicator{	
        transform: translateX(calc(87.5px*1));
    }
    .navigation ul li:nth-child(3).active ~ .indicator{	
        transform: translateX(calc(87.5px*2));
    }
    .navigation ul li:nth-child(4).active ~ .indicator{	
        transform: translateX(calc(87.5px*3));
    }
    .btn{
        text-decoration: none;
        border: solid 1px white;
        padding: 20px 20px;
        border-radius: 10px;
        color: white;
        box-shadow: 5px red
    }
</style>
<body>
    <div class="login-container">
        <a class="btn" href="{{route('loginadmin')}}">inicio de administrador</a>
        <a class="btn" href="{{route('loginvendedor')}}">Inicio de vendedor</a>
    </div>  
    <div class="navigation">
        <ul>
            <li class="list active">
                <a>
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="text">Inicio</span>
                </a>
            </li>
            <li class="list">
                <a >
                    <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                    </span>
                    <span class="text">Perfil</span>
                </a>
            </li>
            <li class="list">
                <a >
                    <span class="icon">
                        <ion-icon name="storefront-outline"></ion-icon>
                    </span>
                    <span class="text">Pedidos</span>
                </a>
            </li>
            <li class="list">
                <a >
                    <span class="icon">
                        <ion-icon name="exit-outline"></ion-icon>
                    </span>
                    <span class="text">Exit</span>
                </a>
            </li>
            <div class="indicator"></div>
        </ul>
    </div><!---->
    <script> 
    const list = document.querySelectorAll('.list');
    function activeLink(){;
        list.forEach((item) =>
        item.classList.remove('active'));
        this.classList.add('active');
    }
    list.forEach((item) =>
    item.addEventListener('click', activeLink));
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
