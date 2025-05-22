<html xmlns='https://www.w3.org/1999/xhtml'>
<head></head>
<body>

<form action='https://checkout.payfort.com/FortAPI/paymentPage' method='post' name='frm'>
@foreach($requestParams as $a => $b )
@php $a=htmlentities($a); $b=htmlentities($b); @endphp
    <input type='hidden' name='{{$a}}' value='{{$b}}'>
@endforeach
<script type='text/javascript'>
document.frm.submit();
</script>
</form>
</body>
</html>