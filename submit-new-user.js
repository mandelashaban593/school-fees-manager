$(document).ready(function(){
    $("#register-user-Form").on("submit", function(ep){
        ep.preventDefault();
       //send to server 
       let fd = $(this).serialize();
       console.log(fd);
       $.ajax({
           url:"inc-files/create-new-user.php",
           type:"POST",
           data:fd,
           beforeSend:function(){
               
               $("#submit-new-user").html("Creating please wait...").addClass("btn-dark");
           },
           success:function(data){
               
              setTimeout(() => {
                  console.log(data);
                  $("#register-user-message").html(data);
                   $("#submit-new-user").html("Submit New User").addClass("btn-success").removeClass("btn-dark");
              }, 2000);
           }
       })

    })
})