<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Panel</title>
    </head>
    <body>
        <div class="admin_wrapper">
            <h1>Login</h1>
            <form action="/api/login" method="post">
                <input type="text" placeholder="Enter login" name="login" required >
                <input type="password" placeholder="Enter password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </body>
</html>

<style>
    body{
        display:flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        padding: 0;
        height: 100vh;
    }
    .admin_wrapper{
        width: 36%;
        height: 40%;
        border: 2px solid gray;
        display: flex;
        flex-direction: column;
    }
    .admin_wrapper h1{
        margin-top: 3vh;
        margin-left: 4vw;
        font-size: 5vh;
    }
    .admin_wrapper input{
        margin-bottom: 3vh;
        height: 5vh;
        width: 80%;
        margin-left: 10%;
        font-size: 4vh;
    }
    .admin_wrapper button{
        width: 24%;
        margin-top: 2vh;
        height: 7vh;
        margin-left: 73%;
        border-radius: 20px;
        font-size: 4vh;
    }
</style>