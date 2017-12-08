//######################################################################
//## SECTION (SPECIFICATION) ===========================================
//######################################################################
//## Javascript code to dynamicaly populate the form and create the
//## associated config file.
//## Also can read from a previous config or load one from the examples
//## ===================================================================


//antiClickjack
if (self === top) {
       var antiClickjack = document.getElementById("antiClickjack");
       antiClickjack.parentNode.removeChild(antiClickjack);
   } else {
       top.location = self.location;
   }

//Colormap
colorRainbow=['#ff0000','#ff1a00','#ff2800','#ff3300','#ff3b00','#ff4300','#ff4a00','#ff5000','#ff5600','#ff5c00','#ff6200','#ff6700','#ff6c00','#ff7100','#ff7500','#ff7a00','#ff7f00','#ff8300','#ff8700','#ff8c00','#ff9000','#ff9400','#ff9800','#ff9c00','#ffa000','#ffa400','#ffa800','#ffac00','#ffb000','#ffb400','#ffb800','#ffbb00','#ffbf00','#ffc300','#ffc700','#ffca00','#ffce00','#ffd200','#ffd500','#ffd900','#ffdd00','#ffe000','#ffe400','#ffe800','#ffeb00','#ffef00','#fff200','#fff600','#fffa00','#fffd00','#fbfc00','#f2f702','#e9f205','#e1ed09','#dae80e','#d2e313','#cbde18','#c5d91d','#bed421','#b8cf25','#b3ca29','#adc52d','#a8c031','#a3bc34','#9fb738','#9bb23c','#97ae3f','#93a943','#90a547','#8ca04b','#899c4e','#879752','#849356','#828f5a','#808b5e','#7d8662','#7c8266','#7a7e6b','#787a6f','#767674','#757279','#736e7e','#716a83','#706688','#6e628e','#6c5e94','#6a5a9a','#6855a0','#6551a6','#624dad','#5f48b4','#5c44bb','#583fc3','#533acb','#4e34d3','#472edb','#3f27e3','#341fec','#2413f6','#0000ff'];

// Initial settings
var seed = Math.floor((Math.random() * 100) + 1);
$('#seed').val(seed.toString());
var viewer = null;
var resultTab=3;
$('#container').css("height","2em");


// Drag an drop files
window.pressed = function(){
  var a = document.getElementById('files');
  if(a.value == "")
  {
    fileLabel.innerHTML = "No file selected";
  }
  else
  {
    var theSplit = a.value.split('\\');
    fileLabel.innerHTML = theSplit[theSplit.length-1];
  }
};

window.pressedI = function(index){
  var a = document.getElementById('files'+(index));
  if(a.value == "")
  {
    fileLabel.innerHTML = "No file selected";
  }
  else
  {
    var theSplit = a.value.split('\\');
    $('#fileLabel'+(index)).html(theSplit[theSplit.length-1]);
  }
};

function handleFileSelect(evt) {
  evt.stopPropagation();
  evt.preventDefault();

  var files = evt.dataTransfer.files; // FileList object.
  fileLabel.innerHTML = files[0].name;

  readBodFile(files[0]);
}

function handleFileSelect2(evt) {
  evt.stopPropagation();
  evt.preventDefault();

  var files = evt.target.files;
  readBodFile(files[0]);
}

function handleDragOver(evt) {
  evt.stopPropagation();
  evt.preventDefault();
  evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
}

// Setup the dnd listeners.
var dropZone = document.getElementById('drop_zone');

$('#drop_zone').click(function(event) {
  $('#files').click();
});

dropZone.addEventListener('dragover', handleDragOver, false);
dropZone.addEventListener('drop', handleFileSelect, false);
document.getElementById('files').addEventListener('change', handleFileSelect2, false);


function readBodFile(file) {
  var ext = (file.name).split('.').pop();
  if(ext=="txt" | ext=="bod")
  {
    var fr = new FileReader();
    fr.onload = function(e) {
      loadData(e.target.result)
    };
    fr.readAsText(file);
  }
  else if(ext=="lnk")
  {
    alert("Shortcut (symbolic link) are not supported, please provide the original file.");
  }
  else
  {
    alert("Only txt and bod files are supported.");
  }

  return;
}

function loadData(lines) {
  $('#output1').val(lines);
  drawDisplay();
}

