<?php
$userid	 	= $_SESSION['AgtID'];

if ($userid==""){
?>
	<SCRIPT LANGUAGE="javascript">
		alert("로그인후 다시 이용하여 주십시오");
		location.href ="index.php";
	</script>
<?php
}
?>
