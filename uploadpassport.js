$(document).ready(function() {
    $("#uploadImage").on("click", function(evt) {
        evt.preventDefault();
        let submit = $("#uploadImage").val();
        let uploadFormData = new FormData();
        let file = $("#file")[0].files;
        // console.log(imageUpload);
        let admitted_class = $("#admitted_class").val();
        let admitted_date = $("#admitted_date").val();
        let admission_no = $("#admission_no").val();
        let hidden_id = $("#student_id").val();

        if (file.length === 0) {
            evt.preventDefault();
            alert("Please Select Image")
            return false;

        } else {
            uploadFormData.append("imageUpload", file[0]);
            uploadFormData.append("admitted_class", admitted_class);
            uploadFormData.append("admitted_date", admitted_date);
            uploadFormData.append("admission_no", admission_no);
            uploadFormData.append("hidden_id", hidden_id);
            uploadFormData.append("submit", submit);
            //send to server 
            $.ajax({
                url: "inc-files/saveUploadpassport.php",
                type: "POST",
                data: uploadFormData,
                contentType: false,
                processData: false,
                cache: false,
                success: function(data) {
                    $("#response").html(data);
                    console.log(data);
                }
            })
        }
    })
})