//Draw Molecule using 3dmol.js
function drawDisplay()
{
  var button = document.getElementById("displayButton");
  button.disabled = true;

  var lines = 	$('#output1').val();

  lines = lines.split(/\r\n|\r|\n/g);
  var sphereDataCenter = [];
  var sphereDataRadius = [];

  for (var i = 0; i < lines.length; i++) {
    var numData=lines[i].match(/[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?/g);
    if( lines[i].toLowerCase().indexOf("sphere") !== -1 && numData != null && numData.length == 4)
    {
      sphereDataCenter.push([parseFloat(numData[0]),parseFloat(numData[1]),parseFloat(numData[2])]);
      sphereDataRadius.push(parseFloat(numData[3]));
    }
  }

  var countsRadius = {};
  var nbRadius = 0
  for (var i = 0; i < sphereDataRadius.length; i++) {
    var num = sphereDataRadius[i];
    if(countsRadius[num]==null)
    {
      nbRadius++;
      countsRadius[num] = nbRadius;
    }
  }

  Object.keys(countsRadius).length
  var colorMap = colorRainbow.filter(function(element, index, array) {
    return (index % Math.floor(colorRainbow.length /  Object.keys(countsRadius).length) === 0);
  });


  if(sphereDataRadius.length > 0)
  {
    let element = $('#container-01');
    $('#container').css("height","25em");

    let config = { backgroundColor: '#f2f2f2' };

    if(viewer == null)
    viewer = $3Dmol.createViewer( element, config );
    else {
      viewer.clear();
    }

    for (var i = 0; i < sphereDataCenter.length; i++)
    {
      viewer.addSphere({ center: {x:sphereDataCenter[i][0], y:sphereDataCenter[i][1], z:sphereDataCenter[i][2]}, radius: sphereDataRadius[i], color: colorMap[countsRadius[sphereDataRadius[i]]-1] });
    }

    viewer.zoomTo();
    viewer.render();
    viewer.zoom(0.8, 200);
  }
  else {
    if(viewer != null)
    viewer.clear();
  }

  button.disabled = false;


}

function toggleParam()
{
  if($('#optParam').val() == "1")
  {
    $("#arrowDiv").attr('class', 'down');
    $('#optionalParam').hide(200);
    $('#optParam').val("0")
  }else {
    $("#arrowDiv").attr('class', 'up');
    $('#optionalParam').show(200);
    $('#optParam').val("1")
  }
}

function toggleAdv()
{
  if($('#advParamValue').val() == "1")
  {
    $("#arrowDiv2").attr('class', 'down');
    $('#advParam').hide(200);
    $('#advParam2').hide(200);
    $('#advParamValue').val("0")
  }else {
    $("#arrowDiv2").attr('class', 'up');
    $('#advParam').show(200);
    $('#advParam2').show(200);

    $('#advParamValue').val("1")
  }
}

function clearOpt()
{
  $('#hunits').val('');
  $('#temp').val('');
  $('#mass').val('');
  $('#viscosity').val('');
  $('#buoyancy').val('');

  $('#hunitsType').val("L");
  $('#tempType').val("C");
  $('#massType').val("Da");
  $('#viscosityType').val("p");
}

function clearAdv()
{
  var seed = Math.floor((Math.random() * 100) + 1);
  $('#seed').val(seed.toString());
  $('#rlaunch').val('');
  $('#skinT').val('');

  $('#hitPoints').attr('checked', false);
  $('#ram').attr('checked', false);
  $('#surfacePoints').attr('checked', false);
  $('#interiorPoints').attr('checked', false);
}


$("#tabs-1").load("about.md.html");
$( "#tabs" ).tabs();
$("#tabs").tabs("option", "active", 1);
$("#tabs").fadeIn(200);


/* attach a submit handler to the form */
$("#input").submit(function(event) {

  /* stop form from submitting normally */
  event.preventDefault();

  /* get some values from elements on the page: */
  var $form = $(this),
  url = $form.attr('action');
  dataString = $("#input").serialize();

  /*Prepare result tab*/
  var toInsert="<div id=\"tabs-"+resultTab+"\"></div>";
  $('#tabs').append($(toInsert));


  var toInsert=" <li><a href='#tabs-"+resultTab+"'>results "+(resultTab-2)+"</a><span class='ui-closable-tab'>&#10006;</span></li> ";
  $('#tabsul').append($(toInsert));

  $( "#tabs" ).tabs("refresh");
  $(function() {
    $(".ui-closable-tab").on( "click", function() {
      var tabContainerDiv=$(this).closest(".ui-tabs").attr("id");
      var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
      $( "#" + panelId ).remove();
      $("#"+tabContainerDiv).tabs("refresh");

    });
  });
  $("#tabs").tabs("option", "active", $(".ui-tabs-nav").children().size() - 1);

  var toInsert=" <div class='loader' id='loader'></div> ";
  $("#tabs-"+resultTab).append($(toInsert));



  /* Send the data using post */
  var posting = $.post(url, {
    data: dataString
  });

  /* Put the results in a div */
  posting.done(function(data) {


    $("#tabs-"+resultTab).empty().append(data);

    resultTab = resultTab+1;
  });
});
