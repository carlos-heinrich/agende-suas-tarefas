<link rel="stylesheet" href="cv.css">
<?php
include 'db.php';

if(!isset($_GET['id'])){
    header('location: listar.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM agendamento WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('location: listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$stmt =$pdo->prepare('DELETE FROM agendamento WHERE id = ?');
$stmt->execute([$id]);
header('location:listar.php');
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Deletar compromisso</title>
</head>
<body style=" background-image: url('fundo4.avif'); background-repeat:no-repeat; background-size:cover; ">
<div class="container-formulario">
<h1>Deletar compromisso</h1>
<p>tem certeza que deseja deletar o compromisso de
    <?php echo $appointment['nome']; ?> 
em <?php echo date('d/m/y',strtotime($appointment['data'])); ?>
ás <?php echo date('H:i',strtotime($appointment['hora'])); ?></p>   
<form method="post">
<div class="button-group">
    <button type="submit">sim</button>
    <a class="button-link" href="listar.php">Não</a>
</div>
</div>
</form>
</body>
</html>