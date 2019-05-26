
function myFunction() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more"; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}

     function cleanfields(){
    document.getElementById("name").value="";
    document.getElementById("email").value="";
    document.getElementById("comments").value="";
        }



$(document).ready(function(){
	
  $('[data-toggle="tooltip"]').tooltip();  
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    if (this.hash !== "") {

      event.preventDefault();

      var hash = this.hash;

     
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        window.location.hash = hash;
      });
    } 
  });
})
//THIS FOR THE SHOP COLLECT
$(document).ready(function(){
  $(".btnAdd").click(function(){
    var total = parseInt($('#basket').html());
    if (total == 1000)
    	return;
    total++;
    $('#basket').html(total);
  });
   
  $(".btnRemove").click(function(){
    var total = parseInt($('#basket').html());
     if (total == 0)
    	return;
    total--;
    $('#basket').html(total);
  });
});


function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

function signUp() {
  location.replace("https://www.w3schools.com")
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

