

<?php
$debug=TRUE;
$autoClean=TRUE;
set_time_limit(200);

//variable containing the path to the User temporary data must mach the UserData in script.js
$UserData = "./UserData";

//variable containing the path to zeno executable
$zeno = "echo";
//$zeno = "/home/tlafarge/SharedWorkspace/ZENO-master/src/cpp/zeno";


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


	$params = array();
	parse_str($_POST["data"], $params);

	foreach($params as $key => $value) {
		//	if (!is_array($value))
		$params[$key] = htmlentities($value, ENT_QUOTES);
	}
	if($debug)
	var_dump($params);

	$session = substr(hash("sha256",session_id().date('h:i:s')), 0, 8);
	if($debug)
	echo "{$session}<br />";


	//Checking of the parameters
	if (!preg_match("/^[0-9]+?$/",preg_replace('/\s+/', '',$params["seed"])))
	{
		echo "<pre>The random number generator seed is not a valid number <br /></pre>";
		$validInputs=FALSE;
	}
	if (preg_replace('/\s+/', '',$params["output1"]) == '')
	{
		echo "<pre>No molecular data TODO <br /></pre>";
		$validInputs=FALSE;
	}

	if($debug)
	var_dump($validInputs);

	if($validInputs)
	{
		$folder = "{$UserData}/{$session}";
		$oldmask=umask(0);
		if(!file_exists ( $folder ))
		mkdir($folder, 0755);
		umask($oldmask);

		$bodFileArray = array();
		$outputStrings = explode(PHP_EOL, $params["output1"]);
		$outputOptStrings =array();
		$optWord = array(
			"rlaunch",
			"st",
			"hunits",
			"temp",
			"mass",
			"viscosity",
			"bf"
		);
		foreach ($outputStrings as $outputLine)
		{
			$outputLine = trim(preg_replace('!\s+!', ' ', $outputLine));
			$firstWord = strtolower(trim(explode(' ',$outputLine)[0]));

			if($firstWord == 'sphere')
			{
				$outputLine=strtolower($outputLine);
				$bodFileArray[]="{$outputLine}\r\n";
			}

			if(	in_array($firstWord, $optWord, true))
			{
				$outputOptStrings[]=$outputLine;
			}

		}

		if($params['advParamValue']=="1" && trim($params['rlaunch']) !='')
		{
			$bodFileArray[]="rlaunch ".trim($params['rlaunch'])."\r\n";
		}
		else
		{
			foreach ($outputOptStrings as $outputLine)
			{
				$firstWord = strtolower(trim(explode(' ',$outputLine)[0]));
				if($firstWord == 'rlaunch')
				{
					$bodFileArray[]="{$outputLine}\r\n";
				}

			}
		}

		if($params['advParamValue']=="1" && trim($params['skinT']) !='')
		{
			$bodFileArray[]="st ".trim($params['skinT'])."\r\n";
		}
		else
		{
			foreach ($outputOptStrings as $outputLine)
			{
				$firstWord = strtolower(trim(explode(' ',$outputLine)[0]));
				if($firstWord == 'st')
				{
					$bodFileArray[]="{$outputLine}\r\n";
				}

			}
		}
		if($params['optParam']=="1" && trim($params['hunits']) !='')
		{
			$bodFileArray[]="hunits ".trim($params['hunits'])." ".$params['hunitsType']."\r\n";
		}
		else
		{
			foreach ($outputOptStrings as $outputLine)
			{
				$firstWord = strtolower(trim(explode(' ',$outputLine)[0]));
				if($firstWord == 'hunits')
				{
					$bodFileArray[]="{$outputLine}\r\n";
				}

			}
		}
		if($params['optParam']=="1" && trim($params['temp']) !='')
		{
			$bodFileArray[]="temp ".trim($params['temp'])." ".$params['tempType']."\r\n";
		}
		else
		{
			foreach ($outputOptStrings as $outputLine)
			{
				$firstWord = strtolower(trim(explode(' ',$outputLine)[0]));
				if($firstWord == 'temp')
				{
					$bodFileArray[]="{$outputLine}\r\n";
				}

			}
		}
		if($params['optParam']=="1" && trim($params['mass']) !='')
		{
			$bodFileArray[]="mass ".trim($params['mass'])." ".$params['massType']."\r\n";
		}
		else
		{
			foreach ($outputOptStrings as $outputLine)
			{
				$firstWord = strtolower(trim(explode(' ',$outputLine)[0]));
				if($firstWord == 'mass')
				{
					$bodFileArray[]="{$outputLine}\r\n";
				}

			}
		}
		if($params['optParam']=="1" && trim($params['viscosity']) !='')
		{
			$bodFileArray[]="viscosity ".trim($params['viscosity'])." ".$params['viscosityType']."\r\n";
		}
		else
		{
			foreach ($outputOptStrings as $outputLine)
			{
				$firstWord = strtolower(trim(explode(' ',$outputLine)[0]));
				if($firstWord == 'viscosity')
				{
					$bodFileArray[]="{$outputLine}\r\n";
				}

			}
		}
		if($params['optParam']=="1" && trim($params['buoyancy']) !='')
		{
			$bodFileArray[]="buoyancy ".trim($params['buoyancy'])."\r\n";
		}
		else
		{
			foreach ($outputOptStrings as $outputLine)
			{
				$firstWord = strtolower(trim(explode(' ',$outputLine)[0]));
				if($firstWord == 'buoyancy')
				{
					$bodFileArray[]="{$outputLine}\r\n";
				}

			}
		}



		var_dump($bodFileArray);
		var_dump($outputOptStrings);

		file_put_contents ( "$folder/input.bod" , $bodFileArray );
		$cmdline = ' --input-file='.$folder."/input.bod".' --num-threads=1';

		if($params['extRad']=="nbWalk")
		{
			$cmdline = $cmdline.' --num-walks='.$params['nbWalk'];
		}
		if($params['extRad']=="sdCap")
		{
			$cmdline = $cmdline.' --max-rsd-capacitance='.$params['sdCap'];
			$cmdline = $cmdline.' --min-num-walks='.$params['minNbWalkCap'];
		}
		if($params['extRad']=="sdPol")
		{
			$cmdline = $cmdline.' --max-rsd-polarizability='.$params['sdPol'];
			$cmdline = $cmdline.' --min-num-walks='.$params['minNbWalkPol'];
		}
		if($params['intRad']=="nbSamples")
		{
			$cmdline = $cmdline.' --num-interior-samples='.$params['nbSamples'];
		}
		if($params['intRad']=="sdVol")
		{
			$cmdline = $cmdline.' --max-rsd-volume='.$params['sdVol'];
			$cmdline = $cmdline.' --min-num-interior-samples='.$params['minNbSample'];
		}

		if(isset($params['seed']))
		{
			$cmdline = $cmdline.' --seed='.$params['seed'];
		}
		if($params['advParamValue']=="1" && isset($params['hitPoints']))
		{
			$cmdline = $cmdline.' --print-counts';
		}
		if($params['advParamValue']=="1" && isset($params['ram']))
		{
			$cmdline = $cmdline.' --print-benchmarks';
		}
		if($params['advParamValue']=="1" && isset($params['surfacePoints']))
		{
			$cmdline = $cmdline.' --surface-points-file='.$folder."/SurfacePoints.txt";
		}
		if($params['advParamValue']=="1" && isset($params['interiorPoints']))
		{
			$cmdline = $cmdline.' --interior-points-file='.$folder."/InteriorPoints.txt";
		}



		echo "<br />comand line {$zeno} {$cmdline}<br />";

		exec($zeno.$cmdline,$zenoOutput);

		foreach($zenoOutput as $child) {
			echo $child . "<br />";
		}

	}


}
else
{
	echo 'POST file error, no DATA was provided';
}

?>
