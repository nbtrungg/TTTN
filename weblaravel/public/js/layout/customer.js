

// checkall
$(function(e) {
    var table;
$(document).ready(function() {
    table = $('#myTable').DataTable({
        "aLengthMenu": [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
    });
});
    $("#checkall").click(function() {
        $(".checkbox").prop('checked', $(this).prop('checked'));
    });
    $("#deletechecked").click(function(e) {
        e.preventDefault();
        var socheckerd = document.querySelectorAll('input[name="id"]:checked').length;
        if (socheckerd > 0) {
            // alert('Bạn có chắc chắn muốn xóa?')
            Swal.fire({
                title: 'Bạn có chắc chắn muốn xóa \n '+socheckerd+' khách hàng ?',
                text: "Bạn sẽ không khôi phục lại được dữ liệu này!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý!'
            }).then((result) => {
                if (result.isConfirmed) {

                    var allid = [];
                    $("input:checkbox[name=id]:checked").each(function() {
                        allid.push($(this).val());
                    });

                    $.ajax({
                        url: "/admin/listcustomer/delete",
                        type: "DELETE",
                        data: {
                            _token: $("input[name=_token]").val(),
                            id: allid,
                        },
                        success: function(response) {
                            $.each(allid, function(key, val) {
                                // $("#ids" + val).remove();
                                // $('.odd').DataTable().ajax.reload();
                                location.reload();
                            })
                        }
                    })
                }
            })

        } else {
            // alert('Bạn cần chọn hàng để xóa!')
            Swal.fire(
                'Không thể thực hiện!',
                'Bạn cần chọn khách hàng để xóa!',
                'warning'
            )
        }

    })

    $("#editcustomer").click(function(e) {
        e.preventDefault();
        var socheckerd = document.querySelectorAll('input[name="id"]:checked').length;
        if (socheckerd == 1) {
            var id = [];
            $("input:checkbox[name=id]:checked").each(function() {
                id.push($(this).val());
                // alert(id);
                $("#editModal").modal('show');
                $.ajax({
                    url: "/admin/listcustomer/edit/" + id,
                    type: "GET",
                    success: function(response) {
                        // console.log(response);
                        var len = 0;
                        len = response.customer_mail.length;
                        // console.log(len);
                        $('#customername').val(response.customer[0].customer_name);
                        if (len > 0) {
                            $('#listcustomermail option').remove(option);
                            var option;
                            for (var i = 0; i < len; i++) {
                                option = '<option value="' + response.customer_mail[i].id + '">' + response.customer_mail[i].mail + '</option>'
                                $('#listcustomermail').append(option);
                            }
                        }
                        // $('#listcustomermail').html(
                        //     '<option value="' + response.customer_mail[0].id + '">' + response.customer_mail[0].mail + '</option>'
                        // );
                        // $('#editmail').html(
                        //     '<label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>' +
                        //     '<div class="col-sm-10">' +
                        //     '<input type="email" class="form-control" name="addemail" id="customeremail" placeholder="Email" value="' + response.customer[0].customer_name + '">' +
                        //     '</div>'
                        // );
                    }
                })
            });
        } else if (socheckerd > 1) {
            // alert('Bạn chỉ được chọn 1 hàng mà bạn cần chỉnh sửa')
            Swal.fire(
                'Không thể thực hiện!',
                'Bạn chỉ được chọn 1 khách hàng để chỉnh sửa Email!',
                'warning'
            )
        } else {
            // alert('Bạn cần chọn 1 hàng để chỉnh sửa!')
            Swal.fire(
                'Không thể thực hiện!',
                'Bạn cần chọn 1 khách hàng để chỉnh sửa Email!',
                'warning'
            )
        }

    });

    // $("#test").click(function(e) {
    //     e.preventDefault();
    //     var allid = [];
    //     $("input:checkbox[name=id]:checked").each(function() {
    //         allid.push($(this).val());
    //     });

    //     var socheckerd = document.querySelectorAll('input[name="id"]:checked').length;
    //     alert(le);
    // })
    

    $("#addcustomer").click(function(e) {
        e.preventDefault();
        var socheckerd = document.querySelectorAll('input[name="id"]:checked').length;
        if (socheckerd == 1) {
            var id = [];
            $("input:checkbox[name=id]:checked").each(function() {
                id.push($(this).val());
                // alert(id);
                $("#testModal").modal('show');
                $.ajax({
                    url: "/admin/listcustomer/addemail/" + id,
                    type: "GET",
                    success: function(response) {
                        // console.log(response);
                        // $('#listcustomeradd').val(response.customer[0].customer_name);
                        $('#listcustomeradd').html(
                            '<option value="' + response.customer[0].id + '">' + response.customer[0].customer_name + '</option>'
                        );
                    }
                })
            });
        } else if (socheckerd == 0) {
            $("#addModal").modal('show');
            // alert('Bạn chỉ được chọn 1 hàng mà bạn cần chỉnh sửa')

        } else {
            Swal.fire(
                'Không thể thực hiện!',
                'Bạn chỉ được chọn 1 khách hàng mà bạn cần thêm email!',
                'warning'
            )
        }

    });

    $('.delete_email').on('click', function () {
        // return confirm('Are you sure want to delete?');
        
        // console.log(id);
        event.preventDefault();//this will hold the url
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: "Bạn sẽ không khôi phục lại được dữ liệu này!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý!'
        }).then((result) => {
            if (result.isConfirmed) {
                // window.location.href = this.getAttribute('href');
                var id = $(this).data('id');
                $.ajax({
                    url: "/admin/listcustomer/delete/email/"+id,
                    type: "DELETE",
                })
                location.reload();
            }
        })
    });

    $('.delete1').on('click', function () {
        // return confirm('Are you sure want to delete?');
        
        // console.log(id);
        event.preventDefault();//this will hold the url
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: "Bạn sẽ không khôi phục lại được dữ liệu này!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý!'
        }).then((result) => {
            if (result.isConfirmed) {
                // window.location.href = this.getAttribute('href');
                var id = $(this).data('id');
                $.ajax({
                    url: "/admin/listcustomer/delete1/"+id,
                    type: "DELETE",
                })
                location.reload();
            }
        })
    });
})


