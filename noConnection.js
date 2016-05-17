








$(document).ready(function () {
	var status = true;
	$.get( "mytext.txt", function( data ) {
 		console.log("internet is connected.");
 		status = false;
	});

	if (!status) {  
		console.log("connection check works");
		var results = document.getElementById("results");
		var span1 = document.getElementById("span1");
		var collapsibleMain = document.getElementById("collapsibleMain");
		var myButton = document.getElementById("myButton");
		results.style.display = "none";
		span1.display = "none";
		collapsibleMain.display = "none";
		myButton.display = "none";

		text = "<ul><li><img src='bears/bear1.jpg' alt='bear1'><p><b>Product:</b> Lively Bears</p><p><b>Price</b>: $19.99 </p><p><b>Description:</b> lively bears.</p></li>";
	
		text += "<li><img src='bears/bear2.jpg' alt='bear2'><p><b>Product:</b> Lonely Bear</p><p><b>Price</b>: $9.99 </p><p><b>Description:</b> A lonely bear.</p></li>"; 
		text += "<li><img src='bears/bear3.jpg' alt='bear3'><p><b>Product:</b> Love Bears</p><p><b>Price</b>: $222.99 </p><p><b>Description:</b> Bears in love.</p></li>";
		text += "<li><img src='bears/bear4.jpg' alt='bear4'><p><b>Product:</b> Expensive Bear</p><p><b>Price</b>: $1999999.99 </p><p><b>Description:</b> A very expensive bear.</p></li>";
		text += "<li><img src='bears/bear5.jpg' alt='bear5'><p><b>Product:</b> Santa Bear</p><p><b>Price</b>: $199.99 </p><p><b>Description:</b> Santa's bear.</p></li></ul>";

		$("#noConnection").html(text);
	}
	
});	

