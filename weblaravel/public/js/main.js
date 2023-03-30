$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/* upload file */
$('#exampleInputAvatar').change(function() {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/addemploye/upload',
        success: function(results) {
            if (results.error == false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '"width="100px"></a>');
                $('#file').val(results.url);
            } else {
                alert('Upload file lỗi!!');
            }
        }
    })
});
// phone validation
// var input = document.querySelector("#phonevalidate");
// window.intlTelInput(input, {});
$(document).ready(function() {
	
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
   
    $(".file-upload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".file-upload").click();
    });
});
$(window).on("load",function(){
    $(".loading").fadeOut("slow");
})