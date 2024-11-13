$(document).ready(function() {
    $(".setFeeBtn").on("click", function() {
        let student_id = $(this).attr("id");
        $.ajax({
            url: "inc-files/fetch-student-details.php",
            method: "POST",
            data: {
                sid: student_id
            },
            dataType: "JSON",
            success: function(res) {
                $("#fulnamev").val(res.sname + " " + res.fname + " " + res.lname);
                $("#student_idv").val(res.student_id);
                $("#admitted_classv").val(res.admitted_class);
                $("#admission_nov").val(res.admission_no);
                $("#admission_datev").val(res.admission_date);
                $("#large-Modal-offer-admission").modal('show');
            }
        });
    })

    //save btn 
    $("#setPaymentBtnUpdate").on("click", function(evtt) {
        evtt.preventDefault();
        
        let stuID = $("#student_idv").val();
        let termlyFee = parseInt($("#school_feev").val());
        let classroom = $("#admitted_classv").val();
        let myaction = "saveFee";
        //send to server
        $.ajax({
            url: "inc-files/actions.php",
            type: "POST",
            data: {
                classroom:classroom,
                stuID: stuID,
                termlyFee: termlyFee,
                myaction: myaction
            },
            success: function(data) {
                console.log(data);
                $("#serverRes").html(data);
            },
            error:function(){
                console.error("Unable to send request");
            }
        })

    })
})