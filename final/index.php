<link rel="stylesheet" href="style2.css">
<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Agendamentos De Tarefas</title>
</head>
<body style=" background-image: url('fundo2.avif'); background-repeat:no-repeat; background-size:cover; ">
    <div class="container-formulario">
        <h1>Agendamentos De Tarefas</h1>
    <?php
if (isset($_POST['submit'])){
$nome=$_POST['nome'];
$email=$_POST['email'];
$telefone=$_POST['telefone'];
$tarefa=$_POST['tarefa'];
$data=$_POST['data'];
$hora=$_POST['hora'];
$observacao=$_POST['observacao'];

$stmt= $pdo->prepare('SELECT count(*)
 FROM agendamento WHERE data = ? 
 AND hora = ?');
 $stmt->execute([$data, $hora]);
 $count = $stmt->fetchColumn();

 if($count > 0){
    $erro='já existe um agendamento para essa data e horario.';
}
else{
    $stmt = $pdo->prepare('INSERT INTO agendamento(nome, email, telefone,tarefa, data, hora,observacao)
    VALUES (:nome, :email, :telefone, :tarefa, :data, :hora, :observacao)');
    $stmt->execute(['nome'=> $nome, 
    'email'=>$email,
    'telefone'=>$telefone,'tarefa'=>$tarefa, 'data'=> $data, 'hora'=> $hora,'observacao'=>$observacao]);

    if($stmt->rowcount()){
        echo '<span>Sua tarefa foi agendado com sucesso!</span>';
    }else{
        '<span>Erro ao agendar a tarefa. tente novamente mais tarde.</span>';
    }
}
if(isset($erro)){
    echo '<span>' . $erro .'</span>';
}
}
?>
<form method="post">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required><br>
        
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
        
    <label for="telefone">Telefone:</label>
    <input type="text" name="telefone" required><br>

    <label for="tarefa">Tarefa:</label>
    <input type="text" name="tarefa" required><br>
        
    <label for="data">Data:</label>
    <input type="date" name="data" required><br>

    <label for="hora">Hora:</label>
    <input type="time" name="hora" required><br>

    <label for="observacao">Observação:</label>
    <input type="text" name="observacao"><br>

    <div class="button-group">
        <button type="submit" name="submit" value="agendar">Agendar</button>
        <a class="button-link" href="listar.php">Lista</a>
    </div>
</form>
    </div>
</body>
</html>