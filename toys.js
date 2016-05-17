

$(function() {


  $("#myForm").submit(function(e) {
      e.preventDefault();
  });

  $("#myForm").submit(function(e) {

    var firstName = $("#firstName").val();
    var email = $("#email").val();
    var errorMessage = "";
    $("#nameError").text("");
    $("#emailError").text("");

    var validation1 = /^[a-zA-Z]+$/;
    var validation2 = /\S+@\S+/;
    if (!validation1.test(firstName) ) {

      errorMessage = "Please enter a valid first name.";
      $("#nameError").text(errorMessage);



    } else if (!validation2.test(email)) {
      errorMessage = "Please enter a valid email.";
      $("#emailError").text(errorMessage);
    } else {
        console.log("works");
      $("#myForm").submit();
    }

});

$("#toys1").submit(function(e) {

  document.getElementById("myFrame").className = "";
});

});
