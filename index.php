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
<?php $d = $user['email'];	?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!-- <link rel="stylesheet" href="assets/css/main.css"> -->
	<style>
		@font-face {
			font-family: "Segoe UI";
			src: url("../SegoeUI/SegoeUI.ttf");
		}

		* {
			padding: 0;
			margin: 0;
			border: 0;
		}

		*,
		*:before,
		*:after {
			box-sizing: border-box;
		}

		:focus,
		:active {
			outline: none;
		}

		a:focus,
		a:active {
			outline: none;
		}

		nav,
		footer,
		header,
		aside {
			display: block;
		}

		html,
		body {
			height: 100%;
			width: 100%;
			font-size: 100%;
			line-height: 1;
			font-size: 14px;
			-ms-text-size-adjust: 100%;
			-moz-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}

		input,
		button,
		textarea {
			font-family: inherit;
		}

		input::-ms-clear {
			display: none;
		}

		button {
			cursor: pointer;
		}

		button::-moz-focus-inner {
			padding: 0;
			border: 0;
		}

		a,
		a:visited {
			text-decoration: none;
		}

		a:hover {
			text-decoration: none;
		}

		ul li {
			list-style-type: none;
		}

		img {
			vertical-align: top;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			font-size: inherit;
			font-weight: 400;
		}


		.container {
			width: 100%;
			height: 100%;
			background-color: #1e1e1e;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			align-items: center;
		}

		/* 
		#preview {
			border-radius: 15px;
			width: 100vw;
			position: absolute;
			left: 0;
			max-height: 50%;
			height: 100%;
			z-index: 1;
		} */

		.qr {
			width: 280px;
			height: 300px;
			background-color: #333333;
			border-radius: 25px;
			margin-top: 46px;
			display: flex;
			justify-content: center;
			align-items: center;
			position: relative;
			z-index: 8;
		}

		.qr__scanner {
			position: absolute;
			height: 100%;
			top: -380px;
		}

		.qr__outside {
			width: 211px;
			height: 213px;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			border-radius: 15px;
			top: 45px;
			top: 300px;
		}

		.qr__outside-first,
		.qr__outside-second {
			display: flex;
			justify-content: space-between;
		}

		.qr__first-left {
			width: 44px;
			height: 44px;
			border-top: 2px solid #fff;
			border-left: 2px solid #fff;
			border-radius: 15px 0 0 0;
		}

		.qr__first-right {
			width: 44px;
			height: 44px;
			border-top: 2px solid #fff;
			border-right: 2px solid #fff;
			border-radius: 0 15px 0 0;
		}

		.qr__second-left {
			width: 44px;
			height: 44px;
			border-bottom: 2px solid #fff;
			border-left: 2px solid #fff;
			border-radius: 0 0 0 15px;
		}

		.qr__second-right {
			width: 44px;
			height: 44px;
			border-bottom: 2px solid #fff;
			border-right: 2px solid #fff;
			border-radius: 0 0 15px 0;
		}

		.links {
			width: 100%;
			height: 253px;
			background-color: #333333;
			border-radius: 15px 15px 0 0;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			padding: 22px 20px 22px;
		}

		.links__title {
			font-family: "Segoe UI";
			font-style: normal;
			font-weight: 600;
			font-size: 32px;
			line-height: 43px;
			/* identical to box height */
			color: #FFFFFF;
		}

		.links__block {
			width: 100%;
			display: flex;
			justify-content: space-between;
		}

		.links__item {
			width: 23%;
		}

		.links__container {
			background: #282828;
			border-radius: 15px;
			height: 94px;
			display: flex;
			justify-content: center;
			align-items: center;
			margin-bottom: 10px;
		}

		.links__name {
			font-family: "Segoe UI";
			font-style: normal;
			font-weight: 400;
			font-size: 14px;
			line-height: 19px;
			text-align: center;
			color: #959595;
		}

		#preview {
			width: 100%;
			height: 100%;
		}
	</style>
	<?php
	$pp = date("Y-m-d");

	$host = 'localhost';  // Хост, у нас все локально
	$user = 'root';    // Имя созданного вами пользователя
	$pass = ''; // Установленный вами пароль пользователю
	$db_name = 'php_login_database';   // Имя базы данных
	$link = mysqli_connect($host, $user, $pass, $db_name);
	$check__end_day = "SELECT * FROM $d WHERE `finish` = '1'";
	$check__day = "SELECT *  FROM $d WHERE `data` = '{$pp}'";
	$check__start_day = "SELECT * FROM $d WHERE `start` = '1'";
	$check__start_obed = "SELECT * FROM $d WHERE `obed` = '1'";
	$check__end_obed = "SELECT * FROM $d WHERE `finishobed` = '1'";
	$result_check__end_day = mysqli_query($link, $check__end_day);
	$result_check__end_obed = mysqli_query($link, $check__end_obed);
	$result_check__start_obed = mysqli_query($link, $check__start_obed);
	$result_check__start_day = mysqli_query($link, $check__start_day);
	$result_check__day = mysqli_query($link, $check__day);
	if (mysqli_num_rows($result_check__end_day) == 1) {
		echo ('');
	} else {
		if (mysqli_num_rows($result_check__end_obed) == 1) {
			echo ("<style>
		.end__day {
			border: 3px solid #FFFFFF;border-radius: 15px;
border-radius: 15px;		}
	</style>");
		} else {
			if (mysqli_num_rows($result_check__start_obed) == 1) {
				echo ("<style>
		.end__obed {
			border: 3px solid #FFFFFF;border-radius: 15px;
border-radius: 15px;		}
	</style>");
			} else {
				if (mysqli_num_rows($result_check__start_day) == 1) {
					echo ("<style>
		.start__obed {
			border: 3px solid #FFFFFF;border-radius: 15px;
border-radius: 15px;		}
	</style>");
				} else {
					if (mysqli_num_rows($result_check__day) == 0) {
						echo ("<style>
		.start__day {
			border: 3px solid #FFFFFF;border-radius: 15px;
border-radius: 15px;		}
	</style>");
					}
					// else {}
				}
			}
		}
	} ?>
</head>

<body>
	<div class="container">
		<video id="preview"></video>

		<div class="qr">
			<div class="qr__scanner">



				<div class="qr__outside">
					<div class="qr__outside-first">
						<div class="qr__first-left"></div>
						<div class="qr__first-right"></div>
					</div>
					<div class="qr__outside-second">
						<div class="qr__second-left"></div>
						<div class="qr__second-right"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="links">
			<div class="links__title">Отметить...</div>
			<div class="links__block">
				<div class="links__item ">
					<div class="links__container start__day">
						<div class="links__icon">
							<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M13.3333 20H26.6666M20 26.6667V13.3334M15 36.6667H25C33.3333 36.6667 36.6666 33.3334 36.6666 25V15C36.6666 6.66671 33.3333 3.33337 25 3.33337H15C6.66665 3.33337 3.33331 6.66671 3.33331 15V25C3.33331 33.3334 6.66665 36.6667 15 36.6667Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							</svg>

						</div>
					</div>
					<div class="links__name ">Начало <br> работы</div>
				</div>
				<div class="links__item ">
					<div class="links__container start__obed">
						<div class="links__icon"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5.01672 18.7V26.1833C5.01672 33.6666 8.01672 36.6666 15.5001 36.6666H24.4834C31.9667 36.6666 34.9667 33.6666 34.9667 26.1833V18.7" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M20 20C23.05 20 25.3 17.5167 25 14.4667L23.9 3.33337H16.1166L15 14.4667C14.7 17.5167 16.95 20 20 20Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M30.5167 20C33.8834 20 36.35 17.2667 36.0167 13.9167L35.55 9.33337C34.95 5.00004 33.2834 3.33337 28.9167 3.33337H23.8334L25 15.0167C25.2834 17.7667 27.7667 20 30.5167 20ZM9.40005 20C12.15 20 14.6334 17.7667 14.9 15.0167L15.2667 11.3334L16.0667 3.33337H10.9834C6.61672 3.33337 4.95005 5.00004 4.35005 9.33337L3.90005 13.9167C3.56671 17.2667 6.03338 20 9.40005 20ZM20 28.3334C17.2167 28.3334 15.8334 29.7167 15.8334 32.5V36.6667H24.1667V32.5C24.1667 29.7167 22.7834 28.3334 20 28.3334Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
					</div>
					<div class="links__name">Обед</div>
				</div>
				<div class="links__item ">
					<div class="links__container end__obed">
						<div class="links__icon"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M36.6167 30.55C36.6167 31.15 36.4834 31.7667 36.2 32.3667C35.9167 32.9667 35.55 33.5334 35.0667 34.0667C34.25 34.9667 33.35 35.6167 32.3334 36.0334C31.3334 36.45 30.25 36.6667 29.0834 36.6667C27.3834 36.6667 25.5667 36.2667 23.65 35.45C21.7334 34.6334 19.8167 33.5334 17.9167 32.15C15.9802 30.7335 14.1529 29.1736 12.45 27.4834C10.7647 25.7867 9.21021 23.9648 7.80004 22.0334C6.43337 20.1334 5.33337 18.2334 4.53337 16.35C3.73337 14.45 3.33337 12.6334 3.33337 10.9C3.33337 9.76671 3.53337 8.68337 3.93337 7.68337C4.33337 6.66671 4.96671 5.73337 5.85004 4.90004C6.91671 3.85004 8.08337 3.33337 9.31671 3.33337C9.78337 3.33337 10.25 3.43337 10.6667 3.63337C11.1 3.83337 11.4834 4.13337 11.7834 4.56671L15.65 10.0167C15.95 10.4334 16.1667 10.8167 16.3167 11.1834C16.4667 11.5334 16.55 11.8834 16.55 12.2C16.55 12.6 16.4334 13 16.2 13.3834C15.9834 13.7667 15.6667 14.1667 15.2667 14.5667L14 15.8834C13.8167 16.0667 13.7334 16.2834 13.7334 16.55C13.7334 16.6834 13.75 16.8 13.7834 16.9334C13.8334 17.0667 13.8834 17.1667 13.9167 17.2667C14.2167 17.8167 14.7334 18.5334 15.4667 19.4C16.2167 20.2667 17.0167 21.15 17.8834 22.0334C18.7834 22.9167 19.65 23.7334 20.5334 24.4834C21.4 25.2167 22.1167 25.7167 22.6834 26.0167C22.7667 26.05 22.8667 26.1 22.9834 26.15C23.1167 26.2 23.25 26.2167 23.4 26.2167C23.6834 26.2167 23.9 26.1167 24.0834 25.9334L25.35 24.6834C25.7667 24.2667 26.1667 23.95 26.55 23.75C26.9334 23.5167 27.3167 23.4 27.7334 23.4C28.05 23.4 28.3834 23.4667 28.75 23.6167C29.1167 23.7667 29.5 23.9834 29.9167 24.2667L35.4334 28.1834C35.8667 28.4834 36.1667 28.8334 36.35 29.25C36.5167 29.6667 36.6167 30.0834 36.6167 30.55V30.55Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" />
							</svg>
						</div>
					</div>
					<div class="links__name">Перекур</div>
				</div>
				<div class="links__item ">
					<div class="links__container end__day">
						<div class="links__icon"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M15 36.6667H25C33.3334 36.6667 36.6667 33.3334 36.6667 25V15C36.6667 6.66671 33.3334 3.33337 25 3.33337H15C6.66671 3.33337 3.33337 6.66671 3.33337 15V25C3.33337 33.3334 6.66671 36.6667 15 36.6667Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
								<path d="M12.9166 20L17.6333 24.7167L27.0833 15.2833" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
							</svg>
						</div>
					</div>
					<div class="links__name">Конец работы</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

	<script type="text/javascript">
		var scanner = new Instascan.Scanner({
			video: document.getElementById('preview'),
			scanPeriod: 5,
			mirror: false
		});
		scanner.addListener('scan', function(content) {
			let a = content
			let now = '<?php echo  time(); ?>';

			if ((now - a) > 60) {
				window.location.href = '_blank';

			} else {
				window.location.href = 'index.php';

			}
		});
		Instascan.Camera.getCameras().then(function(cameras) {
			if (cameras.length > 0) {
				scanner.start(cameras[0]);
				$('[name="options"]').on('change', function() {
					if ($(this).val() == 1) {
						if (cameras[0] != "") {
							scanner.start(cameras[0]);
						} else {
							alert('No Front camera found!');
						}
					} else if ($(this).val() == 2) {
						if (cameras[1] != "") {
							scanner.start(cameras[1]);
						} else {
							alert('No Back camera found!');
						}
					}
				});
			} else {
				console.error('No cameras found.');
				alert('No cameras found.');
			}
		}).catch(function(e) {
			console.error(e);
			// alert(e);
		});
	</script>
</body>

</html>