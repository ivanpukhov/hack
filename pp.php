<?php


$host = 'localhost';  // Хост, у нас все локально
$user = 'root';    // Имя созданного вами пользователя
$pass = ''; // Установленный вами пароль пользователю
$db_name = 'php_login_database';   // Имя базы данных
$link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой

// Ругаемся, если соединение установить не удалось
if (!$link) {
	echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
	exit;
}
$pp = date("Y-m-d");

$check__end_day = "SELECT * FROM `test` WHERE `finish` = '1'";
$check__end_obed = "SELECT * FROM `test` WHERE `finishobed` = '1'";
$check__start_obed = "SELECT * FROM `test` WHERE `obed` = '1'";
$check__start_day = "SELECT * FROM `test` WHERE `start` = '1'";
$check__day = "SELECT *  FROM `test` WHERE `data` = '{$pp}'";

// $add__day = mysqli_query($link, "INSERT INTO `test`(`data`, `start`, `obed`, `finishobed`, `finish`) VALUES ('{$pp}', '1', '0', '0', '0' )");
// $add__start_obed = mysqli_query($link, "UPDATE `test` SET `obed` = '1' WHERE `data` = '{$pp}'");
// $add__end_obed = mysqli_query($link, "UPDATE `test` SET `finishobed` = '1' WHERE `data` = '{$pp}'");
// $add__end_day = mysqli_query($link, "UPDATE `test` SET `finishobed` = '1' WHERE `data` = '{$pp}'");


$result_check__end_day = mysqli_query($link, $check__end_day);
$result_check__end_obed = mysqli_query($link, $check__end_obed);
$result_check__start_obed = mysqli_query($link, $check__start_obed);
$result_check__start_day = mysqli_query($link, $check__start_day);
$result_check__day = mysqli_query($link, $check__day);


if (mysqli_num_rows($result_check__end_day) == 1) {
	echo ('yes');
} else {
	if (mysqli_num_rows($result_check__end_obed) == 1) {
		$add__end_day = mysqli_query($link, "UPDATE `test` SET `finish` = '1' WHERE `data` = '{$pp}'");
	} else {
		if (mysqli_num_rows($result_check__start_obed) == 1) {
			$add__end_obed = mysqli_query($link, "UPDATE `test` SET `finishobed` = '1' WHERE `data` = '{$pp}'");
		} else {
			if (mysqli_num_rows($result_check__start_day) == 1) {
				$add__start_obed = mysqli_query($link, "UPDATE `test` SET `obed` = '1' WHERE `data` = '{$pp}'");
			} else {
				if (mysqli_num_rows($result_check__day) == 0) {
					$add__day = mysqli_query($link, "INSERT INTO `test`(`data`, `start`, `obed`, `finishobed`, `finish`) VALUES ('{$pp}', '1', '0', '0', '0' )");
				}
				//  else {}
			}
		}
	}
}
