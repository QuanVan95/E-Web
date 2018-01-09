<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-growl/jquery.bootstrap-growl.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/amcharts.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/serial.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pie.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/radar.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/light.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/patterns.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/chalk.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/ammap.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/worldLow.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/amstock.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/horizontal-timeline.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.flot.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.vmap.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.vmap.russia.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.vmap.world.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.vmap.europe.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.vmap.germany.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.vmap.usa.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-sweetalert/sweetalert.min.js')}}" type="text/javascript"></script> //Using for confirming to delete
<script src="{{ asset('js/fileup.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('js/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('js/dashboard.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('js/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/quick-sidebar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-summernote/summernote.min.js') }}"></script>
<script src="{{ asset('js/quick-nav.min.js') }}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script type="text/javascript">
    jQuery( function(){
        jQuery( document ).trigger( "enhance" );
    });
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 500,
            fontNames: [ 'Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Sacramento', 'AvenirNext'],
            fontNamesIgnoreCheck: [ 'Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Sacramento', 'AvenirNext'],
            callbacks: {
                onPaste: function(e) {
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text/html');

                    e.preventDefault();

                    document.execCommand('insertHtml', false, bufferText.replace(/style="[^"]*"/g,''));
                },
                onImageUpload: function(image) {
                    uploadImage(image[0]);
                }
            }
        });
    });
    function uploadImage(image) {
        $.ajaxSetup({
            headers:
                { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: '{{ route('upload') }}',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function(data) {
                var image = $('<img>').attr('src', '{{ asset('images/posts') }}/' + data.file);
                $('#summernote').summernote("insertNode", image[0]);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
    function getSlug() {
        var slug = function(str) {
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
            var to   = "aaaaaeeeeeiiiiooooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            return str;
        };
        var name = $('#name').val();
        $('#url').val(slug(name)+'.html');
    }
    function onDelete (url) {
        swal({
            title: 'Bạn chắc chắn?',
            text: "",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Thoát',
        },
        function(isConfirm){
            if (isConfirm){
                window.location = url;
            }
        });
    }
    function onMember (url) {
        swal({
                title: 'Bạn chắc chắn?',
                text: "",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Thoát',
            },
            function(isConfirm){
                if (isConfirm){
                    $.get(url, function(data, status){
                        if(data.status == false){
                            notify(data);
                        }
                        else{
                            $('#courseMember').empty();
                            var content = '';
                            _.forEach(data.item.data,function (v,i) {
                                content += `
                                    <tr>
                                        <td>${v.member.name}</td>
                                        <td>${v.member.cmnd}</td>
                                        <td>${v.member.phone}</td>
                                        <td>${v.member.address}</td>
                                        <td>${v.member.email}</td>
                                        <td>${v.member.birth_date}</td>
                                        <td>
                                            <a class="btn btn-danger btn-sm" onclick="return onMember('${window.location.origin}/admin/course/member/${v.id}')"><i class="fa fa-close"></i></a>
                                        </td>
                                    </tr>
                                `;
                            });
                            $('#courseMember').append(content);
                            notify(data);
                        }
                    });
                }
            });
    }
    function notify(data) {
        $.bootstrapGrowl(data.message, {
            ele: 'body', // which element to append to
            type: data.action, // (null, 'info', 'danger', 'success', 'warning')
            offset: {
                from: 'bottom',
                amount: 50
            }, // 'top', or 'bottom'
            align: 'left', // ('left', 'right', or 'center')
            width: 'integer', // (integer, or 'auto')
            delay: 5000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
    }
    $('.percent').blur(function () {
        $('.total').focus();
        $('.total').blur();
    });
    function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if(charCode == 59 || charCode == 46)
            return true;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
    $(document).ready(function(){
        var count = 1;
        $('#add').click(function(){
            console.log(1);
            count = count + 1;
            var html_code = "<tr id='row"+count+"'>";
            html_code += "<td contenteditable='true' class='property'></td>";
            html_code += "<td contenteditable='true' class='type'></td>";
            html_code += "<td contenteditable='true' class='attribute_description'></td>";
            html_code += "<td contenteditable='true' class='example_value'></td>";
            html_code += "<td contenteditable='true' class='required_default'></td>";
            html_code += "<td contenteditable='true' class='f'></td>";
            html_code += "<td contenteditable='true' class='c'></td>";
            html_code += "<td contenteditable='true' class='l'></td>";
            html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";
            html_code += "</tr>";
            $('#crud_table').append(html_code);
        });
        $(document).on('click', '.remove', function(){
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });

        $('#save').click(function(){
            var item_name = [];
            var item_code = [];
            var item_desc = [];
            var item_price = [];
            $('.item_name').each(function(){
                item_name.push($(this).text());
            });
            $('.item_code').each(function(){
                item_code.push($(this).text());
            });
            $('.item_desc').each(function(){
                item_desc.push($(this).text());
            });
            $('.item_price').each(function(){
                item_price.push($(this).text());
            });
            $.ajax({
                url:"insert.php",
                method:"POST",
                data:{item_name:item_name, item_code:item_code, item_desc:item_desc, item_price:item_price},
                success:function(data){
                    alert(data);
                    $("td[contentEditable='true']").text("");
                    for(var i=2; i<= count; i++)
                    {
                        $('tr#'+i+'').remove();
                    }
                    fetch_item_data();
                }
            });
        });

        function fetch_item_data()
        {
            $.ajax({
                url:"fetch.php",
                method:"POST",
                success:function(data)
                {
                    $('#inserted_item_data').html(data);
                }
            })
        }
        fetch_item_data();
    });
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)  //using jquery.bootstrap-growl.js'
        @if(Session::has($msg))
        $.bootstrapGrowl('{!! Session::get($msg) !!}', { // Get value of the message
            ele: 'body', // which element to append to
            type: '{{ $msg }}', // (null, 'info', 'danger', 'success', 'warning')
            offset: {
                from: 'top',
                amount: 81
            }, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 'integer', // (integer, or 'auto')
            delay: 5000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
        @endif
    @endforeach
    $.fileup({
            inputID: 'upload-2',
            dropzoneID: 'upload-2-dropzone',
            queueID: 'upload-2-queue',
            key: 'data',
        });
</script>