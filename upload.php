<?php

// начиная с версии PHP 5.3.0 можно использовать безымянные функции
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});



$cdb= "mysql:host=127.0.0.1;dbname=upload;charset=utf8";


// A list of permitted file extensions
$allowed = array('txt');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}

	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'])){
		//$filearr=file('uploads/'.$_FILES['upl']['name']);

		$myfile = fopen('uploads/'.$_FILES['upl']['name'], "r") or die("Unable to open file!");
        // Output one line until end-of-file
		$lines[]=[];
		while(!feof($myfile)) {
			$lines[]=fgets($myfile);
		}
		fclose($myfile);
        tools::filedel('uploads/'.$_FILES['upl']['name']);

        $pdo = tools::initMySqlCon($cdb);



        $art = c_article::parse($lines);
        if($art -> save( $pdo))
		    echo '{"status":"success"}';
        else
            echo '{"status":"error"}';

		exit;
	}
}

echo '{"status":"error"}';
exit;