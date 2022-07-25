<?session_start();?>
<?include "../../inc/db/db.php"; $ipcc_db = db_connect();?>
<?include "../../inc/common/common.php"; ?>
<?include "../../inc/common/cn_function.php"; ?>

<?
//현재날짜를 계산한다(YYYY-MM-DD HH:MM:SS)
$datetemp = date("Y-m-d");
$datetemp1 = date("Ymd");
$writedate = date("His");
$writedatetime = $datetemp1;
$input_day = $datetemp1.$writedate;

$AgtID	 	= $_SESSION['AgtID'];
$AgtPW	 	= $_SESSION['AgtPW'];
$AgtName	= $_SESSION['AgtName'];
$AgtAuth	= $_SESSION['AgtAuth'];

$mode	= $_REQUEST["mode"];
$idx = $_REQUEST['idx'];
$ext_hospital = $_REQUEST['ext_hospital'];
$ext_floor = $_REQUEST['ext_floor'];
$ext_division = $_REQUEST['ext_division'];
$ext_name = $_REQUEST['ext_name'];
$ext_position = $_REQUEST['ext_position'];
$ext_hp = $_REQUEST['ext_hp'];
$ext_tel = $_REQUEST['ext_tel'];
$ext_tel2 = $_REQUEST['ext_tel2'];

$ext_hp = $_REQUEST['ext_hp'];
$ext_tel = $_REQUEST['ext_tel'];
$ext_tel2 = $_REQUEST['ext_tel2'];

$ext_hp	= str_replace("-","",$ext_hp);
$ext_tel	= str_replace("-","",$ext_tel);
$ext_tel2 = str_replace("-","",$ext_tel2);


if ($mode=="N"){

			
		$sql = "insert into extension ( ";
		$sql .= "	 ext_hospital";
		$sql .= ",	 ext_floor";
		$sql .= ",	 ext_division";
		$sql .= ",	 ext_name";
		$sql .= ",	 ext_position";
		$sql .= ",	 ext_hp";
		$sql .= ",	 ext_tel";
		$sql .= ",	 ext_tel2";
		$sql .= ") values (";
		$sql .= "  '$ext_hospital'";
		$sql .= ", '$ext_floor'";
		$sql .= ", '$ext_division'";
		$sql .= ", '$ext_name'";
		$sql .= ", '$ext_position'";
		$sql .= ", '$ext_hp'";
		$sql .= ", '$ext_tel'";
		$sql .= ", '$ext_tel2'";
		$sql .= " )";
		db_exec($ipcc_db, $sql);
		

?>
			<script language="javascript">
			
				alert("성공적으로 등록되었습니다.   ");
				location.href = "extension_list.php";
			
			</script>
<?
	

			
		
}else if ($mode=="M"){	
	$sql = "UPDATE extension SET ";
	$sql .= " ext_hospital = '$ext_hospital', ";
	$sql .= " ext_floor = '$ext_floor', ";
	$sql .= " ext_division = '$ext_division', ";
	$sql .= " ext_name = '$ext_name', ";
	$sql .= " ext_position = '$ext_position', ";
	$sql .= " ext_hp = '$ext_hp', ";
	$sql .= " ext_tel = '$ext_tel', ";
	$sql .= " ext_tel2 = '$ext_tel2' ";
	$sql .= " WHERE idx = $idx";
	db_exec($ipcc_db, $sql);
?>
	<script language="javascript">
	<!--
		alert("성공적으로 수정되었습니다.");
		location.href = "extension_view.php?idx=<?=$idx?>&mode=M";
	//-->
	</script>
<?
	
}else if ($mode=="D"){
	

	$sql = "DELETE FROM extension WHERE idx = $idx";
	db_exec($ipcc_db, $sql);
		
?>
		<script language="javascript">
		<!--
			alert("성공적으로 삭제되었습니다.  ");
			location.href = "./extension_list.php";
		//-->
		</script>
<?
}
?>