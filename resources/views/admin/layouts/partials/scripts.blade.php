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
        //Start add a new row in Attribute
        var count = 1;
        $('#add-attribute').click(function(){
                count = count + 1;
                var htmlCode = "<tr id='row"+count+"'>";
            htmlCode += "<td><input type = 'text' class='property' ></td>"; //IF u using " " have to use \"type\"
            htmlCode += "<td><input type='text' class='type' ></td>";
            htmlCode += " <td><input type='text' class='attribute_description' ></td>";
            htmlCode += "<td><input type='text' class='example_value'></td>";
            htmlCode += "<td><input type='text' class='required_default'></td>";
            htmlCode += " <td><input type='text' class='f'> </td>";
            htmlCode += "<td><input type='text' class='c' > </td>";
            htmlCode += " <td><input type=\"text\" class=\"r\"> </td>";
            htmlCode += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";
            htmlCode += "</tr>";
                $('#attribute-table').append(htmlCode);
            });
            $(document).on('click', '.remove', function(){
                var delete_row = $(this).data("row");
                $('#' + delete_row).remove();
            });

    //End add a new row in Attribute

    //Start add a new row in API
    $('#add-api').click(function() {
       const countApi = 1;
       var htmlApi = "<tr id ='row-api"+countApi+"'>";
       htmlApi += "<td><input type='text' class ='api-method' ></td>";
       htmlApi += "<td><input type='text' class ='api-url'></td>";
       htmlApi += "<td><input type ='text' class ='api-description'></td>";
       htmlApi += "<td><input type='text' class ='api-doc-updated'></td>";
       htmlApi += "<td><input type='text' class ='api-status'></td>";
       htmlApi += "<td><button type='button' name='remove-api' data-row='row"+countApi+"' class='btn btn-danger btn-xs remove-api'>-</button></td>";
        htmlApi += "</tr>";
       $('#api-table').append(htmlApi);
    });
        $(document).on('click', '.remove-api', function(){
           var deleteApi = $(this).data('row');
           $('#' + deleteApi).remove();
        });
    //End add a new row in API

//        function fetch_item_data()
//        {
//            $.ajax({
//                url:"fetch.php",
//                method:"POST",
//                success:function(data)
//                {
//                    $('#inserted_item_data').html(data);
//                }
//            })
//        }
//        fetch_item_data();


        $('#addVersion').click(function() {   // This function using to convert many fields in a row of a table into an object and changes it into json before submitting.
            const list = [];
            $('#attribute_table tbody tr').each(function(i, e){
                var property = $(this).find(".property").val();
                var type = $(this).find(".type").val();
                var attribute_description = $(this).find(".attribute_description").val();
                var example_value = $(this).find(".e_value").val();
                var required_default = $(this).find(".f").val();
                var f = $(this).find(".f").val();
                var c = $(this).find(".c").val();
                var r = $(this).find(".r").val();
                list.push({property:property, type:type, attribute_description:attribute_description,example_value:example_value, required_default:required_default, f:f, c:c, r:r });
            });
            $('#attribute').val(JSON.stringify(list));
            $('#submit-version').submit();
        });
            {{--$.ajax({--}}
                {{--url: '{{ route('module.add') }}',--}}
                {{--method: "POST",--}}
                {{--data: {"list": list, "_token": "{{ csrf_token() }}"}, //Data send to server (Request)--}}

                {{--success:function(data){   //Data receive from server (Response)--}}
                    {{--console.log('abccc');--}}
                {{--}--}}
            {{--});--}}

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
    }+
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
            return true;
        return false;
    }

    $(document).ready(function(){

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