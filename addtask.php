<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {
	$records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	$user = null;

	if (count($results) > 0) {
		$user = $results;
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Welcome to you WebApp</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<?php require 'partials/header.php' ?>
	<?php if (!empty($user)) : ?>
		<?php $d = $user['email'];

		?>

		<br> Welcome. <?= $user['email']; ?>
		<br>You are Successfully Logged In
		<a href="logout.php">
			Logout
		</a>


		<?php

		$host = 'localhost';  // Хост, у нас все локально
		$user = 'root';    // Имя созданного вами пользователя
		$pass = ''; // Установленный вами пароль пользователю
		$db_name = 'php_login_database';   // Имя базы данных
		$link = mysqli_connect($host, $user, $pass, $db_name);
		// Соединяемся с базой


		// Ругаемся, если соединение установить не удалось
		if (!$link) {
			echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
			exit;
		}


		$table = mysqli_query($link, "CREATE TABLE IF NOT EXISTS  $d (
  `data` date ,
  `start` text ,
  `obed` text ,
  `finishobed` text ,
  `finish` text
) ");
		$pp = date("Y-m-d");
		$check__end_day = "SELECT * FROM $d WHERE `finish` = '1'";
		$check__end_obed = "SELECT * FROM $d WHERE `finishobed` = '1'";
		$check__start_obed = "SELECT * FROM $d WHERE `obed` = '1'";
		$check__start_day = "SELECT * FROM $d WHERE `start` = '1'";
		$check__day = "SELECT *  FROM $d WHERE `data` = '{$pp}'";

		// $add__day = mysqli_query($link, "INSERT INTO $d(`data`, `start`, `obed`, `finishobed`, `finish`) VALUES ('{$pp}', '1', '0', '0', '0' )");
		// $add__start_obed = mysqli_query($link, "UPDATE $d SET `obed` = '1' WHERE `data` = '{$pp}'");
		// $add__end_obed = mysqli_query($link, "UPDATE $d SET `finishobed` = '1' WHERE `data` = '{$pp}'");
		// $add__end_day = mysqli_query($link, "UPDATE $d SET `finishobed` = '1' WHERE `data` = '{$pp}'");

		$result_check__end_day = mysqli_query($link, $check__end_day);
		$result_check__end_obed = mysqli_query($link, $check__end_obed);
		$result_check__start_obed = mysqli_query($link, $check__start_obed);
		$result_check__start_day = mysqli_query($link, $check__start_day);
		$result_check__day = mysqli_query($link, $check__day);


		if (mysqli_num_rows($result_check__end_day) == 1) {
			echo ('yes');
		} else {
			if (mysqli_num_rows($result_check__end_obed) == 1) {
				$add__end_day = mysqli_query($link, "UPDATE $d SET `finish` = '1' WHERE `data` = '{$pp}'");
			} else {
				if (mysqli_num_rows($result_check__start_obed) == 1) {
					$add__end_obed = mysqli_query($link, "UPDATE $d SET `finishobed` = '1' WHERE `data` = '{$pp}'");
				} else {
					if (mysqli_num_rows($result_check__start_day) == 1) {
						$add__start_obed = mysqli_query($link, "UPDATE $d SET `obed` = '1' WHERE `data` = '{$pp}'");
					} else {
						if (mysqli_num_rows($result_check__day) == 0) {
							$add__day = mysqli_query($link, "INSERT INTO $d(`data`, `start`, `obed`, `finishobed`, `finish`) VALUES ('{$pp}', '1', '0', '0', '0' )");
						}
						//  else {}
					}
				}
			}
		}

		?>

	<?php else : ?>
		<h1>Please Login or SignUp</h1>

		<a href="login.php">Login</a> or
		<a href="signup.php">SignUp</a>
	<?php endif; ?>

	<script>
		window.location.href = 'index.php';
	</script>
</body>

</html>