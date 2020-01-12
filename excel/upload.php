<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Результат загрузки файла</title>
</head>
<body>
<?php
	if(($_FILES["filename"]["name"] == "price_example.xlsx")or($_FILES["filename"]["name"] == "price_module.xlsx")){
		if($_FILES["filename"]["name"] == "price_example.xlsx"){
			if (file_exists("price_example.xlsx")) { 
				echo "Необходимо удалить старый прайс Фасадов!<br>";
				//unlink("price_example.xlsx");
			}
			else{
			   if($_FILES["filename"]["size"] > 1024*3*1024)
			   {
				 echo ("Размер файла превышает три мегабайта");
				 exit;
			   }
			   // Проверяем загружен ли файл
			   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
			   {
				 // Если файл загружен успешно, перемещаем его
				 // из временной директории в конечную

				 move_uploaded_file($_FILES["filename"]["tmp_name"], $_FILES["filename"]["name"]);
				 echo("Файл успешно загружен");
			   } else {
				  echo("Ошибка загрузки файла");
			   }
			}
		}
		if($_FILES["filename"]["name"] == "price_module.xlsx"){
			if (file_exists("price_module.xlsx")) { 
				echo "Необходимо удалить старый прайс Модулей<br>";
				//unlink("price_example.xlsx");
			}
			else{
			   if($_FILES["filename"]["size"] > 1024*3*1024)
			   {
				 echo ("Размер файла превышает три мегабайта");
				 exit;
			   }
			   // Проверяем загружен ли файл
			   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
			   {
				 // Если файл загружен успешно, перемещаем его
				 // из временной директории в конечную

				 move_uploaded_file($_FILES["filename"]["tmp_name"], $_FILES["filename"]["name"]);
				 echo("Файл успешно загружен");
			   } else {
				  echo("Ошибка загрузки файла");
			   }
			}
		}
	}
	else{
		echo "Имя файла должно быть: price_example.xlsx или price_module.xlsx";
	}
?>
<br><a href="" onclick="javascript:history.back();">Назад</a>
</body>
</html>