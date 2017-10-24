<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
		<title>ZENO validation</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="shortcut icon" href="Uncertainty2.ico">
	</head>
	<body>
	<h3>ZENO GUI</h3>
	<pre><br /></pre>
	</body>
</html>

<?php
	$debug=TRUE;
	$autoClean=TRUE;
	set_time_limit(200);

	//variable containing the path to the User temporary data must mach the UserData in script.js
	$UserData = "./UserData";

	//variable containing the path to Rscript executable
	$Rscript = "Rscript";


	if (!empty($_POST))
	{
		//Clean the UserData Folder
		if ($autoClean && $handle = opendir($UserData))
		{
			while (false !== ($file = readdir($handle)))
			{
				if($file!="." && $file!="..")
				{
					$filelastmodified = filemtime("$UserData/$file");
					if((time() - $filelastmodified) > 600)
					{
						//echo " This file is going to be deleted $UserData/$file <br />";
						if ($handle2 = opendir("$UserData/$file"))
						{
							while (false !== ($file2 = readdir($handle2)))
							{
								if($file2!="." && $file2!="..")
								{
									unlink("$UserData/$file/$file2");
								}
							}
							closedir($handle2);
						}
						rmdir("$UserData/$file");
					}
				}
			}
			closedir($handle);
		}

		$validInputs=TRUE;

		foreach($_POST as $key => $value) {
		//	if (!is_array($value))
				$_POST[$key] = htmlentities($value, ENT_QUOTES);
		}

		if($debug)
			var_dump($_POST);


		$session = hash("sha256",session_id().date('h:i:s'));


		if($debug)
			echo "{$session}<br />";


		//Checking of the parameters
		if (!preg_match("/^[0-9]+?$/",preg_replace('/\s+/', '',$_POST["seed"])))
		{
			echo "<pre>The random number generator seed is not a valid number <br /></pre>";
			$validInputs=FALSE;
		}



		if (!preg_match("/^[+]?[0-9]+((\.[0-9]*)?[eE][+-]?[0-9]+)?$/",preg_replace('/\s+/', '',$_POST["nbWalk"])))
		{
			echo "<pre>The number of realizations field is not a valid number <br /></pre>";
			$validInputs=FALSE;
		}



		if($validInputs)
		{
			$folder = "{$UserData}/{$session}";
			$oldmask=umask(0);
			if(!file_exists ( $folder ))
				mkdir($folder, 0755);
			umask($oldmask);



			$array = array(
				"version=0.1\r\n",
				"seed=".preg_replace('/\s+/', '',$_POST["seed"])."\r\n",
				"nbWalk=".preg_replace('/\s+/', '',$_POST["nbWalk"])."\r\n",
			);



			if($debug)
				var_dump($array);


			file_put_contents ( "$folder/config.txt" , $array );
			if($debug)
				echo "<br />zeno ".$UserData."/".$session."/config.um<br />";
		#	exec($Rscript." --verbose launchscript.R ".$UserData."/".$session."/config.um ",$Routput);

		#if($debug)
		#		var_dump($Routput);

			if($debug)
				echo "	<a  href=\"./results.php?id=$session\"> Go to the results Page</a> <br />";

			if(!$debug)
				header( "Location: ./results.php?id=$session" );
		}
		else #not valid input
		{
			echo "	<input type='button' value='Close this window' onclick='self.close()'>";
		}

	}
	else
	{
	    echo 'POST file error, no DATA was provided';
	}


?>
