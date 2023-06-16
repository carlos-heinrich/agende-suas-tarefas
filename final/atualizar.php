<!DOCTYPE html>
<html>
<head>
    <title>Atualizar tarefa</title>
    <link rel="stylesheet" href="atu.css">
</head>
<body style="background-image: url('fundo2.jpg'); background-repeat:no-repeat; background-size:cover;">
    <div class="container-formulario">
        <h1>Atualizar tarefa</h1>
        <?php
        include 'db.php';
        if (!isset($_GET['id'])) {
            header('Location: listar.php');
            exit;
        }
        $id = $_GET['id'];

        $stmt = $pdo->prepare('SELECT * FROM agendamento WHERE id = ?');
        $stmt->execute([$id]);
        $appointment = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$appointment) {
            header('Location: listar.php');
            exit;
        }
        $nome = $appointment['nome'];
        $telefone = $appointment['telefone'];
        $email = $appointment['email'];
        $tarefa = $appointment['tarefa'];
        $data = $appointment['data'];
        $hora = $appointment['hora'];
        $observacao = $appointment['observacao'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $tarefa = $_POST['tarefa'];
            $data = $_POST['data'];
            $hora = $_POST['hora'];
            $observacao = $_POST['observacao'];

            $stmt = $pdo->prepare('UPDATE agendamento SET nome = ?, email = ?, telefone = ?, tarefa = ?, data = ?, hora = ?, observacao = ? WHERE id = ?');
            $stmt->execute([$nome, $email, $telefone, $tarefa, $data, $hora, $observacao, $id]);

            header('Location: listar.php');
            exit;
        }
        ?>

        <form method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $nome ?>" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $email?>" required><br>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $telefone?>" required><br>

            <label for="tarefa">Tarefa:</label>
            <input type="text" name="tarefa" value="<?php echo $tarefa?>" required><br>

            <label for="data">Data:</label>
            <input type="date" name="data" value="<?php echo $data?>" required><br>

            <label for="hora">Hora:</label>
            <input type="time" name="hora" value="<?php echo $hora?>" required><br>

            <label for="observacao">Observação:</label>
            <input type="text" name="observacao" value="<?php echo $observacao?>" ><br>

            <button type="submit">Atualizar</button>
        </form>
    </div>
</body>
</html>
