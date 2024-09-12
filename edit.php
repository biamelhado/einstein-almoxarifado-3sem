<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Reset de estilos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Estilo do header */
        header {
            background-color: #333; /* Cor de fundo do header */
            padding: 20px; /* Espaçamento interno */
        }

        /* Estilo da navegação */
        nav ul {
            list-style-type: none;
        }

        nav ul li {
            display: inline;
            margin-right: 20px; /* Espaçamento entre os itens do menu */
        }

        nav ul li a {
            text-decoration: none;
            color: #fff; /* Cor do texto */
            font-size: 16px;
            font-weight: bold;
            transition: color 0.3s; /* Transição suave de cor */
        }

        nav ul li a:hover {
            color: #ff4500; /* Cor do texto ao passar o mouse */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
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

        .btn-sair {
            background-color: #ff4500;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-sair:hover {
            background-color: #cc3700;
        }
    </style>
    <title>Edição de cadastro de ferramenta</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="cadastrouser.php">Cadastro de Usuário</a></li>
            <li><a href="cadastroferramenta.php">Cadastro de Ferramenta</a></li>
            <li><a href="cadastros.php">Cadastros</a></li>
        </ul>
    </nav>
</header>
<div class='container'>
    <h2>Edição de cadastro de ferramenta</h2>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "almoxarifadobanco";

    // Cria a conexão
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verifica a conexão
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM tb_ferramenta WHERE cod_ferramenta = $id";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <form method="post" action="">
                <input type="hidden" name="cod_ferramenta" value="<?php echo $row['cod_ferramenta']; ?>">
                <label for="nome_ferramenta">Nome:</label>
                <input type="text" id="nome_ferramenta" name="nome_ferramenta" value="<?php echo $row['nome_ferramenta']; ?>" required><br><br>

                <label for="marca_ferramenta">Marca:</label>
                <input type="text" id="marca_ferramenta" name="marca_ferramenta" value="<?php echo $row['marca_ferramenta']; ?>" required><br><br>

                <input type="submit" value="Editar">
            </form>
            <?php
        } else {
            echo "Ferramenta não encontrada.";
        }
    } else {
        echo "ID da ferramenta não fornecido.";
    }

    mysqli_close($conn);
    ?>

</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "almoxarifadobanco";

    // Cria a conexão
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Verifica a conexão
    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    $cod_ferramenta = $_POST['cod_ferramenta'];
    $nome_ferramenta = $_POST['nome_ferramenta'];
    $marca_ferramenta = $_POST['marca_ferramenta'];

    // Atualiza os dados na tabela
    $sql = "UPDATE tb_ferramenta SET nome_ferramenta='$nome_ferramenta', marca_ferramenta='$marca_ferramenta' WHERE cod_ferramenta=$cod_ferramenta";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Ferramenta editada com sucesso!");</script>';
    } else {
        echo '<script>alert("Erro ao editar ferramenta. Tente novamente. ' . $sql . '\n' . mysqli_error($conn) . '");</script>';
    }

    // Fecha a conexão
    mysqli_close($conn);
}
?>

<div style = "display: flex; justify-content: center;">
<button class="btn-sair" type="button" onclick="redirecionarParaLogin()">Sair</button>

<script>
    function redirecionarParaLogin() {
        window.location.href = "login.php";
    }
</script>
</div>
</body>
</html>
