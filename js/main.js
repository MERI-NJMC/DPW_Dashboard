$(document).ready(function() {
	$("#xout").click(function() {
		var pop = document.getElementById("pop");
        pop.style.visibility='hidden';
	});
	$("img").error(function() {
		$(this).css({visibility:"hidden"});
	});

});

function cubicCalc() {
	
	if(validateBasin()) {
		
		var length = document.getElementById('length');
		var depth = document.getElementById('depth');
		var width = document.getElementById('width');

		var cubed = length.value * depth.value * width.value;

		document.getElementById('cube').value = cubed;
	}


}

function validateBasin() {


	var length = document.getElementById('length'),
	    depth = document.getElementById('depth'),
	    width = document.getElementById('width'),
	    lineSizeFt = document.getElementById('lineSizeFt'),
	    lineSizeIn = document.getElementById('lineSizeIn'), 
	    rimElFt = document.getElementById('RimElevationFt'),
	    rimElIn = document.getElementById('RimElevationIn'),
	  	accDiaFt = document.getElementById('AccessDiameterFt'),
	    accDiaIn = document.getElementById('AccessDiameterIn'),
	    inverFt = document.getElementById('InvertElevationFt'),
	    inverIn = document.getElementById('InvertElevationIn');

	if(isNaN(Number(length.value))) {
		alert("Length is not a number");
		return false;
	} else if (isNaN(Number(depth.value))) {
		alert("Depth is not a number");
		return false;
	} else if (isNaN(Number(width.value))) {
		alert("Width is not a number");
		return false;
	} else if(isNaN(Number(lineSizeFt.value)) || isNaN(Number(lineSizeIn.value))) {
		alert("The line size input is not a number");
		return false;
	} else if(isNaN(Number(rimElIn.value)) || isNaN(Number(rimElFt.value))) {
		alert("The Rim Elevation input is not a number");
	} else if(isNaN(Number(accDiaFt.value)) || isNaN(Number(accDiaIn.value))) { 
		alert("The Access Diameter is not a number");
	} else if(isNaN(Number(inverFt.value)) || isNaN(Number(inverIn.value))) { 
		alert("The Invert Elevation is not a number");
	} else {
		return true;
	}

}

function validateOpLog() {
	var debris = document.getElementById('debrisCol');

	if (isNaN(Number(debris.value))) {
		alert("Debris Collection is not a number.")
		return false;
	}

	else {
		return true;
	}
}

function postOpLog() {
	if(validateOpLog()) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'php/operationlog.php', false);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

		var basin = document.getElementsByClassName("basinID"),
			type = document.getElementById("responseType"),
			debris = document.getElementById("debrisCol"),
			note = document.getElementById("respoNote"),
			user = document.getElementById("sessionU").innerHTML;

		xhr.send("basin=" + basin[0].innerHTML + "&type=" + type.value + "&debris=" + debris.value + "&note=" + note.value + "&user=" + user);
		alert("Info Saved");
		return true;
	} else {
		return false;
	}
}

function postBasin() {
	if(validateBasin()) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'php/updatebasin.php', false);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");


		var basin = document.getElementsByClassName("basinID"),
			address = document.getElementById("address");
			width = document.getElementById("width"), 
			length = document.getElementById("length"),
			depth = document.getElementById("depth"),
			size = document.getElementById("cube"),
			lineSizeFt = document.getElementById("lineSizeFt"),
			lineSizeIn = document.getElementById("lineSizeIn"),
			lineSize = Number(lineSizeFt.value) + (Number(lineSizeIn.value)/12),
			drain = document.getElementById("drainsTo"),
			condition = document.getElementById("condition"),
			ownedBy = document.getElementById("OwnedBy"),
			muni = document.getElementById("Municipality"),
			locDesc = document.getElementById("LocationDescription"),
			cbType = document.getElementById("CBType"), 
			rimElFt = document.getElementById("RimElevationFt"),
			rimElIn = document.getElementById("RimElevationIn"),
			rimEl = Number(rimElFt.value) + (Number(rimElIn.value)/12),
			accDiaFt = document.getElementById("AccessDiameterFt"),
			accDiaIn = document.getElementById("AccessDiameterIn"),
			accDia = Number(accDiaFt.value) + (Number(accDiaIn.value)/12),
			accMat = document.getElementById("AccessMaterial"),
			accType = document.getElementById("AccessType"), 
			inverElFt = document.getElementById("InvertElevationFt"),
			inverElIn = document.getElementById("InvertElevationIn"),
			inverEl = Number(inverElFt.value) + (Number(inverElIn.value)/12),
			comments = document.getElementById("Comments"); 


		xhr.onreadystatechange = function () {
		    if (xhr.readyState < 4)                         
		        console.log("Loading"); 
		    else if (xhr.readyState === 4) {                
		        if (xhr.status == 200 && xhr.status < 300)  
		            console.log(xhr.responseText);
		    }
		}

		xhr.send("basin=" + basin[0].innerHTML + "&address=" + address.value + "&width=" + Number(width.value) + "&length=" + Number(length.value) + "&depth=" + Number(depth.value) + "&size=" + Number(size.value) + "&lineSize=" + lineSize + "&drain=" + drain.value + "&condition=" + condition.value +
					"&ownedBy=" + ownedBy.value + "&muni=" + muni.value + "&locDesc=" + locDesc.value +
					"&cbType=" + cbType.value + "&rimEl=" + Number(rimEl) + "&accDia=" + Number(accDia) + "&accMat=" + accMat.value +
					"&accType=" + accType.value + "&inverEl=" + Number(inverEl) + "&comments=" + comments.value);
		alert("Info Saved");
		return false;
	} else {
		return false;
	}
}

