<?session_start();?>
<?include "../../inc/db/db.php"; $ipcc_db = db_connect();?>
<?include "../../inc/common/common.php"; ?>
<?include "../../inc/common/cn_function.php"; ?>

<?

//AP DB Connect
$sec_array = parse_ini_file( "../../ENV.INI", true );
$dbset  = $sec_array['DB']['DBSET'];
$host  	= $sec_array['DB']['HOST'];
$db  	= $sec_array['DB']['DB'];
$user 	= $sec_array['DB']['USER'];
$pass  	= $sec_array['DB']['PASS'];

ob_start();
setcookie("dbset", $dbset);
setcookie("db", $db);
setcookie("host", $host);
setcookie("user", $user);
setcookie("pass", $pass);
ob_end_clean();


if(isset($_REQUEST['pagestart']) && !empty($_REQUEST['pagestart'])){
	$pagestart = $_REQUEST['pagestart'];
}else {
	$pagestart = "";
}

if(isset($_REQUEST['pagenum']) && !empty($_REQUEST['pagenum'])){
	$pagenum = $_REQUEST['pagenum'];
}else {
	$pagenum = 0;
}

if(isset($_REQUEST['ext_name']) && !empty($_REQUEST['ext_name'])){
	$ext_name = $_REQUEST['ext_name'];
}else {
	$ext_name = "";
}

if(isset($_REQUEST['ext_hp']) && !empty($_REQUEST['ext_hp'])){
	$ext_hp = $_REQUEST['ext_hp'];
}else {
	$ext_hp = "";
}

if(isset($_REQUEST['ext_tel']) && !empty($_REQUEST['ext_tel'])){
	$ext_tel = $_REQUEST['ext_tel'];
}else {
	$ext_tel = "";
}


if (!$pagenum){
	$pagenum = 0;
}

$page = 50;
$start = $page * $pagenum;

// 페이징 관련 변수 생성 시작
$str_search = "";
if ($ext_name) { $str_search .= "&ext_name=$ext_name"; }
if ($ext_hp) { $str_search .= "&ext_hp=$ext_hp"; }
if ($ext_tel) { $str_search .= "&ext_tel=$ext_tel"; }

?>

<html>
<head>
<title>무제 문서</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../../inc/css/main.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
//조회
function fnc_search() {
	
	
	document.ExtensionForm.submit();
}

// 엔터키 클릭 시 고객정보 조회 창 열기
function keyPressed(step) {
	if(window.event.keyCode == 13) {
			fnc_search();	
	}	
}

function windowOnClose(a){
	opener.document.getElementById("telno").value  = a;
		window.close();
}

//-->
</script>
</head>
<body leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">

<style>
.hLock {
 position: relative;
 top:expression(document.getElementById("divScrol").scrollTop);
 z-index:99;
}
</style>


<!-- 달력 표시용 시작 -->
<script event=onclick() for=document >
if(popCal.style.visibility == "visible") {
	popCal.style.visibility="hidden";
}
</script>
<script language=javascript>
function setDate(iYear,iMonthStr,iDayStr, gdCtrl) { 
	gdCtrl.value = toDateFormat(gdCtrl.value);
}

function toDateDeFormat(str) {
	return str.replace(/\./g, "");
}

function toDateFormat(str) {
	str = toDateDeFormat(str);
	return toMask(str, '9999-99-99'); 
}

function toMask(val, mask) {
	if(!mask || !val) return val;
	var tStr="";
	var j=0;
	var ch='';
	for(var i=0; i < val.length; i++) {
		j++;
		while (j <= mask.length && mask.charAt(j - 1) != "9") {
			tStr += mask.charAt(j - 1);
			j++;
		}
		ch = val.charAt(i);
		if(mask.charAt(j) == '9') {
			tStr += (ch>=0 && ch<=9)?ch:'';
		} else {
			tStr += ch;
		}
	}
	return tStr;
}
</script>
<div id='popCal' style='POSITION:absolute;visibility:hidden;z-index:2;border:2px ridge;width:10'>
<IFRAME name="popFrame" src="../../inc/js/calendar.htm" frameborder="0" scrolling="no" width=240 height=250></IFRAME>
</div>

