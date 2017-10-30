<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
	<title>ZENO GUI</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="library/jquery-ui.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="Uncertainty.ico">
</head>
<body>
	<h3>Zeno Gui</h3>

	<div id="tabs">
		<ul id="tabsul">
			<li><a href="#tabs-1">About</a></li>
			<li><a href="#tabs-2">App</a></li>
		</ul>
		<div id="tabs-1">
			<p>The ZENO software tool computes material, solution, and suspension
				properties for a specified particle shape or molecular structure using
				path-integral and Monte Carlo methods. These properties include:
				capacitance, electric polarizability tensor, intrinsic conductivity,
				volume, gyration tensor, hydrodynamic radius, intrinsic viscosity, friction
				coefficient, diffusion coefficient, sedimentation coefficient, and related quantities.</p>
			</div>
			<div id="tabs-2">
				<div id="form">
					<form name="input" id="input"   action="validation.php"   >

						<fieldset  class="bodGroup" >
							<legend>Required inputs</legend>
							<div id="load">
								<div id="drop_zone">Drop Obj file here or click to upload</div>
								<input type='file' title="No file selected" id="files" onchange="pressed()"><label id="fileLabel"> </label>
							</div>


							<div id="bodArea">
								Definition of object file:
								<br/>
								<textarea class='output'  name='output1' id='output1' height=51px ></textarea>
								<br/>
								<button id='displayButton' type="button" onclick=drawDisplay()>Update Object</button>
							</div>


							<div id="container">
								<div id="container-01" class="mol-container"></div>
							</div>


							<div id="Exterior">
								<br/>

								Exterior calculation:
								<div>
									<input type="radio" name="extRad" value="nbWalk" id="nbWalk" checked="checked"/>
									<label for="nbWalk">Number of exterior walks</label>
									<div class="sub1">
										<input name='nbWalk' id='nbWalk' type='text' value='1000000'  >
									</div>
								</div>
								<div>
									<input type="radio" name="extRad" value="sdCap" id="sdCap"/>
									<label for="sdCap">Maximum relative standard deviation of capacitance</label>
									<div class="sub1">
										<input name='sdCap' id='sdCap' type='text' value='0.1'  >
										<br/>
										<label for="minNbWalkCap">Minimum number of exterior walks</label>
										<br/>
										<input name='minNbWalkCap' id='minNbWalkCap' type='text' value='1000'  >
									</div>
								</div>
								<div>
									<input type="radio" name="extRad" value="sdPol" id="sdPol"/>
									<label for="sdPol">Maximum relative standard deviation of electric polarixability</label>
									<div class="sub1">
										<input name='sdPol' id='sdPol' type='text' value='0.1'  >
										<br/>
										<label for="minNbWalkPol">Minimum number of exterior walks</label>
										<br/>
										<input name='minNbWalkPol' id='minNbWalkPol' type='text' value='1000'  >
									</div>
								</div>
								<div>
									<input type="radio" name="extRad" value="None" id="None" />
									<label for="None">None</label>
								</div>


								<br/>

								Interior calculation:
								<div>
									<input type="radio" name="intRad" value="nbSamples" id="nbSamples"/>
									<label for="nbSamples">Number of interior samples</label>
									<div class="sub1">
										<input name='nbSamples' id='nbSamples' type='text' value='1000000'  >
									</div>
								</div>
								<div>
									<input type="radio" name="intRad" value="sdVol" id="sdVol"/>
									<label for="sdVol">Maximum relative standard deviation of volume</label>
									<div class="sub1">
										<input name='sdVol' id='sdVol' type='text' value='0.1'  >
										<br/>
										<label for="minNbSample">Minimum number of exterior walks</label>
										<br/>
										<input name='minNbSample' id='minNbSample' type='text' value='1000' >
									</div>
								</div>
								<div>
									<input type="radio" name="intRad" value="None" id="None" checked="checked"/>
									<label for="None">None</label>
								</div>
							</div>

						</fieldset>

						<fieldset  class="optGroup" >
							<legend onclick="toggleParam();" style="cursor: pointer;">Physical properties specifications</legend>
							<arrowDiv id="arrowDiv" onclick="toggleParam();" style="cursor: pointer;" class="down"></arrowDiv>
							<table id="optionalParam" style="width:50%; display: none;">
								<tr>
									<td  class="tooltip">Units for length: 		  <span class="tooltiptext">Choosing a conversion length of 10 cm means that a length of 1 (arbitrary units) in the input file is equivalent to 10cm. A non-arbitrary value is required for calculation of friction coefficien, diffusion coefficient and sedimentation coefficient</span> </td>
									<td><input name='hunits' id='hunits' type='text' value=''   ></td>
									<td>
										<select id="hunitsType" name="hunitsType">
											<option value="L" selected> L (generic)</option>
											<option value="m"> m (meters)</option>
											<option value="cm"> cm (centimeters)</option>
											<option value="nm"> nm (nanometers)</option>
											<option value="A"> A (Angstroms)</option>
										</select>
										<input name='optParam' id='optParam' type='text' value='0' style=" display: none" >
									</td>
								</tr>
								<tr>
									<td class="tooltip">Temperature:	  <span class="tooltiptext">Required for calculation of the diffusion coefficient</span> </td>
									<td><input name='temp' id='temp' type='text' value=''  ></td>
									<td>
										<select id="tempType" name="tempType">
											<option value="C" selected> C (Celsius)</option>
											<option value="K"> K (Kelvin)</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="tooltip">Mass:	  <span class="tooltiptext">Required for calculation of the intrinsic viscosity with mass units and the sedimentation coefficient </span> </td>
									<td><input name='mass' id='mass' type='text' value=''  ></td>
									<td>
										<select id="massType" name="massType">
											<option value="Da" selected> Da (Daltons)</option>
											<option value="kDa"> kDa (kiloDaltons)</option>
											<option value="g"> g (grams)</option>
											<option value="kg"> kg (kilograms)</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="tooltip">Solvent Viscosity:	  <span class="tooltiptext">Required for calculation of the friction coefficient, the diffusion coefficient and the sedimentation coefficient </span> </td>
									<td><input name='viscosity' id='viscosity' type='text' value=''  ></td>
									<td>
										<select id="viscosityType" name="viscosityType">
											<option value="p" selected> poise </option>
											<option value="cp"> centipoise</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="tooltip">Buoyancy factor:  	  <span class="tooltiptext">Required for calculation of the sedimentation coefficient </span> </td>
									<td><input name='buoyancy' id='buoyancy' type='text' value=''  ></td>
									<td> </td>
								</tr>
							</table>



						</fieldset>
						<fieldset  class="advGroup" >
							<legend onclick="toggleAdv();" style="cursor: pointer;">Advanced features</legend>
							<arrowDiv id="arrowDiv2" onclick="toggleAdv();" style="cursor: pointer;" class="down"></arrowDiv>

							<table id="advParam" style="display: none;">
								<tr>
									<td class="tooltip">Random number generator seed:   	  </td>

									<td><input name='seed' id='seed' type='text' value=''  >					<input name='advParamValue' id='advParamValue' type='text' value='0' style=" display: none" ></td>
									<td> </td>
								</tr>
								<tr>
									<td class="tooltip">Custom launch radius:   </td>
									<td><input name='rlaunch' id='rlaunch' type='text' value=''  ></td>
								</tr>
								<tr>
									<td class="tooltip">Custom skin thickness:  	 </td>
									<td><input name='skinT' id='skinT' type='text' value=''  ></td>
								</tr>


							</table>
							<div id="advParam2" style="display: none;">
								<br/>
								<label><input type="checkbox"  name="hitPoints" id="hitPoints" value="1" /> Print statistics related to counts of hit points </label>
								<br/>
								<label><input type="checkbox"  name="ram" id="ram" value="1" /> Print detailed RAM and timing information</label>
								<br/>
								<label><input type="checkbox"  name="surfacePoints" id="surfacePoints" value="1" /> Print surface points from exterior calculations to a file</label>
								<br/>
								<label><input type="checkbox"  name="interiorPoints" id="interiorPoints" value="1" /> Print interior sample points to a file</label>
							</div>


						</fieldset>

						<br/>



						<input type="submit" value="Run the computation"/>
					</form>
				</div>
			</div>



		</div>
		<script src="library/3Dmol-min.js"></script>

		<script src="library/jquery.js"></script>
		<script src="library/jquery-ui.min.js"></script>
		<script src="script.js"></script>



		<footer id="footer">
			<p>This software was developed at NIST. This software is not subject to copyright protection and is
				in the public domain. This software is an experimental system. NIST assumes
				no responsibility whatsoever for its use by other parties, and makes no
				guarantees, expressed or implied, about its quality, reliability, or
				any other characteristic. We would appreciate acknowledgement if the
				software is used.
				<br/>
				Version 0.1.0
			</p>
		</footer>



	</body>
	</html>
