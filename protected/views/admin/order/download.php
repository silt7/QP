<? 
        // Выводим HTTP-заголовки
        /*
         header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
         header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
         header ( "Cache-Control: no-cache, must-revalidate" );
         header ( "Pragma: no-cache" );
         header ( "Content-type: application/vnd.ms-excel" );
         header ( "Content-Disposition: attachment; filename=matrix.xls" );
        */
        // Выводим содержимое файла
         $objWriter = new PHPExcel_Writer_Excel5($xls);
         $objWriter->save('php://output');
?>