<!----------------- Calendar ----------------------------------------------------------------->
<script language="javascript" src="../../inc/js/Calendar.js"></script>
<!----------------- Calendar ----------------------------------------------------------------->

<!-- 달력 표시용 끝 -->

<table width="808" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	  <table width="808" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td width="6">&nbsp;</td>
		  <td valign="top">
			<table width="75" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td height="1"></td>
			  </tr>
			</table>
			<table width="75" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td><img src="../../image/img_main/img_05.jpg" width="802" height="12"></td>
			  </tr>
			  <tr>
				<td background="../../image/img_main/img_87.jpg">
				  <table width="802" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr> 
					  <td>
						<table width="790" border="0" cellspacing="0" cellpadding="0" align="center">
						  <tr>
							<td width="5"></td>
							<td width="780" valign="top">

<!---상담내역조회 시작 -->

<table width="780" border="0" cellpadding="0" cellspacing="0">
<form name="ExtensionForm" method="post" action="extension.php">
	<tr>
		<td width="50%" align="left" height="24"><img src="../../image/img_main/img_30.gif"></td>
		<td width="50%" align="right" valign="top">
			<input type="button" name="btn_sd_save" value="조회" class="btnType4" onClick="fnc_search();" style="height:20px;width=40px;">
	</tr>
</table>
<table width="780" border="0" cellpadding="2" cellspacing="1" bgcolor="#A3C6D7">
	
	
	<tr bgcolor="#FFFFFF">
		<td align="center" bgcolor="#EEF5F8">명칭검색</td>
		<td >
			<input name="ext_name" type="text" size="15" value="<?=$ext_name?>" onkeypress="keyPressed(1)">
		</td>
		<td align="center" bgcolor="#EEF5F8">휴대폰검색</td>
		<td >
			<input name="ext_hp" type="text" size="15" value="<?=$ext_hp?>" onkeypress="keyPressed(1)">
		</td>
		<td align="center" bgcolor="#EEF5F8">전화번호검색</td>
		<td >
			<input name="ext_tel" type="text" size="15" value="<?=$ext_tel?>" onkeypress="keyPressed(1)">
		</td>
</tr>
	
</form>
</table>


<table>
	<tr>
		<td height="5" ><td>
	</tr>
</table>

<DIV id="divScrol" style="width:780px; height:600px; z-index:1; OVERFLOW: auto;">
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#A3C6D7">
	<tr class="hLock">
		<td width="3%" height="30" align="center" bgcolor="#EEF5F8">NO</td>
		<!-- <td width="10%" align="center" bgcolor="#EEF5F8">병원</td>
		<td width="10%" align="center" bgcolor="#EEF5F8">지역</td> -->
		<td width="10%" align="center" bgcolor="#EEF5F8">부서</td>
		<td width="10%" align="center" bgcolor="#EEF5F8">성명</td>
		<td width="10%" align="center" bgcolor="#EEF5F8">직책</td>
		<td width="10%" align="center" bgcolor="#EEF5F8">핸드폰</td>
		<td width="10%" align="center" bgcolor="#EEF5F8">전화번호</td>
		<td width="10%" align="center" bgcolor="#EEF5F8">전화번호2</td>
	</tr>
<?

