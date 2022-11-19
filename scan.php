<!DOCTYPE html>
<html>

<head>
	<title>QR Code Reader using Instascan</title>
</head>

<body>
	<style>
		#preview {
			width: 300px;
			min-height: 500px;
			margin: 0px auto;
		}
	</style>
	<video id="preview"></video>
	<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

	<div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
		<label class="btn btn-primary active">
			<input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
		</label>
		<label class="btn btn-secondary">
			<input type="radio" name="options" value="2" autocomplete="off"> Back Camera
		</label>
	</div>
</body>

</html>