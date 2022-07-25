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

$AgtID	 	= $_SESSION['AgtID'];
$AgtPW	 	= $_SESSION['AgtPW'];
$AgtName	= $_SESSION['AgtName'];
$AgtAuth	= $_SESSION['AgtAuth'];


$page = 40;
$start = $page * $pagenum;

// 페이징 관련 변수 생성 시작
$str_search = "";
if ($ext_name) { $str_search .= "&ext_name=$ext_name"; }
if ($ext_hp) { $str_search .= "&ext_hp=$ext_hp"; }
if ($ext_tel) { $str_search .= "&ext_tel=$ext_tel"; }

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
//신규등록
function fnc_AgtNew(){	
	location.href = "./extension_view.php?mode=N";
}

//상담원 삭제
function fnc_agentdel(arg) {
	ans = confirm("삭제하시겠습니까?");
	if (ans == false) {
		return;
	}
	location.href = "./extension_ok.php?idx="+arg+"&mode=D";
}


//-->
</SCRIPT>
</head>
<BODY leftMargin="0" topMargin="0" marginheight="0" marginwidth="0">

<!-- Calendar -->
<script language="javascript" src="../../inc/js/Calendar.js"></script>
<!-- Calendar-->

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
<form name="ext_search" method="post" action="extension_list.php">
			  <br>
			<img src="../../image/img_main/img_30.gif">
			<table width="780" border="0" cellpadding="2" cellspacing="1" bgcolor="A3C6D7" align="center">
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
			</table>			
		</td>
	</tr>
	<tr>
		<td>
			<table width="780" border="0" cellpadding="0" cellspacing="0" bgcolor="A3C6D7">
				<tr bgcolor="#FFFFFF">
					<td height="30" width="50%" align="left" bgcolor="ffffff">&nbsp;<input type="button" name="btn_AgtNew" value="신규등록" class="btnType4" style="height:22px;width=70px;" onClick="fnc_AgtNew();"></td>					
					<td width="50%" align="right" bgcolor="ffffff"><input type="submit" name="btn_TelHist" value="조회" class="btnType4" style="height:22px;width=70px;"></td>
				</tr>
</form>
			</table>
		</td>
	</tr>
	<tr> 
		<td height="15" colspan="99" bgcolor="ffffff"></td>
	</tr>
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

?>
	<tr> 
	  <td height="30">
		<table border="0" width="780">
		  <tr>
			<td height="20"><img src="../../image/img_main/img_32.gif"></td>
			<td align="right">총 검색결과 <font color="red"><?=$tot_cnt?></font> 건&nbsp; &nbsp;</td>
		  </tr>
		</table>
		<table border="0" width="780">
		  <tr>
		    <td>
			  <table width="780" border="0" cellpadding="2" cellspacing="1" bgcolor="A3C6D7">
				 <tr class="hLock">
				<td width="3%" height="30" align="center" bgcolor="#EEF5F8">NO</td>
				<td width="10%" align="center" bgcolor="#EEF5F8">부서</td>
				<td width="10%" align="center" bgcolor="#EEF5F8">성명</td>
				<td width="10%" align="center" bgcolor="#EEF5F8">직책</td>
				<td width="10%" align="center" bgcolor="#EEF5F8">핸드폰</td>
				<td width="10%" align="center" bgcolor="#EEF5F8">전화번호</td>
				<td width="10%" align="center" bgcolor="#EEF5F8">전화번호2</td>
				<td width="10%" align="center" bgcolor="#EEF5F8">삭제</td>
	</tr>
<?
	if ($tot_cnt <= 0) {
?>
				  <tr align="center" bgcolor="#FFFFFF"> 
					<td height="25" colspan="99">&nbsp;상담내역이 없습니다.</td>
				  </tr>
<?
	} else {

		$n=1;
		while( $data = db_fetch_array($result) )
		{	
			$idx = $data['idx'];
			$ext_division = $data['ext_division'];
			$ext_name = $data['ext_name'];
			$ext_position = $data['ext_position'];
			$ext_hp = ConvertTel($data['ext_hp']);
			$ext_tel = ConvertTel($data['ext_tel']);
			$ext_tel2 = ConvertTel($data['ext_tel2']);
		
						
			
?>
			  <tr bgcolor="#FFFFFF" onMouseOver="this.style.backgroundColor='#E7E7E7'" onMouseOut="this.style.backgroundColor='#FFFFFF'"> 
				<td height="24" align="center"><?=$n?></td>
				<td align="center"><a href="extension_view.php?idx=<?=$idx?>&mode=M"><?=$ext_division?></a></td>
				<td align="center"><a href="extension_view.php?idx=<?=$idx?>&mode=M"><?=$ext_name?></a></td>
				<td align="center"><a href="extension_view.php?idx=<?=$idx?>&mode=M"><?=$ext_position?></a></td>
				<td align="center"><a href="extension_view.php?idx=<?=$idx?>&mode=M"><?=ConvertTel($ext_hp)?></a></td>
				<td align="center"><a href="extension_view.php?idx=<?=$idx?>&mode=M"><?=ConvertTel($ext_tel)?></a></td>
				<td align="center"><a href="extension_view.php?idx=<?=$idx?>&mode=M"><?=ConvertTel($ext_tel2)?></a></td>
				<td align="center"><input type="button" name="btn_post_search" value="삭제" class="btnType4" style="height:18px;width=34px;" onclick="fnc_agentdel('<?=$idx?>')"></td>	
			  </tr>
	<?
		$n = $n + 1;
		}
?>
			  <tr align="center" bgcolor="#FFFFFF"> 
			    <td height=20 colspan=99>

	<!-- 페이징 시작 -->
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
						<a href="./extension_list.php?pagenum=<?=$prevstart?>&str_search=<?=$str_search?>"><img src="/image/left_1.gif" border="0"></a> 
<?
}

for ($i=$pagestart; $i<=$pageend; $i++)
{
	if ($i > $pagesu){		//페이지 체크
		break;
	}
	$j = $i - 1;			//넘겨줄 $pagenum값
?>
						<a href="./extension_list.php?pagenum=<?=$j?>&str_search=<?=$str_search?>">
						<? if ($pagenum == $j){ ?><font color="blue">_<?=$i?>_</font><? }else{ ?><?=$i?><? } ?></a> 

<?
}

$nextgroup = $pagegroupnum + 1;				//다음 그룹
$nextstart = ($nextgroup - 1) * $pagegroup;		//다음 페이지 그룹의 첫 페이지

if ($pagesu >= ($nextstart + 1)){			//다음 페이지 그룹으로 이동
?>
						<a href="./extension_list.php?pagenum=<?=$nextstart?>&str_search=<?=$str_search?>"><img src="/image/right_1.gif" border="0"></a> 
<?
}
?>
					</td>
					<td width="10%">&nbsp;</td> 
				</tr>
			</table>
	<!-- 페이징 끝 -->

				</td>
			  </tr>
<?
	}
?>
			</table>
					  </td>
				  </tr>
			</table>		
		</td>
	</tr>
	<tr> 
		<td height="1" colspan="99" bgcolor="ffffff"></td>
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
<p>&nbsp;</p>
</BODY>
</HTML>