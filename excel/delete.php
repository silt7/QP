<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Удаление прайса</title>
</head>
<body>
<?php
	if($_POST["del_m"]){
		if (file_exists("price_module.xlsx")) { 
			unlink("price_module.xlsx");
			echo "Файл удален!";
		}
		else{
			echo "Прайс Модулей не загружен!";
		}
	}
	if($_POST["del_f"]){
		if (file_exists("price_example.xlsx")) { 
			unlink("price_example.xlsx");
			echo "Файл удален!";
		}
		else{
			echo "Прайс Фасадов не загружен!";
		}
	}
?>
<br><a href="" onclick="javascript:history.back();">Назад</a>
</body>
</html>