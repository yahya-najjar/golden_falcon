<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('assets/js/perfect-scrollbar.jquery.min.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('assets/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--sparkline JavaScript -->
<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!--c3 JavaScript -->
<script src="{{ asset('assets/plugins/d3/d3.min.js') }}"></script>
<script src="{{ asset('assets/plugins/c3-master/c3.min.js') }}"></script>
<!-- Popup message jquery -->
<script src="{{ asset('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>

<!-- Sweet-Alert  -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.js"></script>

<!-- Plugin JavaScript -->
<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

<script>

    $('#date-format').bootstrapMaterialDatePicker({format: 'dddd DD MMMM YYYY - HH:mm'});

    $('[data-delete]').click(function (e) {
        e.preventDefault();

        swal({
            title: "هل أنت متأكد؟",
            text: "لايمكنك استرجاع ذلك لاحقاً",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parent().find('> #delete').submit();
                } else {
                }
            });

    });

    $('[data-editable]').click(function () {

        $.ajax({
            type: 'POST',
            url: $(this).data('action'),
            context: this,
            data: {
                '_token': '{{ csrf_token() }}'
            },
            success: function (data) {
                console.log(data);
                var message = '';
                if (data.status) {
                    if (data.type == 'active') {
                        $(this).find('i').removeClass('mdi-eye-outline').addClass('mdi-eye-outline-off');
                        message = 'تم إظهار العنصر!';
                    } else if (data.type == 'home') {
                        $(this).find('i').removeClass('mdi-home').addClass('mdi-home-outline');
                        message = 'تم العرض في الرئيسية!';
                    }

                } else {
                    if (data.type == 'active') {
                        $(this).find('i').removeClass('mdi-eye-outline-off').addClass('mdi-eye-outline');
                        message = 'تم إخفاء العنصر!';
                    } else if (data.type == 'home') {
                        $(this).find('i').removeClass('mdi-home-outline').addClass('mdi-home');
                        message = 'تمت الإزلة من الرئيسية!';
                    }

                }

                swal(message, '', "success");
            }
        })
    });

    $('[data-logout]').click(function (e) {
        e.preventDefault();
        swal({
            title: "هل أنت متأكد؟",
            text: "نتمنى رؤيتك قريباً",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $(this).parent().find('> form').submit();
                } else {
                    // swal("تم الإلغاء!");
                }
            });
    })


</script>

<script src="/assets/plugins/tinymce/tinymce.min.js"></script>

<script !src="">
    $(document).ready(function () {

        if ($(".mymce").length > 0) {
            tinymce.init({
                selector: "textarea.mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
</script>

<script>
    $('[markAllRead]').click(function (e) {
        e.preventDefault();

        swal({
            title: "هل أنت متأكد؟",
            text: "سيتم تعليم جميع الإشعارات كمقروء !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: '{{ action('Admin\NotificationController@markAllRead') }}',
                    context: this,
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function (data) {
                        $(this).parent().html("لا يوجد إشعارات جديدة");
                        $('.message-center').remove();
                        $('.heartbit').remove();
                        $('.point').remove();

                        swal({
                            title: "تم تعليم جميع الإشعارات كمقروء!",
                            icon: "success",
                            button: "OK!",
                        });
                    }
                });
            } else {
                swal("تم الإلغاء!");
            }
        });
    });

    $('[notification]').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '{{ action('Admin\NotificationController@markAsRead') }}',
            context: this,
            data: {
                '_token': '{{ csrf_token() }}',
                'note_id': $(this).data('noteid')
            },
            success: function (data) {
                location.href = $(this).attr('href');
            }

        });
    });
</script>

<script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/multiselect/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script>
    // $(".select2").select2();
    $('.select2-multiple').multiSelect();
</script>