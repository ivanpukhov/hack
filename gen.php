<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		#qrcode {
			width: 160px;
			height: 160px;
			margin-top: 15px;
		}
	</style>
</head>

<body>

	<div id="qrcode"></div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script>
	<script type="text/javascript">
		var qrcode = new QRCode("qrcode");

		function makeCode() {
			var qr = '/index.html'

			let now = '<?php echo  time(); ?>';
			// var elText = 
			console.log(now)
			qrcode.makeCode(now);
		}

		setTimeout(makeCode, 1)
	</script>
</body>

</html>