?>
<?


	$sql = "SELECT * FROM extension where 1 = 1";
	if ($ext_name!="") { $sql .= " and ext_name like '%$ext_name%'"; }	
	if ($ext_hp!="") { $rep_ext_hp = str_replace("-", "", $ext_hp);  $sql .= " and ext_hp like '%$rep_ext_hp'%"; }	
	if ($ext_tel!="") { 
			$rep_ext_tel = str_replace("-", "", $ext_tel); 
			$sql .= " and (ext_tel like '%$rep_ext_tel%' or ext_tel2 like '%$rep_ext_tel%')";
	    }	
	$sql .= " LIMIT $page OFFSET $start";
	$result = db_exec($ipcc_db, $sql);
	$tot_cnt = db_numrows($result);
	$total = $tot_cnt;
	$pagesu = ceil($total / $page);
			
	if ($tot_cnt <= 0) {
	?>
	<tr>
		<td height="50" colspan="99" bgcolor="#FFFFFF" align="center">

		검색에 대한 정보가 없습니다.</td>
	</tr>
	<?
	} else {

		$n=1;
		while( $data = db_fetch_array($result) )
		{	
			//$idx = $data['idx'];
			$ext_hospital = $data['ext_hospital'];
			$ext_floor = $data['ext_floor'];
			$ext_division = $data['ext_division'];
			$ext_name = $data['ext_name'];
			$ext_position = $data['ext_position'];
			$ext_hp = ConvertTel($data['ext_hp']);
			$ext_tel = ConvertTel($data['ext_tel']);
			$ext_tel2 = ConvertTel($data['ext_tel2']);
		

			
		
	?>	

	<tr bgcolor="#FFFFFF">
		<td align="center" height="22"><?=$n?></td>
		<!-- <td align="center"><?=$ext_hospital?></td>
		<td align="center"><?=$ext_floor?></td> -->
		<td align="center"><?=$ext_division?></td>
		<td align="center"><?=$ext_name?></td>
		<td align="center"><?=$ext_position?></td>
		<td align="center"><a href="#" onClick="windowOnClose('<?=str_replace("-", "", $ext_hp)?>');"><?=$ext_hp?></a></td>
		<td align="center"><a href="#" onClick="windowOnClose('<?=str_replace("-", "", $ext_tel)?>');"><?=$ext_tel?></a></td>
		<td align="center"><a href="#" onClick="windowOnClose('<?=str_replace("-", "", $ext_tel2)?>');"><?=$ext_tel2?></a></td>
	</tr>
	<?
		$n = $n + 1;
		}
	
?>
<!---------------------------------------- 상담내역조회 끝 ------------------------------------------>
</table>

<table width="900" border="0">
	  <tr align="left" bgcolor="#FFFFFF"> 
		<td height=20 colspan=99>		  
<!------------ 1 2 3 4 -------------------------------------------------------------------------------------------->
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="10%">&nbsp;</td> 
					<td width="80%" align="center">
<?
$pagegroup = 10;					//페이지 그룹 당 페이지 수
$pageend = $pagestart + $pagegroup;			//페이지 그룹의 마지막 페이지
$pagegroupnum = ceil(($pagenum + 1) / $pagegroup);	//현재의 페이지 그룹
$pagestart = ($pagegroupnum - 1) * $pagegroup +1;	//페이지 그룹의 첫 페이지
$pageend = $pagestart + $pagegroup - 1;			//페이지 그룹의 마지막 페이지
$prevgroup = $pagegroupnum - 1;				//이전 그룹
$prevstart = ($prevgroup - 1) * $pagegroup;		//이전 페이지 그룹의 첫 페이지

if ($pagegroupnum != 1){				//이전 페이지 그룹으로 이동
?>
						<a href="./extension.php?pagenum=<?=$prevstart?>&str_search=<?=$str_search?>"><img src="/image/left_1.gif" border="0"></a> 
<?
}

for ($i=$pagestart; $i<=$pageend; $i++)
{
	if ($i > $pagesu){		//페이지 체크
		break;
	}
	$j = $i - 1;			//넘겨줄 $pagenum값
?>
						<a href="./extension.php?pagenum=<?=$j?>&str_search=<?=$str_search?>">
						<? if ($pagenum == $j){ ?><font color="blue">_<?=$i?>_</font><? }else{ ?><?=$i?><? } ?></a> 

<?
}

$nextgroup = $pagegroupnum + 1;				//다음 그룹
$nextstart = ($nextgroup - 1) * $pagegroup;		//다음 페이지 그룹의 첫 페이지

if ($pagesu >= ($nextstart + 1)){			//다음 페이지 그룹으로 이동
?>
						<a href="./extension.php?pagenum=<?=$nextstart?>&str_search=<?=$str_search?>"><img src="/image/right_1.gif" border="0"></a> 
<?
}
?>
					</td>
					<td width="10%">&nbsp;</td> 
				</tr>
			</table>
<!------------ 1 2 3 4 -------------------------------------------------------------------------------------------->
		</td>
	</tr>
<?
}
?>
</table>

</DIV>
							</td>
						  </tr>
						</table>
					  </td>
					</tr>
					<tr>
					  <td><img src="../../image/img_main/img_99.jpg" width="802" height="12"></td>
					</tr>
				  </table>
				</td>
			  </tr>
			</table>
		  </td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
</body>
</HTML>