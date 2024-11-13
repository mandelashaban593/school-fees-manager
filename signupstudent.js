$(document).ready(function() {

    $('#state_of_origin').on('change', function() {
        //  $(document).on('click','.search_state', function(){
        let state = $('#state_of_origin').val();
        //  alert(state);
        if (state.trim() !== '') {
            $.ajax({
                url: "inc-files/fetch_local_govt.php",
                method: "POST",
                data: {
                    state: state
                },
                success: function(data) {
                    //console.log(data);
                    $("#local_gvt").html(data);
                }
            });
        } else {
            //do something
            $("#local_gvt").html('');
        }
    });


    $("#submit-student").on("click", function(evt) {
        //console.log("Yes Form Submitted")
        let submit = $("#submit-student").val();
        evt.preventDefault();
        //Student Data
        let surname = $("#surname").val();
        let lastname = $("#lastname").val();
        let firstname = $("#firstname").val();
        let gender = $("#gender").val();
        let dob = $("#dob").val();
        let nationality = $("#nationality").val();
        let state_of_origin = $("#state_of_origin").val();
        let place_of_birth = $("#place_of_birth").val();
        let local_gvt = $("#local_gvt").val();
        let proposed_class = $("#proposed_class").val();
        //school Details
        let school_name = $("#school_name").val();
        let school_address = $("#school_address").val();
        let last_class = $("#last_class").val();
        let reason = $("#reason").val();
        //Medical Data 
        let genotype = $("#genotype").val();
        let clinic = $("#clinic").val();
        let blood_group = $("#blood_group").val();
        let sickness = $("#sickness").val();
        let clinic_phone = $("#clinic_phone").val();
        let clinic_address = $("#clinic_address").val();
        // Parents Data 
        let parent_name = $("#parent_name").val();
        let parent_address = $("#parent_address").val();
        let parent_phone = $("#parent_phone").val();
        let parent_occupation = $("#parent_occupation").val();
        let parent_wrk_address = $("#parent_wrk_address").val();
        let position_at_work = $("#position_at_work").val();
        $.ajax({
            url: "inc-files/saveNewStudent.php",
            type: "POST",
            data: {
                surname: surname,
                firstname: firstname,
                lastname: lastname,
                gender: gender,
                dob: dob,
                nationality: nationality,
                place_of_birth: place_of_birth,
                state_of_origin: state_of_origin,
                local_gvt: local_gvt,
                proposed_class: proposed_class,
                school_name: school_name,
                school_address: school_address,
                last_class: last_class,
                reason: reason,
                genotype: genotype,
                blood_group: blood_group,
                sickness: sickness,
                clinic: clinic,
                clinic_phone: clinic_phone,
                clinic_address: clinic_address,
                parent_name: parent_name,
                parent_address: parent_address,
                parent_phone: parent_phone,
                parent_occupation: parent_occupation,
                parent_wrk_address: parent_wrk_address,
                position_at_work: position_at_work,
                submit: submit
            },
            beforeSend: function() {
                $(".regBtn").html("Submitting, Please wait...");
            },
            success: function(data) {
                setTimeout(() => {
                    $(".regBtn").html("Register Student");
                    $("#response").html(data);
                }, 2000);
            }
        })
    })
})