<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cors Laravel 7</title>
</head>
<body>
    
</body>
<script>

$.ajax({
    method:'GET',
    url:"{{route('apiCors')}}",
    dataType:json,
    success:function(data){
       console.log(data);
    }
});

</script>
</html>