function postManhole() {
	if(validateManhole()) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'php/updateManhole.php', false);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

		var mid = document.getElementsByClassName("manholeID"),
			address = document.getElementById("address"),
			condition = document.getElementById("mhCondition"),
			ownedBy = document.getElementById("OwnedBy"),
			muni = document.getElementById("Municipality"),
			locDesc = document.getElementById("LocationDescription"),
			accDiaFt = document.getElementById("AccessDiameterFt"),
			accDiaIn = document.getElementById("AccessDiameterIn"),
			accDia = Number(accDiaFt.value) + (Number(accDiaIn.value)/12),
			accType = document.getElementById("AccessType"), 
			groundType = document.getElementById("GroundType"),
			hpeFt = document.getElementById("HighPipeElevationFt"),
			hpeIn = document.getElementById("HighPipeElevationIn"),
			hpe = Number(hpeFt.value) + (Number(hpeIn.value)/12),
			rimElFt = document.getElementById("RimElevationFt"),
			rimElIn = document.getElementById("RimElevationIn"),
			rimEl = Number(rimElFt.value) + (Number(rimElIn.value)/12),
			inverElFt = document.getElementById("InvertElevationFt"),
			inverElIn = document.getElementById("InvertElevationIn"),
			inverEl = Number(inverElFt.value) + (Number(inverElIn.value)/12),
			manholeDrop = document.getElementById("ManholeDrop"),
			interDropFt = document.getElementById("InteriorDropFt"),
			interDropIn = document.getElementById("InteriorDropIn"),
			interDrop = Number(interDropFt.value) + (Number(interDropIn.value)/12),
			wallMat = document.getElementById("WallMaterial"),
			structShape = document.getElementById("StructuralShape"),
			manholeType = document.getElementById("ManholeType"),
			metered = document.getElementById("Metered"),
			comments = document.getElementById("Comments");



		xhr.onreadystatechange = function () {
		    if (xhr.readyState < 4)                         
		        console.log("Loading"); 
		    else if (xhr.readyState === 4) {                
		        if (xhr.status == 200 && xhr.status < 300)  
		            console.log(xhr.responseText);
		    }
		}

		xhr.send("mid=" + mid[0].innerHTML + "&address=" + address.value + "&condition=" + condition.value + "&ownedBy=" + ownedBy.value +
				"&muni=" + muni.value + "&locDesc=" + locDesc.value + "&accDia=" + accDia + "&accType=" + accType.value + "&groundType=" + groundType.value + "&hpe=" + hpe + "&rimEl=" + rimEl + 
				"&inverEl=" + inverEl + "&manholeDrop=" + manholeDrop.value + "&interDrop=" + interDrop + "&wallMat=" + wallMat.value + "&structShape=" + structShape.value + "&manholeType=" + manholeType.value +
				"&metered=" + Number(metered.value) + "&comments=" + comments.value);
		alert("Info Saved");
		return false;
	}
	return false;
}

