$(document).ready(function(){
             //when edit btn is clicked 
    $(".EditUserBtn").on("click", function() {
        console.log("Please Wait...")
        $("#large-Modal-edit-Users").modal("show");
       let getId = $(this).data("id");
       let action = "fetch-users";
       $.ajax({
           url:"inc-files/fetch-user-details.php",
           type:"POST",
           data:{
               getId:getId,
               action:action
           },
           dataType:"JSON",
           success:function(data){
               $("#user_hidden_id").val(data.user_id);
               $("#user_fulname").val(data.fulname);
               $("#user_role").val(data.user_type);
               $("#email_user").val(data.email);
               $("#account_username").val(data.username);
            $("#large-Modal-edit-Users").modal("show");
           }
       })
       
    });

    // promote student Now btn 
    $(".updatemeBtn").on('click', function(){
             let user_hidden_id = $("#user_hidden_id").val();
              let user_fulname =$("#user_fulname").val();
               let user_role = $("#user_role").val();
              let email_user = $("#email_user").val();
              let account_username = $("#account_username").val();
              let old_password = $("#old_password").val();
              let c_new_password = $("#c_new_password").val();
              let submit_action = $("#submit-updateMe").val();
        //send to server 
        $.ajax({
            url:"inc-files/saveupdatedUser.php",
            type:"POST",
            data:{
               user_hidden_id:user_hidden_id, 
               user_fulname:user_fulname,
               user_role:user_role,
               email_user:email_user,
               account_username:account_username,
               old_password:old_password,
               c_new_password:c_new_password,
               submit_action:submit_action
            },
            success:function(dataText){
                console.log(dataText);
                 $("#serverText").html(dataText);
                //  setTimeout(() => {
                //      self.location.reload();
                //  }, 6000);
            }
        })

    })
        })
 