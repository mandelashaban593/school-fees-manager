$(document).ready(function() {

    $(".makePaymentBtnStudent").on("click", function() {
        let payee_id = $(this).attr("id");
        let fetch_payee = "fetchNow";
        $.ajax({
            url: "inc-files/fetch-student-details.php",
            method: "POST",
            data: {
                fetch_payee: fetch_payee,
                payee_id: payee_id
            },
            dataType: "JSON",
            success: function(resp) {
                $("#fulname_p").val(resp.sname + " " + resp.fname + " " + resp.lname);
                $("#student_id_p").val(resp.student_id);
                $("#termly_payment_amount_p").val(resp.amount_per_term);
                $("#admitted_class_p").val(resp.admitted_class);
                $("#admission_no_p").val(resp.admission_no);
                $("#large-Modal-payment").modal('show');
            }
        });
    })

    //save btn 
    $("#savePaymentBtn").on("click", function(evt) {

        evt.preventDefault();
        let student_class = $("#admitted_class_p").val();
        let my_payee_id = $("#student_id_p").val();
        let payment_session = $("#payment_sessionp").val();
        let payment_term = $("#payment_termp").val();
        let termly_payment_amount_p = $("#termly_payment_amount_p").val();
        let payment_amount = parseInt($("#payment_amountp").val());
        let payment_method = $("#payment_methodp").val();
        let osotech_action = $("#savePaymentBtn").val();
        $.ajax({
            url: "inc-files/savemoney.php",
            method: "POST",
            data: {
                student_class: student_class,
                payment_method: payment_method,
                my_payee_id: my_payee_id,
                payment_session: payment_session,
                payment_term: payment_term,
                termly_payment_amount_p: termly_payment_amount_p,
                payment_amount: payment_amount,
                osotech_action: osotech_action
            },
            success: function(data) {
                $("#myserverResponse").html(data);
            }
        });

    });
})