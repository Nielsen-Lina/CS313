function buttonClick() {
  alert("Clicked!");
} 

$(document).ready(function() {
    $("#colorChange").click(function() {
        var backColor = document.getElementById("color").value;
        $("#div1").css("background-color", backColor);
    });

    $("#fadeToggle").click(function() {
    	$("#div3").fadeToggle("slow");
    });
});