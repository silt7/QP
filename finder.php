<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <title>Скрипт поиска символов в файлах</title>
 </head>
 <body> 
 
<?php
if(!isset($_POST['go'])){

	echo '<form method="post" action="finder.php">
	<h1>Скрипт поиска символов в файлах</h1>
	Ищем эту фразу*:
	<input type="text" name="from" value="">
	<Br>
	Максимальный размер файлов для замены (1мб):
	<input type="text" name="size" value="1000000">
	<Br><br>
	<input type="submit" value="Все готово! Начать!"><input type="text" name="go" value="1" hidden></form>';
	
}else{

	echo '<br><br>----------------------[ Замена фразы в содержимом файлов ]----------------------';
	
	$text = $_POST['from']; // что заменяем
	$filemaxsize = $_POST['size'];//1mb максимальный размер файла
	$uncheckfile = 'finder.php'; //файл, который не трогаем
	$filesnums = 0;//стартовое число файлов
	$dirname = __DIR__; //папка, в которой ищем файлы рекурсивно (т.е. и в подпапках)

	scan_dir($dirname);
	
	//выдаём ответ
	echo '<br>Фраза "'.htmlspecialchars($text, ENT_QUOTES).'" найдена в '.$filesnums.' файлах(е) в папке '.$dirname.' и подпапках';
	if($filesnums > 0) echo '<br><br>Список файлов:<br>';		
	echo $files;

}

function scan_dir($dirname){
	GLOBAL $text,$retext,$uncheckfile,$filemaxsize,$filesnums,$files; 
	$dir = opendir($dirname); 
	while (($file = readdir($dir))!==false){
	  if($file!="."&&$file!= ".."){
		if(is_file($dirname."/".$file)&&strpos($file,$uncheckfile)===false&&filesize($dirname."/".$file)<=$filemaxsize){
		  $content = file_get_contents($dirname."/".$file);
		  if(strpos($content,$text)!==false) {
			  $filesnums++;
			  $files .= $dirname."/<b>".$file."</b><br>";
			  /* Замена	
				$file =  fopen($dirname."/".$file,"w");
				$outfile = str_replace($text,'<li><a href="/" class="link" title="Купить кухню в QP-kuhni">QP-kuhni</a></li>',$content);
				fwrite ($file,$outfile);
				fclose ($file);
			  */
		  }
		}
		if(is_dir($dirname."/".$file))scan_dir($dirname."/".$file); 
	  }
	} 
	closedir($dir);
}

?>
</body>
</html>
