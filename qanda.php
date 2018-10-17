<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>建立題目</title>
	<script src="project/jquery-3.3.1.min.js"></script>
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;

	}
	</style>
</head>
<body>

<div id="container">
	<h1>Create New Q&A</h1>

	<div id="body">
		<form action="insertion.php" method="post" accept-charset="utf8">
			<div>
				Unit :
					<input type="text" name="Unit" value="" placeholder="輸入單元代號">
			</div>
			<div>
				QID:<br>
				<select name = "QID">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<div>
				Question :
				<textarea cols = "100"  rows = "1" name="question" placeholder="輸入題目"></textarea>
				<p>
				Option1 :
				<textarea cols = "50" rows = "1" name="Option1" placeholder="選項一"></textarea>
				<p>
				Option2 :
				<textarea cols = "50" rows = "1" name="Option2" placeholder="選項二"></textarea>
				<p>
				Option3 :
				<textarea cols = "50" rows = "1" name="Option3" placeholder="選項三"></textarea>
				<p>
				Option4 :
				<textarea cols = "50" rows = "1" name="Option4" placeholder="選項四"></textarea>
			</div>
			<div>
        		Answer:<br>
        		<select name="answer">
					<option value="Option1">選項一</option>
					<option value="Option2">選項二</option>
					<option value="Option3">選項三</option>
					<option value="Option4">選項四</option>
				</select>
			</div>
        	<input type="submit" value="建立">
        </form>
	</div>
</div>



</body>
</html>
