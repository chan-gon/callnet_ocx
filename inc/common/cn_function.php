<?
//시간환산
function OnTimeSet($TotTime)
{
	if( $TotTime >= 3600)
	{
		$hh = ($TotTime / 3600);
		$mod_TotTime_time = $TotTime % 3600;
		$mm = ($mod_TotTime_time / 60);
		$ss = ($mod_TotTime_time % 60);
	}
	else if( $TotTime >= 60 )
	{
		$mm = ($TotTime / 60);
		$ss = ($TotTime % 60);
	}
	else
	{
		$ss = $TotTime;
	}
	$str_TotTime = sprintf("%d:%02d:%02d", $hh,$mm,$ss);
	return $str_TotTime;
}

//날짜변경
function ConvertDay($strValue)
{
	if (strlen($strValue) == 8){
		$ConvertDay = substr($strValue,0,4)."-".substr($strValue,4,2)."-".substr($strValue,6,2);
		return $ConvertDay;
	}else if (strlen($strValue) == 14){
		$ConvertDay = substr($strValue,0,4) ."-". substr($strValue,4,2) ."-". substr($strValue,6,2) ." ". substr($strValue,8,2). ":" .substr($strValue,10,2). ":".substr($strValue,12,2);
		return $ConvertDay;
	}else {
		return $strValue;
	}
}

//시간변경
function ConvertTime($strValue)
{
	if (strlen($strValue) == 6){
		$ConvertDay = substr($strValue,0,2).":".substr($strValue,2,2).":".substr($strValue,4,2);
		return $ConvertDay;
	}else if (strlen($strValue) == 4){
		$ConvertDay = substr($strValue,0,2).":".substr($strValue,2,2);
		return $ConvertDay;
	}else {
		return $strValue;
	}
}

//' 주민번호 or 사업자번호 "-"으로 연결
function ConvertJumin($strValue)
{
	if (strlen($strValue) == 13) {
		$ConvertJumin = substr($strValue,0,6)."-".substr($strValue,6,7);
		return $ConvertJumin;
	} else if (strlen($strValue) == 10) {
		$ConvertJumin = substr($strValue,0,3)."-".substr($strValue,3,2)."-".substr($strValue,5,5);
		return $ConvertJumin;
	} else {
		return $strValue;
	}
}

//' 주민번호 or 사업자번호 "-"으로 연결 후 주민번호 뒷자리 6자리를 *로 표시
function ConvertJumin2($strValue)
{
	if (strlen($strValue) == 13) {
		$ConvertJumin = substr($strValue,0,6)."-*******";
		return $ConvertJumin;
	} else if (strlen($strValue) == 10) {
		$ConvertJumin = substr($strValue,0,3)."-".substr($strValue,3,2)."-".substr($strValue,5,5);
		return $ConvertJumin;
	} else {
		return $strValue;
	}
}

//' 전화번호 "-"으로 연결 표시
function ConvertTel($strValue)
{
	$length = strlen($strValue);
	
	if ($length == 7) {
		$ConvertTel = substr($strValue,0,3)."-".substr($strValue,3,4);
		return $ConvertTel;
	}else if ($length == 8) {
		$ConvertTel = substr($strValue,0,4)."-".substr($strValue,4,4);
		return $ConvertTel;
	}else if ($length > 8 && $length < 14) {
		if (substr($strValue,0,2) == "02") {
			if ($length == 9) { 
				$ConvertTel = substr($strValue,0,2)."-".substr($strValue,2,3)."-".substr($strValue,5,4);
				return $ConvertTel;
			} else if ($length == 10) {
				$ConvertTel = substr($strValue,0,2)."-".substr($strValue,2,4)."-".substr($strValue,6,4);
				return $ConvertTel;
			} else {
				return $strValue;						
			}
		}else if (substr($strValue,0,2) == "01") {
			if ($length == 10) {
				$ConvertTel = substr($strValue,0,3)."-".substr($strValue,3,3)."-".substr($strValue,6,4);
				return $ConvertTel;
			}else if ($length == 11) {
				$ConvertTel = substr($strValue,0,3)."-".substr($strValue,3,4)."-".substr($strValue,7,4);
				return $ConvertTel;
			} else {
				return $strValue;					
			}
		}else if (substr($strValue,0,1) == "0") {
			if ($length == 10) {
				$ConvertTel = substr($strValue,0,3)."-".substr($strValue,3,3)."-".substr($strValue,6,4);
				return $ConvertTel;
			} else if ($length == 11) {
				$ConvertTel = substr($strValue,0,3)."-".substr($strValue,3,4)."-".substr($strValue,7,4);
				return $ConvertTel;
			} else {
				return $strValue;					
			}
		} else {
			return $strValue;
		}
	} else {
		return $strValue;
	}
}

// 우편번호 6자리 받아서 "-"으로 연결
function ConvertZip($strValue)
{
	if (strlen($strValue) == 6){
		$ConvertZip = substr($strValue,0,3)."-".substr($strValue,3,3);
		return $ConvertZip;
	} else {
		return $strValue;
	}
}

// dnis 받아서 전환
function ConvertIncall($strValue)
{
	switch ($strValue) {
		case '07040221800'  : return "1644-2115"; break;
		case '07040221801'  : return "1644-2116"; break;
		case '07040221802'  : return "1644-2117"; break;
		case '07040221803'  : return "1644-2446"; break;
		case '07040221804'  : return "1544-9851"; break;
	}
}

// 검색 조건에서 대표번호 뒷자리 받아서 dnis로 역전환
function ReConvertIncall($strValue)
{
	switch ($strValue) {
		case '2115'  : return "07040221800"; break;
		case '2116'  : return "07040221801"; break;
		case '2117'  : return "07040221802"; break;
		case '2446'  : return "07040221803"; break;
		case '9851'  : return "07040221804"; break;
	}
}

?>