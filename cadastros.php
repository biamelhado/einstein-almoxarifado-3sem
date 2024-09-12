<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "almoxarifadobanco";

// Cria uma conexão
$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if( isset($_POST['Delete'])){
    $cod_ferramenta = $_POST['cod_ferramenta']; 
    $sql = "DELETE FROM tb_ferramenta WHERE cod_ferramenta=$cod_ferramenta"; 
    if (mysqli_query($con, $sql)) {
        echo '<script>alert("Ferramenta deletada com sucesso!");</script>';
    } else {
        echo '<script>alert("Erro ao deletar ferramenta. Tente novamente. ' . $sql . '\n' . mysqli_error($con) . '");</script>';
    }
}

$sql  = "SELECT * FROM tb_ferramenta";
$result = $con->query($sql); 

?>

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
            max-width: 100%; /* Máxima largura da área do conteúdo */
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        input[type="submit"] {
            background-color: #ff6666;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #ff1a1a;
        }

        a.button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        a.button:hover {
            background-color: #45a049;
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

        /* Estilos responsivos */
        @media only screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }

            table {
                font-size: 14px;
            }

            input[type="submit"],
            a.button,
            .btn-sair {
                padding: 8px 15px;
                font-size: 14px;
            }
        }
    </style>
    <title>Cadastros de ferramentas</title>
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
    <h2>Ferramentas cadastradas</h2>
    <table>
        <tr>
            <th>Nome</th>
            <th>Marca</th>
            <th>DELETAR</th>
            <th>EDITAR</th>
        </tr>
        <?php
        if ($result && $result->num_rows > 0) {
            while( $row = $result->fetch_assoc()){ 
                echo "<form action='' method='POST'>";   
                echo "<input type='hidden' value='". $row['cod_ferramenta']."' name='cod_ferramenta' />";
                echo "<tr>";
                echo "<td>".$row['nome_ferramenta'] . "</td>";
                echo "<td>".$row['marca_ferramenta'] . "</td>";
                echo "<td><input type='submit' name='Delete' value='Deletar' /></td>";  
                echo "<td><a href='edit.php?id=".$row['cod_ferramenta']."' class='button'>Editar</a></td>";
                echo "</tr>";
                echo "</form>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhuma ferramenta cadastrada.</td></tr>";
        }
        ?>
    </table>
</div>

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

<?php
// Fecha a conexão
$con->close();
?>
