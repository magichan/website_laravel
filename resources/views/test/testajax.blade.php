<!DOCTYPE HTML>
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ajax Example</title>
        <script type="text/javascript" src="//cdn.bootcss.com/jquery/3.0.0-beta1/jquery.js"></script>
        <meta name="_token" content="{{ csrf_token() }}"/>
</head>
<body>
        <ul id="info1">
                <li>Put anything in the field below.</li>
        </ul>
        <form id="form1">
                <input type="text" name="field1" id="field1">
                <input type="submit" name="submit" id="submit" value="Submit Form">
        </form>
        <script>
        $('#form1').submit(function(event) {
                event.preventDefault();
                $.ajax({
                        type: 'POST',
                          headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
},
                        url: '{{url('test/ajax')}}',
                        data:{'sourceLink':'http://78re52.com1.z0.glb.clouddn.com/resource/gogopher.jpg?imageMogr2/crop/!300x300a30a100',
                              "a_x":300,
                              "a_y":300,
                              "e_width":230,
                              "e_height":230
                },
                        dataType: 'json',
                        success: function (data) {
                                console.log(data);
                                $('#info1').html(data.status);
                        }
                });
        });
        </script>
</body>
</html>
