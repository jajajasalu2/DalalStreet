<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div id="show"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function () {
				$('#show').load('data.php')
			}, 1000);
		});
	</script>	
</body>
</html>