<?php
include_once("conexao.php");
require_once('db.class.php');
session_start();
$nome = $_SESSION['usuario'];
$idUsu = "SELECT idUsuarios from usuarios where usuario = '$nome'";
$resultado_id = mysqli_query($conn, $idUsu);
$row_id = mysqli_fetch_assoc($resultado_id);
$info = $row_id;
$string = implode($info);
$id_usu = intval($string);
$result_events = "SELECT idEvent, title, color, startt, endd FROM events WHERE idUsuarios = $id_usu";
$resultado_events = mysqli_query($conn, $result_events);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset='utf-8' />
			<link href='css/fullcalendar.min.css' rel='stylesheet' />
			<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
			<link href='css/personalizado.css' rel='stylesheet' />
			<script src='js/moment.min.js'></script>
			<script src='js/jquery.min.js'></script>
			<script src='js/fullcalendar.min.js'></script>
			<script src='locale/pt-br.js'></script>
		<script>
			$(document).ready(function() {
				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					defaultDate: Date(),
					navLinks: true, // can click day/week names to navigate views
					editable: true,
					eventLimit: true, // allow "more" link when too many events
					events: [
						<?php
							while($row_events = mysqli_fetch_array($resultado_events)){
								?>
								{
								id: '<?php echo $row_events['idEvent']; ?>',
								title: '<?php echo $row_events['title']; ?>',
								start: '<?php echo $row_events['startt']; ?>',
								end: '<?php echo $row_events['endd']; ?>',
								color: '<?php echo $row_events['color']; ?>',
								},<?php
							}
						?>
					]
				});
			});
		</script>
	</head>
	<body>
			<nav class="nav-testt">
		<ul id="ul-principal">
			<li class="li-p"><a class="aa" href="menuh.php">Voltar</a></li>
		
	</nav>

		<div id='calendar'></div>

	</body>
</html>
