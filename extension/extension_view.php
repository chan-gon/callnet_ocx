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

if(isset($_REQUEST['idx']) && !empty($_REQUEST['idx'])){
	$idx = $_REQUEST['idx'];
}else {
	$idx = 0;
}

$mode = $_REQUEST['mode'];

if ($mode=="") $mode="N";

if ($mode=="N"){
	$ext_hospital	= "";
	$ext_floor		= "";
	$ext_division	= "";
	$ext_name		= "";
	$ext_position	= "";
	$ext_hp			= "";
	$ext_tel		= "";
	$ext_tel2		= "";

} else if ($mode=="M"){
	$sql = "select * from extension where idx = $idx";
	$result = db_exec($ipcc_db, $sql);
	$row = db_numrows($result);
	if ( $row <= 0 ) {
		$ext_division	= "";
		$ext_name		= "";
		$ext_position	= "";
		$ext_hp			= "";
		$ext_tel		= "";
		$ext_tel2		= "";
	}else{
		$data = db_fetch_array($result);

		//$agt_id		= $data["agt_id"];		//'아이디
		$ext_division = $data['ext_division'];
		$ext_name = $data['ext_name'];
		$ext_position = $data['ext_position'];
		$ext_hp = ConvertTel($data['ext_hp']);
		$ext_tel = ConvertTel($data['ext_tel']);
		$ext_tel2 = ConvertTel($data['ext_tel2']);
	}
}


?>
<html>
<head>
<title>상담원 관리</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="../../inc/js/sy.js"></script>
<script src="../../inc/js/ctiUtilEtc.js"></script>
<link href="../../inc/css/main.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function fnc_golist(){	
	location.href = "./extension_list.php";
}

function fnc_save(){

	
		document.ExtForm.submit();
	
}

//-->
</SCRIPT>
</head>
<BODY leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">

<table width="808" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	  <table width="808" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="6">&nbsp;</td>
          <td valign="top">
		    <table width="75" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="../../image/img_main/img_05.jpg" width="802" height="12"></td>
              </tr>
              <tr>
                <td background="../../image/img_main/img_87.jpg">
				  <table width="802" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td align="center">
					  <!-- 여기부터 본문 내용 -->
<table width="780" border="0" cellspacing="0" cellpadding="0">
	<tr> 
		<td height="30">
<form name="ExtForm" method="post" action="extension_ok.php">
	<input type="hidden" name="mode" value="<?=$mode?>">
	<input type="hidden" name="idx" value="<?=$idx?>">
			  <br>
			<img src="../../image/img_main/img_31.gif">
			<table width="780" border="0" cellpadding="2" cellspacing="1" bgcolor="A3C6D7" align="center">
				<tr bgcolor="#FFFFFF">
					<td width="90" align="center" bgcolor="EEF5F8">부서</td>
					<td width="170" align="left">&nbsp;<input type="text" name="ext_division" size="20" value="<?=$ext_division?>"></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td align="center" height="25" bgcolor="EEF5F8">성명</td>
					<td align="left">&nbsp;<input type="text" name="ext_name" size="20" value="<?=$ext_name?>"></td>
					<td align="center" bgcolor="EEF5F8">직책</td>
					<td align="left">&nbsp;<input type="text" name="ext_position" size="20" value="<?=$ext_position?>"></td>
					<td align="center" bgcolor="EEF5F8">핸드폰</td>
					<td align="left">&nbsp;<input type="text" name="ext_hp" size="20" value="<?=$ext_hp?>"></td>
				</tr>
					<tr bgcolor="#FFFFFF">
					<td align="center" height="25" bgcolor="EEF5F8">전화번호</td>
					<td align="left">&nbsp;<input type="text" name="ext_tel" size="20" value="<?=$ext_tel?>"></td>
					<td align="center" bgcolor="EEF5F8">전화번호2</td>
					<td align="left">&nbsp;<input type="text" name="ext_tel2" size="20" value="<?=$ext_tel2?>"></td>
					<td align="center" colspan="2"></td>
					
				</tr>



				</form>
			</table>			
		</td>
	</tr>
	<tr>
		<td>
			<table>				
				<tr bgcolor="#FFFFFF">
					<td height="25" align="left" colspan="99" bgcolor="ffffff">
						<input type="button" name="btn_TelHist" value="저장" class="btnType4" style="height:22px;width=70px;" onclick="fnc_save();">
						<input type="button" name="btn_List" value="리스트보기" class="btnType4" style="height:22px;width=70px;" onclick="fnc_golist();">
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<td height="15" colspan="99" bgcolor="ffffff"></td>
	</tr>
</table>

					  <!-- 여기까지 -->
					  </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td><img src="../../image/img_main/img_99.jpg" width="802" height="12"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</BODY>
</HTML>