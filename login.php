
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</body>
</html>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #ffc107;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #ffca28;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="login_usuario">Usuário:</label>
        <input type="text" id="login_usuario" name="login_usuario" required><br><br>

        <label for="senha_usuario">Senha:</label>
        <input type="password" id="senha_usuario" name="senha_usuario" required><br><br>

        <input type="submit" value="Entrar">
    </form>

    <?php

echo "<div class='container'>";
    session_start(); // Inicia a sessão para armazenar os dados do usuário logado

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "almoxarifadobanco";

    // Estabelece a conexão com o banco de dados
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Processa o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_usuario = $_POST['login_usuario'];
    $senha_usuario = $_POST['senha_usuario'];

    // Consulta o banco de dados para verificar se o usuário e senha estão corretos
    $sql = "SELECT * FROM tb_usuario WHERE login_usuario = '$login_usuario' AND senha_usuario = '$senha_usuario'";
    $result = mysqli_query($conn, $sql);

    // Verifica se a consulta retornou algum resultado
    if (mysqli_num_rows($result) == 1) {
        // O usuário foi autenticado com sucesso
        $_SESSION['login'] = $login_usuario; // Armazena o nome de usuário na sessão
        header("Location: cadastroferramenta.php");
    } else {
        echo '<script>alert("Login ou senha incorretos!");</script>';
    }
}
?>
</body>
</html>


