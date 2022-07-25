<?session_start();?>
<?include "../../inc/db/db.php"; $ipcc_db = db_connect();?>
<?include "../../inc/common/cn_function.php"; ?>

<?
$datetemp = date("Ymd");
$writedate = date("YmdHis");

$user_id = $_SESSION['AgtID'];
$user_nm = $_SESSION['AgtName'];

$cid = $_REQUEST['cid'];
$pre_space = $_REQUEST['space'];
$dnis = $_REQUEST['dnis'];
//$cid = '01096168792';
//$pre_space = '1';
$space = "";
switch ($pre_space) {
	case '1'  : $space = "[검진 예약 및 일정변경]"; break;
	case '2'  : $space = "[결과상담]"; break;
	case '3'  : $space = "[기타문의]"; break;

}


?>
<html>
<head>
	<title>전화가 왔습니다</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="../../inc/css/common.css" type="text/css">
	<script language="javascript">
		function windowOnClose(val){
			//시스템메뉴 종료버튼으로 종료
			//var new_id = document.fm.new_id.value;
			var call_no = document.fm.call_no.value;
			returnValue = val + "," + call_no;
			//returnValue = new_id + "," + call_no;
			//alert(returnValue);
			
			dialogArguments.answer();
			
			window.close();
		}
	</script>
</head>
<body>
	<table width="550" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<!-- <td height="40" bgcolor="#cccccc" align="center" colspan="2"><font size="4" face="굴림"><b> 대표번호 :  <?=ConvertTel($dnis)?></b></font></td> -->
		</tr>
		<tr>
			<td height="40" bgcolor="#cccccc" align="center" colspan="2"><font size="3" face="굴림"><b> <?=$space?> <?=ConvertTel($cid)?> &nbsp;전화가 왔습니다.</b></font></td>
		</tr>
		<tr>
			<td height="10" align="center" colspan="1"></td>
		</tr>
		<tr>
			<td height="100" align="center" colspan="3"><img src="../../image/main/km35_1637313.jpg"></td>
		</tr>
		<tr>
			<td height="10" align="center" colspan="1"></td>
		</tr>
	</table>

	<table width="550" border="0" cellpadding="0" cellspacing="1" bgcolor="#A3C6D7">
	<!-- <tr bgcolor="#EEF5F8"> -->
		<!-- <td width="7%" align="center" height="22">NO</td>
		<td width="11%" align="center" height="22">분 류</td>
		<td width="12%" align="center">업체/닉</td>
		<td width="12%" align="center">고객명</td>
		<td width="25%" align="center">전화번호</td>
		<td width="15%" align="center">핸드폰번호</td>
		<td width="6%" align="center">선택</td>
		<td width="24%" align="center">이메일</td> -->

