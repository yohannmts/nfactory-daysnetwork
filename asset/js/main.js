
$(document).ready(() => {
    
    function myFunction() {
        var x = document.getElementById("myLinks");
        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
        }
      }

        $('#b1').click(function () { 
          $('#acacher').slideToggle('slow');

        });
        
        $('#b2').click(function () { 
            $('#acacher2').slideToggle('slow');
  
          });
      

})