function validateManhole() {
	var accDiaFt = document.getElementById("AccessDiameterFt"),
		accDiaIn = document.getElementById("AccessDiameterIn"),
		hpeFt = document.getElementById("HighPipeElevationFt"),
		hpeIn = document.getElementById("HighPipeElevationIn"),
		rimElFt = document.getElementById("RimElevationFt"),
		rimElIn = document.getElementById("RimElevationIn"),
		inverFt = document.getElementById("InvertElevationFt"),
		inverIn = document.getElementById("InvertElevationIn"),
		interDropFt = document.getElementById("InteriorDropFt"),
		interDropIn = document.getElementById("InteriorDropIn");




	if (isNaN(Number(accDiaIn.value)) || isNaN(Number(accDiaFt.value))) {
		alert("Access Diameter input is not a number");
		return false;
	} else if(isNaN(Number(hpeIn.value)) || isNaN(Number(hpeFt.value))) {
		alert("High Pipe Elevation input is not a number");
		return false;
	} else if (isNaN(Number(rimElIn.value)) || isNaN(Number(rimElFt.value))) {
		alert("Rim Elevation input is not a number");
		return false;
	} else if (isNaN(Number(inverIn.value)) || isNaN(Number(inverFt.value))) {
		alert("Invert Elevation input is not a number");
		return false;
	} else if (isNaN(Number(interDropIn.value)) || isNaN(Number(interDropFt.value))) {
		alert("Interior Drop input is not a number");
		return false;
	} else {
		return true;
	}
}
function postManOpLog() {
	if(validateOpLog()) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'php/manholeOpLog.php', false);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

		var mid = document.getElementsByClassName("manholeID"),
			type = document.getElementById("responseType"),
			debris = document.getElementById("debrisCol"),
			note = document.getElementById("respoNote"),
			user = document.getElementById("sessionU").innerHTML;

			xhr.send("mid=" + mid[0].innerHTML + "&type=" + type.value + "&debris=" + debris.value + "&note=" + note.value + "&user=" + user);
			alert("Info Saved");
			return true;
	} else {
		return false;
	}


}
function postOutfall() {
	if(validateOutfall()) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'php/updateOutfall.php', false);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

		var oid = document.getElementsByClassName("outfallID"),
			ownedBy = document.getElementById("OwnedBy"),
			muni = document.getElementById("muni"),
			locDesc = document.getElementById("locDesc"),
			material = document.getElementById("Material"),
			recWater = document.getElementById("recWater"),
			comments = document.getElementById("Comments"),
			diaFt = document.getElementById("diaFt"),
			diaIn = document.getElementById("diaIn"),
			dia = Number(diaFt.value) + (Number(diaIn.value)/12);
			xhr.onreadystatechange = function () {
		    if (xhr.readyState < 4)                         
			        console.log("Loading"); 
			    else if (xhr.readyState === 4) {                
			        if (xhr.status == 200 && xhr.status < 300)  
			            console.log(xhr.responseText);
			    }
			}
		
		xhr.send("oid=" + oid[0].innerHTML + "&ownedBy=" + ownedBy.value + "&muni=" + muni.value +
			"&locDesc=" + locDesc.value + "&material=" + material.value + "&recWater=" + recWater.value + "&dia=" + dia + 
			"&comments=" + comments.value);
		alert("Info Saved");
		return false;
	}

	return false;
}

function validateOutfall() {
	var diaFt = document.getElementById("diaFt"),
		diaIn = document.getElementById("diaIn");

	if (isNaN(Number(diaFt.value)) || isNaN(Number(diaIn.value))) {
		alert("Diameter input is not a number");
		return false
	} 

	return true;
}
function postOutOpLog() {
	if(validateOpLog()) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'php/outfallOpLog.php', false);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

		var oid = document.getElementsByClassName("outfallID"),
			type = document.getElementById("responseType"),
			debris = document.getElementById("debrisCol"),
			note = document.getElementById("respoNote"),
			user = document.getElementById("sessionU").innerHTML;

			xhr.send("oid=" + oid[0].innerHTML + "&type=" + type.value + "&debris=" + debris.value + "&note=" + note.value + "&user=" + user);
			alert("Info Saved");
			return true;
	}

	return false;

}

function postStormline() {
	if(validateSline()) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'php/updateSline.php', false);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

		var slid = document.getElementsByClassName("slineID"),
			ownedBy = document.getElementById("OwnedBy"),
			muni = document.getElementById("muni"), 
			material = document.getElementById("material"),
			css = document.getElementById("css"),
			dia = document.getElementById("dia"),
			height = document.getElementById("height"),
			width = document.getElementById("width"),
			usi = document.getElementById("usi"),
			dsi = document.getElementById("dsi");
		xhr.onreadystatechange = function () {
		    if (xhr.readyState < 4)                         
			        console.log("Loading"); 
			    else if (xhr.readyState === 4) {                
			        if (xhr.status == 200 && xhr.status < 300)  
			            console.log(xhr.responseText);
			    }
			}
		xhr.send("slid=" + slid[0].innerHTML + "&ownedBy=" + ownedBy.value + "&muni=" + muni.value + "&material=" + material.value +
			"&css=" + css.value + "&dia=" + Number(dia.value) + "&height=" + Number(height.value) + "&width=" + Number(width.value) + "&usi=" + Number(usi.value) + "&dsi=" + Number(dsi.value));
		alert("Info saved");
		return false;
	}
	return false;
}

function validateSline() {
	var	dia = document.getElementById("dia"),
			height = document.getElementById("height"),
			width = document.getElementById("width"),
			usi = document.getElementById("usi"),
			dsi = document.getElementById("dsi");

	if (isNaN(Number(dia.value))) {
		alert("Diameter is not a number");
		return false;
	} else if (isNaN(Number(height.value))) {
		alert("Height is not a number");
		return false;
	} else if (isNaN(Number(width.value))) {
		alert("Width is not a number");
		return false;
	} else if (isNaN(Number(usi.value))) {
		alert("Upstream invert is not a number");
		return false;
	} else if (isNaN(Number(dsi.value))) {
		alert("Downstream invert is not a number");
		return false;
	} else {
		return true;
	}
}

function postSlineOpLog(){
	if(validateOpLog()) {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'php/operationlog.php', false);
		xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

		var slid = document.getElementsByClassName("slineID"),
			type = document.getElementById("responseType"),
			debris = document.getElementById("debrisCol"),
			note = document.getElementById("respoNote"),
			user = document.getElementById("sessionU").innerHTML;

		xhr.send("basin=" + slid[0].innerHTML + "&type=" + type.value + "&debris=" + debris.value + "&note=" + note.value + "&user=" + user);
		alert("Info Saved");
		return true;
	} else {
		return false;
	}	
}