$(document).ready(function() {
	$("#xout").click(function() {
		var pop = document.getElementById("pop");
        pop.style.visibility='hidden';
	});
	$("img").error(function() {
		$(this).css({visibility:"hidden"});
	});
	$("#addAtt").click(function() {
		$("#testTogAtt").toggle("fast");
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
	    lineSize = document.getElementById('lineSize'),
	    rimElFt = document.getElementById('RimElevationFt'),
	    accDiaIn = document.getElementById('AccessDiameterIn'),
	    inverFt = document.getElementById('InvertElevationFt');
	if(isNaN(Number(length.value))) {
		alert("Length is not a number");
		return false;
	} else if (isNaN(Number(depth.value))) {
		alert("Depth is not a number");
		return false;
	} else if (isNaN(Number(width.value))) {
		alert("Width is not a number");
		return false;
	} else if(isNaN(Number(lineSize.value))) {
		alert("The line size input is not a number");
		return false;
	} else if(isNaN(Number(rimElFt.value))) {
		alert("The Rim Elevation input is not a number");
	} else if(isNaN(Number(accDiaIn.value))) { 
		alert("The Access Diameter is not a number");
	} else if(isNaN(Number(inverFt.value))) { 
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
		var basin = document.getElementsByClassName("basinID"),
			address = document.getElementById("address");
			width = document.getElementById("width"), 
			length = document.getElementById("length"),
			depth = document.getElementById("depth"),
			size = document.getElementById("cube"),
			lineSize = document.getElementById("lineSize"),
			drain = document.getElementById("drainsTo"),
			condition = document.getElementById("condition"),
			ownedBy = document.getElementById("OwnedBy"),
			muni = document.getElementById("Municipality"),
			locDesc = document.getElementById("LocationDescription"),
			cbType = document.getElementById("CBType"), 
			rimElFt = document.getElementById("RimElevationFt"),
			accDiaIn = document.getElementById("AccessDiameterIn"),
			accMat = document.getElementById("AccessMaterial"),
			accType = document.getElementById("AccessType"), 
			inverElFt = document.getElementById("InvertElevationFt"),
			comments = document.getElementById("Comments"),
			message = 'This is a test of an approval system for the DPW dashboard. If you click the link below it will take you to a form to look over the data inputed which you can edit if there are inaccuracy. Email me back when you go through the process of approval and try changing something too. Thanks.\n\n',
			url = baseURL() + "php/updatebasin.php?basin=" + basin[0].innerHTML + "&address=" + encodeURIComponent(address.value) + "&width=" + Number(width.value) + "&length=" + Number(length.value) + "&depth=" + Number(depth.value) + "&size=" + Number(size.value) + "&lineSize=" + Number(lineSize.value) + "&drain=" + encodeURIComponent(drain.value) + "&condition=" + encodeURIComponent(condition.value) +
					"&ownedBy=" + encodeURIComponent(ownedBy.value) + "&muni=" + encodeURIComponent(muni.value) + "&locDesc=" + encodeURIComponent(locDesc.value) +
					"&cbType=" + encodeURIComponent(cbType.value) + "&rimEl=" + Number(rimElFt.value) + "&accDia=" + Number(accDiaIn.value) + "&accMat=" + encodeURIComponent(accMat.value) +
					"&accType=" + encodeURIComponent(accType.value) + "&inverEl=" + Number(inverElFt.value) + "&comments=" + encodeURIComponent(comments.value),
					link = '<a href="'+url+'">Click Here!</a>';
		alert("Info Sent for Approval!");
		console.log(link);
		$.ajax({
			  type: "POST",
			  url: "https://mandrillapp.com/api/1.0/messages/send.json",
			  data: {
			    'key': 'vauMf2Si9Ovrs1-DrrS61Q',
			    'message': {
			      'from_email': 'steven.birkner@njmeadowlands.gov',
			      'to': [
			          {
			            'email': 'Dominador.elefante@njmeadowlands.gov',
			            'type': 'to',
			          },
			          {
			            'email': 'Stephanie.Bosits@njmeadowlands.gov',
			            'type': 'to',
			          },
			          {
			            'email': 'Sal.Kojak@njmeadowlands.gov',
			            'type': 'to',
			          },
			          {
			            'email': 'steven.birkner@njmeadowlands.gov',
			            'type': 'to',
			          },
			        ],
			      'autotext': 'true',
			      'subject': 'TEST: A utility needs your approval!',
			      'html': message+'\n\n'+link,
			    }
			  }
			 }).done(function(response) {
			   console.log(response); // if you're into that sorta thing
			 });
		return false;
	} else {
		return false;
	}
}

function postManhole() {
	if(validateManhole()) {
		var mid = document.getElementsByClassName("manholeID"),
			address = document.getElementById("address"),
			condition = document.getElementById("mhCondition"),
			ownedBy = document.getElementById("OwnedBy"),
			muni = document.getElementById("Municipality"),
			locDesc = document.getElementById("LocationDescription"),
			accDiaIn = document.getElementById("AccessDiameterIn"),
			accType = document.getElementById("AccessType"), 
			groundType = document.getElementById("GroundType"),
			hpeFt = document.getElementById("HighPipeElevationFt"),
			rimElFt = document.getElementById("RimElevationFt"),
			inverElFt = document.getElementById("InvertElevationFt"),
			manholeDrop = document.getElementById("ManholeDrop"),
			interDropIn = document.getElementById("InteriorDropIn"),
			wallMat = document.getElementById("WallMaterial"),
			structShape = document.getElementById("StructuralShape"),
			manholeType = document.getElementById("ManholeType"),
			metered = document.getElementById("Metered"),
			comments = document.getElementById("Comments"),
			message = 'Please click the link and review this utility for any inaccuracies. \n',
			url = baseURL() + "php/updatemanhole.php?mid=" + mid[0].innerHTML + "&address=" + encodeURIComponent(address.value) + "&condition=" + encodeURIComponent(condition.value) + "&ownedBy=" + encodeURIComponent(ownedBy.value) +
				"&muni=" + encodeURIComponent(muni.value) + "&locDesc=" + encodeURIComponent(locDesc.value) + "&accDia=" + Number(accDiaIn.value) + "&accType=" + encodeURIComponent(accType.value) + "&groundType=" + encodeURIComponent(groundType.value) + "&hpe=" + Number(hpeFt.value) + "&rimEl=" + Number(rimElFt.value) + 
				"&inverEl=" + Number(inverElFt.value) + "&manholeDrop=" + encodeURIComponent(manholeDrop.value) + "&interDrop=" + Number(interDropIn.value) + "&wallMat=" + encodeURIComponent(wallMat.value) + "&structShape=" + encodeURIComponent(structShape.value) + "&manholeType=" + encodeURIComponent(manholeType.value) +
				"&metered=" + Number(metered.value) + "&comments=" + encodeURIComponent(comments.value),
			link = '<a href="'+url+'">Click Here!</a>';
		alert("Info Sent for Approval!");
		console.log(link);
		$.ajax({
			  type: "POST",
			  url: "https://mandrillapp.com/api/1.0/messages/send.json",
			  data: {
			    'key': 'vauMf2Si9Ovrs1-DrrS61Q',
			    'message': {
			      'from_email': 'steven.birkner@njmeadowlands.gov',
			      'to': [
			          // {
			          //   'email': 'Dominador.elefante@njmeadowlands.gov',
			          //   'type': 'to',
			          // },
			          // {
			          //   'email': 'Stephanie.Bosits@njmeadowlands.gov',
			          //   'type': 'to',
			          // },
			          // {
			          //   'email': 'Sal.Kojak@njmeadowlands.gov',
			          //   'type': 'to',
			          // },
			          {
			            'email': 'steven.birkner@njmeadowlands.gov',
			            'type': 'to',
			          },
			        ],
			      'autotext': 'true',
			      'subject': 'TEST: A utility needs your approval!',
			      'html': message+'\n\n'+link,
			    }
			  }
			 }).done(function(response) {
			   console.log(response); // if you're into that sorta thing
			 });
		return false;
	}
	return false;
}

function validateManhole() {
	var accDiaIn = document.getElementById("AccessDiameterIn"),
		hpeFt = document.getElementById("HighPipeElevationFt"),
		rimElFt = document.getElementById("RimElevationFt"),
		rimElIn = document.getElementById("RimElevationIn"),
		inverFt = document.getElementById("InvertElevationFt"),
		interDropIn = document.getElementById("InteriorDropIn");




	if (isNaN(Number(accDiaIn.value))) {
		alert("Access Diameter input is not a number");
		return false;
	} else if(isNaN(Number(hpeFt.value))) {
		alert("High Pipe Elevation input is not a number");
		return false;
	} else if (isNaN(Number(rimElFt.value))) {
		alert("Rim Elevation input is not a number");
		return false;
	} else if (isNaN(Number(inverFt.value))) {
		alert("Invert Elevation input is not a number");
		return false;
	} else if (isNaN(Number(interDropIn.value))) {
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
		var oid = document.getElementsByClassName("outfallID"),
			ownedBy = document.getElementById("OwnedBy"),
			muni = document.getElementById("muni"),
			locDesc = document.getElementById("locDesc"),
			material = document.getElementById("Material"),
			recWater = document.getElementById("recWater"),
			comments = document.getElementById("Comments"),
			diaIn = document.getElementById("diaIn"),
			message = 'Please click the link and review this utility for any inaccuracies. \n',
			url = baseURL() + "php/updateOutfall.php?oid=" + oid[0].innerHTML + "&ownedBy=" + encodeURIComponent(ownedBy.value) + "&muni=" + encodeURIComponent(muni.value) +
			"&locDesc=" + encodeURIComponent(locDesc.value) + "&material=" + encodeURIComponent(material.value) + "&recWater=" + encodeURIComponent(recWater.value) + "&dia=" + encodeURIComponent(diaIn.value) + 
			"&comments=" + encodeURIComponent(comments.value),
		    link = '<a href="'+url+'">Click Here!</a>';
		alert("Info Sent for Approval!");
		console.log(link);
		$.ajax({
			  type: "POST",
			  url: "https://mandrillapp.com/api/1.0/messages/send.json",
			  data: {
			    'key': 'vauMf2Si9Ovrs1-DrrS61Q',
			    'message': {
			      'from_email': 'steven.birkner@njmeadowlands.gov',
			      'to': [
			          // {
			          //   'email': 'Dominador.elefante@njmeadowlands.gov',
			          //   'type': 'to',
			          // },
			          // {
			          //   'email': 'Stephanie.Bosits@njmeadowlands.gov',
			          //   'type': 'to',
			          // },
			          // {
			          //   'email': 'Sal.Kojak@njmeadowlands.gov',
			          //   'type': 'to',
			          // },
			          {
			            'email': 'steven.birkner@njmeadowlands.gov',
			            'type': 'to',
			          },
			        ],
			      'autotext': 'true',
			      'subject': 'TEST: A utility needs your approval!',
			      'html': message+'\n\n'+link,
			    }
			  }
			 }).done(function(response) {
			   console.log(response); // if you're into that sorta thing
			 });	
		
		return false;
	}

	return false;
}

function validateOutfall() {
	var	diaIn = document.getElementById("diaIn");

	if (isNaN(Number(diaIn.value))) {
		alert("Diameter input is not a number");
		return false;
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
		var slid = document.getElementsByClassName("slineID"),
			ownedBy = document.getElementById("OwnedBy"),
			muni = document.getElementById("muni"), 
			material = document.getElementById("material"),
			css = document.getElementById("css"),
			dia = document.getElementById("dia"),
			height = document.getElementById("height"),
			width = document.getElementById("width"),
			usi = document.getElementById("usi"),
			dsi = document.getElementById("dsi"),
			message = 'Please click the link and review this utility for any inaccuracies. \n',
			url = baseURL() + "php/updateSline.php?slid=" + slid[0].innerHTML + "&ownedBy=" + encodeURIComponent(ownedBy.value) + "&muni=" + encodeURIComponent(muni.value) + "&material=" + encodeURIComponent(material.value) +
			"&css=" + encodeURIComponent(css.value) + "&dia=" + Number(dia.value) + "&height=" + Number(height.value) + "&width=" + Number(width.value) + "&usi=" + Number(usi.value) + "&dsi=" + Number(dsi.value),
		    link = '<a href="'+url+'">Click Here!</a>';
		alert("Info Sent for Approval!");
		console.log(link);
		$.ajax({
			  type: "POST",
			  url: "https://mandrillapp.com/api/1.0/messages/send.json",
			  data: {
			    'key': 'vauMf2Si9Ovrs1-DrrS61Q',
			    'message': {
			      'from_email': 'steven.birkner@njmeadowlands.gov',
			      'to': [
			          // {
			          //   'email': 'Dominador.elefante@njmeadowlands.gov',
			          //   'type': 'to',
			          // },
			          // {
			          //   'email': 'Stephanie.Bosits@njmeadowlands.gov',
			          //   'type': 'to',
			          // },
			          // {
			          //   'email': 'Sal.Kojak@njmeadowlands.gov',
			          //   'type': 'to',
			          // },
			          {
			            'email': 'steven.birkner@njmeadowlands.gov',
			            'type': 'to',
			          },
			        ],
			      'autotext': 'true',
			      'subject': 'TEST: A utility needs your approval!',
			      'html': message+'\n\n'+link,
			    }
			  }
			 }).done(function(response) {
			   console.log(response); // if you're into that sorta thing
			 });
	
	
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