<?
if ($cid == ""){
		$new_id = "NON";
?>
		<!-- <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#E7E7E7'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="cursor:hand" align="center">
			<td height="25" colspan="5"><?=ConvertTel($cid)?>는 등록되지 않은 번호입니다. 확인을 눌러주세요.</td>
			<td ><input type="button" name="btn_daegi_cancel" value="확 인" class="btnType1" onClick="windowOnClose('<?=$new_id?>')" style="height:22px;width=60px;"></td>
		</tr> -->
		<tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#E7E7E7'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="cursor:hand" align="center">
			<td height="25" colspan="6"><?=ConvertTel($cid)?>로 전화가 왔습니다. 확인을 눌러주세요.</td>
		</tr>
		<tr>
			<td height="25" colspan="6"><input type="button" name="btn_daegi_cancel" value="확 인" class="btnType1" onClick="windowOnClose('<?=$new_id?>')" style="height:22px;width=550px;"></td>
		</tr>

<?
} else {

	$sql = "select idx,cust_type, cust_office, cust_name, cust_hp, cust_tel from customer where replace(replace(cust_tel,'-',''),' ','') = '" . str_replace("-","",$cid) . "' or replace(replace(cust_hp,'-',''),' ' ,'') = '" . str_replace("-","",$cid) . "'";
	//$sql = "select idx, cust_name, cust_hp, cust_tel, cust_mail from customer where replace(replace(cust_tel,'-',''),' ','') = '" . str_replace("-","",$cid) . "' or replace(replace(cust_hp,'-',''),' ' ,'') = '" . str_replace("-","",$cid) . "'";
	$result = db_exec($ipcc_db, $sql);
	$row = db_numrows($result);

	if ($row < 1){
		$new_id = "NON";
?>
		<!-- <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#E7E7E7'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="cursor:hand" align="center">
			<td height="25" colspan="5"><?=ConvertTel($cid)?>는 등록되지 않은 번호입니다. 확인을 눌러주세요.</td>
			<td ><input type="button" name="btn_daegi_cancel" value="확 인" class="btnType1" onClick="windowOnClose('<?=$new_id?>')" style="height:22px;width=60px;"></td>
		</tr> -->
		<tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#E7E7E7'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="cursor:hand" align="center">
			<td height="25" colspan="6"><?=ConvertTel($cid)?>는 등록되지 않은 번호입니다. 확인을 눌러주세요.</td>
			<!-- <td height="25" colspan="6"><input type="button" name="btn_daegi_cancel" value="확 인" class="btnType1" onClick="windowOnClose('<?=$new_id?>')" style="height:22px;width=10px;"></td> -->
		</tr>
		<tr>
			<td height="25" colspan="6"><input type="button" name="btn_daegi_cancel" value="확 인" class="btnType1" onClick="windowOnClose('<?=$new_id?>')" style="height:22px;width=550px;"></td>
		</tr>

<?
	} else {

		$n=1;
		while( $data = db_fetch_array($result) )
		{
		$new_id	= $data["idx"];
		$cust_type = $data["cust_type"];
		$cust_office = $data["cust_office"];
		$cust_name = $data["cust_name"];
		$cust_tel = $data["cust_tel"];
		$cust_hp = $data["cust_hp"];
		//$cust_mail = $data["cust_mail"];
?>

		<tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#E7E7E7'" onMouseOut="this.style.backgroundColor='#FFFFFF'" style="cursor:hand" align="center">
			<!-- <td height="25"><?=$n?></td> -->
		<!-- 	<td height="25"><?=$cust_type?></td>
		<td><?=$cust_office?></td>
		<td><?=$cust_name?></td>
		<td><?=ConvertTel($cust_tel)?></td>
		<td><?=ConvertTel($cust_hp)?></td> -->
			<!-- <td><?=$cust_mail?></td> -->
		<!-- </tr>
		<tr> -->
			<td height="25" colspan="1"><input type="button" name="btn_daegi_cancel" value="확 인" class="btnType1" onClick="windowOnClose('<?=$new_id?>')" ></td>
		</tr>
	<?
		$n = $n + 1;
		}
?>
	</table>
<?
	}

}
	//	Call_no 코드
	$sql2 = "SELECT MAX(call_no) AS max_id FROM call_list WHERE call_no LIKE '$datetemp%'";
	$result2 = db_exec($ipcc_db, $sql2);
	$data = db_fetch_array($result2);

	if ( !$data ) {
		$call_no = $datetemp."_0001";
	} else {
		$max_id = $data["max_id"];

		if (!$max_id){
			$call_no = $datetemp."_0001";
		} else {
			$tmp_id = substr($max_id,9,4);

			if ($tmp_id == "" or empty($tmp_id)) {
				$call_no = $datetemp & "_0001";
			} else {
				$new_max_id = $tmp_id + 1;

				if ($new_max_id < 10){
					$call_no = $datetemp . "_000" . $new_max_id;
				}else if ($new_max_id < 100){
					$call_no = $datetemp . "_00" . $new_max_id;
				}else if ($new_max_id < 1000){
					$call_no = $datetemp . "_0" . $new_max_id;
				} else {
					$call_no = $datetemp . "_" . $new_max_id;
				}
			}
		}
	}

	$sql2 = "insert into call_list (call_no, cust_cd, call_date, agt_id, agt_name, call_cid, save_yn) values";
	$sql2 .= "('$call_no', '$new_id', '$writedate', '$user_id', '$user_nm', '$cid', 'N')";
	db_exec($ipcc_db, $sql2);
	db_close($ipcc_db);

?>
</body>
</html>

<form name="fm">
	<input type="hidden" name="new_id" value="<?=$new_id?>">
	<input type="hidden" name="call_no" value="<?=$call_no?>">
</form>
