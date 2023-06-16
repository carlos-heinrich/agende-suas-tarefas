<link rel="stylesheet" href="style.css"> 
<?php include 'db.php'; ?>
<IDOCTYPE html> 
<html>
<head>
<link rel='stylesheet' href='style.css'> <title>Agendamentos De Tarefas</title> </head>
<body class='listar' style=" background-image: url('images.jpeg'); background-repeat:no-repeat; background-size:cover; ">
<h1>Agendamentos De Tarefas</h1>
<?php
$stmt = $pdo->query('SELECT * FROM agendamento ORDER BY data, hora');
 $agendamentos = $stmt->fetchAll(PDO:: FETCH_ASSOC);

if (count($agendamentos)== 0) {
echo '<p>Nenhum compromisso agendado.</p>';
} else {
    echo '<div style="background-color:white">';
echo '<table border="1">';
echo '<thead><tr><th>Nome</th><th>E-mail</th><th>Telefone</th><th>tarefa</th><th>Data</th><th>Horário</th><th>observacao</th><th colspan="2">
Opções</th></tr></thead>';
echo '<tbody>';
echo '</div>';

foreach ($agendamentos as $agendamento) {
echo '<tr>';
echo '<td>' . $agendamento['nome'] . '</td>';
echo '<td>' . $agendamento['email'] . '</td>'; 
echo '<td>' . $agendamento['telefone'] . '</td>';
echo '<td>' . $agendamento['tarefa'] . '</td>';
echo '<td>' . date('d/m/Y', strtotime($agendamento['data'])) . '</td>';
echo '<td>' . date('H:i', strtotime($agendamento['hora'])) . '</td>';
echo '<td>' . $agendamento['observacao'] . '</td>';
echo '<td><a style="color:black;" href="atualizar.php?id='.$agendamento['id'] . '">Atualizar</a></td>';
echo '<td><a style="color:black;" href="deletar.php?id='.$agendamento['id'] .'">Deletar</a></td>';
echo '</tr>';
}

echo '</tbody>';
echo '</table>';
}
?>
<P style=" text-align: center"> <a href="index.php">adicionar +</a> <P>
</body>

</html>