$(document).ready(function() {
    $(".change-Fee-Amount-Btn").on("click", function(e) {
        e.preventDefault();
        let editor_id = $(this).attr("id");
        let myaction = "editStudentPay";
        $.ajax({
            url: "inc-files/saveeditedfee.php",
            type: "POST",
            data: {
                editor_id: editor_id,
                myaction: myaction
            },
            dataType: "JSON",
            success: function(data) {
                // console.log(data)
                $("#student_title").html(data.sname + " " + data.fname);
                $("#old_fee").val(data.amount_per_term);
                $("#fulname").val(data.sname + " " + data.fname + " " + data.lname);
                $("#stu_id").val(data.student_id);
                $("#payment_session").val(data.payment_session);
                $("#payment_term").val(data.payment_term);
                $("#student_class").val(data.admitted_class);
                $("#large-Modal-Update-Fee-form").modal('show');
            }
        })

    })

    // update fee btn  

    $(".update_fee_btn").on("click", function(evt) {
        evt.preventDefault();
        let old_fee = $("#old_fee").val();
        let update_student_id = $("#stu_id").val();
        let new_fee = $("#new_fee").val();
        let payment_session = $("#payment_session").val();
        let payment_term = $("#payment_term").val();
        let myaction = "saveUpdatedChange";
        $.ajax({
            url: "inc-files/saveeditedfee.php",
            type: "POST",
            data: {
                old_fee: old_fee,
                payment_session: payment_session,
                payment_term: payment_term,
                update_student_id: update_student_id,
                new_fee: new_fee,
                myaction: myaction
            },
            success: function(data) {
                $("#updateResponse").html(data);
            }
        })

    })
})