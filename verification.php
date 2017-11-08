
<?php
//Checking of the parameters
if (preg_replace('/\s+/', '',$params["output1"]) == '')
{
  echo "<pre>No molecular data<br /></pre>";
  $validInputs=FALSE;
}
if ($params['extRad']=="nbWalk" && !preg_match("/^[0-9]+?$/",$params["nbWalk"]))
{
  echo "<pre>Number of exterior walks: '".$params["nbWalk"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['extRad']=="sdCap" && !preg_match("/^[0-9]*\.?[0-9]+$/",$params["sdCap"]))
{
  echo "<pre>Maximum relative standard deviation of capacitance: '".$params["sdCap"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['extRad']=="sdCap" && !preg_match("/^[0-9]+?$/",$params["minNbWalkCap"]))
{
  echo "<pre>Minimum number of exterior walks: '".$params["minNbWalkCap"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['extRad']=="sdPol" && !preg_match("/^[0-9]*\.?[0-9]+$/",$params["sdPol"]))
{
  echo "<pre>Maximum relative standard deviation of electric polarixability: '".$params["sdPol"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['extRad']=="sdPol" && !preg_match("/^[0-9]+?$/",$params["minNbWalkPol"]))
{
  echo "<pre>Minimum number of exterior walks: '".$params["minNbWalkPol"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['intRad']=="nbSamples" && !preg_match("/^[0-9]+?$/",$params["nbSamples"]))
{
  echo "<pre>Number of interior samples: '".$params["nbSamples"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['intRad']=="sdVol" && !preg_match("/^[0-9]*\.?[0-9]+$/",$params["sdVol"]))
{
  echo "<pre>Maximum relative standard deviation of capacitance: '".$params["sdVol"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['intRad']=="sdVol" && !preg_match("/^[0-9]+?$/",$params["minNbSample"]))
{
  echo "<pre>Minimum number of interior samples: '".$params["minNbSample"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['hunits']!='' && !preg_match("/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/",$params["hunits"]))
{
  echo "<pre>Units for length: '".$params["hunits"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['temp']!='' && !preg_match("/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/",$params["temp"]))
{
  echo "<pre>Temperature: '".$params["temp"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['mass']!='' && !preg_match("/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/",$params["mass"]))
{
  echo "<pre>Mass: '".$params["mass"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['viscosity']!='' && !preg_match("/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/",$params["viscosity"]))
{
  echo "<pre>Solvent Viscosity: '".$params["viscosity"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['buoyancy']!='' && !preg_match("/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/",$params["buoyancy"]))
{
  echo "<pre>Buoyancy factor: '".$params["buoyancy"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['rlaunch']!='' && !preg_match("/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/",$params["rlaunch"]))
{
  echo "<pre>Custom launch radius: '".$params["rlaunch"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['skinT']!='' && !preg_match("/^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$/",$params["skinT"]))
{
  echo "<pre>Custom skin thickness: '".$params["skinT"]."' is not valid <br /></pre>";
  $validInputs=FALSE;
}
if ($params['seed']!='' && !preg_match("/^[0-9]+?$/",preg_replace('/\s+/', '',$params["seed"])))
{
  echo "<pre>The random number generator seed is not a valid number <br /></pre>";
  $validInputs=FALSE;
}
//If inputs are still valid we perform the mathematical check
if($validInputs)
{
  if ($params['extRad']=="nbWalk" && ($params["nbWalk"] < 1000 || $params["nbWalk"] > 5000000 ) )
  {
    echo "<pre>Number of exterior walks should be betwenn 1000 and 5000000 <br /></pre>";
    $validInputs=FALSE;
  }
  if ($params['extRad']=="sdCap" && $params["sdCap"]<=0)
  {
    echo "<pre>Maximum relative standard deviation of capacitance must be positive <br /></pre>";
    $validInputs=FALSE;
  }
  if ($params['extRad']=="sdCap" && ($params["minNbWalkCap"] < 1 || $params["minNbWalkCap"] > 5000000 ))
  {
    echo "<pre>Minimum number of exterior walks: should be betwenn 1 and 5000000 <br /></pre>";
    $validInputs=FALSE;
  }
  if ($params['extRad']=="sdPol" && $params["sdPol"]<=0 )
  {
    echo "<pre>Maximum relative standard deviation of electric polarixability must be positive <br /></pre>";
    $validInputs=FALSE;
  }
  if ($params['extRad']=="sdPol" && ($params["minNbWalkPol"] < 1 || $params["minNbWalkPol"] > 5000000 ))
  {
    echo "<pre>Minimum number of exterior walks should be betwenn 1 and 5000000 <br /></pre>";
    $validInputs=FALSE;
  }
  if ($params['intRad']=="nbSamples" && ($params["nbSamples"] < 1000 || $params["nbSamples"] > 5000000 ))
  {
    echo "<pre>Number of interior samples  should be betwenn 1000 and 5000000 <br /></pre>";
    $validInputs=FALSE;
  }
  if ($params['intRad']=="sdVol" && $params["sdVol"]<=0 )
  {
    echo "<pre>Maximum relative standard deviation of capacitance  must be positive <br /></pre>";
    $validInputs=FALSE;
  }
  if ($params['intRad']=="sdVol" && ($params["minNbSample"] < 1 || $params["minNbSample"] > 5000000 ))
  {
    echo "<pre>Minimum number of interior samples should be betwenn 1 and 5000000 <br /></pre>";
    $validInputs=FALSE;
  }
  if ($params['rlaunch']!='' && $params["rlaunch"] <= 0 )
  {
    echo "<pre>Custom launch radius must be positive <br /></pre>";
    $validInputs=FALSE;
  }
  if ($params['skinT']!='' && $params["skinT"] <= 0 )
  {
    echo "<pre>Custom skin thickness must be positive <br /></pre>";
    $validInputs=FALSE;
  }

}
?>
