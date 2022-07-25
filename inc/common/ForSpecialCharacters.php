
<?
	function CheckWordToHTML($CheckValue){
		CheckValue = replace(CheckValue, "&lt;", "<")
		CheckValue = replace(CheckValue, "&gt;", ">")
		CheckValue = replace(CheckValue, "&quot;", "'")
		CheckValue = replace(CheckValue, "&sng_quot;", "'")
		CheckValue = replace(CheckValue,"&amp;", "&" )
		CheckValue = replace(CheckValue,"&b&r&", "<br>" )
		CheckValue = replace(CheckValue, "&crlf;", "")
		CheckValue = replace(CheckValue, "&dbl_quot;", Chr(34))
		CheckValue = replace(CheckValue, "&nbsp;", Chr(32))
		CheckValue = replace(CheckValue, "&blankline;", "&nbsp;</p>")
		return $CheckValue;
	}
?>

<?
	function CheckWordToSpecial($CheckValue) { //데이타베이스로 넣을때 특정문자를 치환한다.
		CheckValue = replace(CheckValue, "<P>", "")
		CheckValue = replace(CheckValue, "</P>", "<br>")
		CheckValue = replace(CheckValue, "&" , "&amp;")
		CheckValue = replace(CheckValue, "<", "&lt;")
		CheckValue = replace(CheckValue, ">", "&gt;")
		CheckValue = replace(CheckValue, "'", "&quot;")
		return $CheckValue;
	}
?>
