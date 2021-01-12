
$(document).ready(function()
{  
//      $('#login_button').click(function(){  
//           var username = $('#username').val();  
//           var password = $('#password').val();  
//           if(username != '' && password != '')  
//           {  
//                $.ajax({  
//                     url:"index.html",  
//                     method:"POST",  
//                     data: {username:username, password:password},  
//                     success:function(data)  
//                     {  
//                          //alert(data);  
//                          if(data == 'No')  
//                          {  
//                               alert("Wrong Data");  
//                          }  
//                          else  
//                          {  
//                               $('#loginModal').hide();  
//                               location.reload();  
//                          }  
//                     }  
//                });  
//           }  
//           else  
//           {  
//                alert("Both Fields are required");  
//           }  
//      });  
//      $('#logout').click(function(){  
//           var action = "logout";  
//           $.ajax({  
//                url:"index.html",  
//                method:"POST",  
//                data:{action:action},  
//                success:function()  
//                {  
//                     location.reload();  
//                }  
//           });  
//      });  
// });  



$(window).load(function() {
     $('#flex2').flexslider({
       slideshowSpeed: 4000,
       controlNav: true,
       directionNav: true,
       animation: "slide",
     });

     $(window).load(function() {
          $('.flexslider').flexslider({
            animation: "slide",
          });
        });
});
$(window).load(function() {
    $('#flex1').flexslider({
      slideshowSpeed: 3000,
      controlNav: true,
      directionNav: true,
      animation: "slide",
    });

    $('#flex2').flexslider({
      slideshowSpeed: 4000,
      controlNav: false,
      directionNav: false,
      pauseOnHover: true,
    });


});

