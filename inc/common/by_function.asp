<%
' 주민번호 13자리 받아서 "-"으로 연결
Function ConvertJumin(strValue)
	if len(strValue) = 13 then
		new_strValue = left(strValue, 6) & "-" & right(strValue, 7)
		'new_strValue = left(strValue, 6) & "-" & mid(strValue, 7, 1) & "******"
		ConvertJumin=new_strValue
	elseif len(strValue) = 10 then
		new_strValue = left(strValue, 3) & "-" & mid(strValue, 4, 2) & "-" & mid(strValue, 6, 1) & "****"
		ConvertJumin=new_strValue
	else 
		convertjumin = strValue
	end if
End Function

'전화번호 "-"으로 연결
Function ConvertTel(strvalue)
	length = len(strvalue)
	
	if length = 7 then
		new_strValue1 = left(strvalue,3) & "-" & right(strvalue,4)
		converttel = new_strValue1		
	elseif length = 8 then
		new_strValue1 = left(strvalue,4) & "-" & right(strvalue,4)
		converttel = new_strValue1		
	elseif length > 8 then
		if left(strvalue,2) = "02" then
			if length = 9 then 
				new_strValue1 = "02" & "-" & mid(strvalue,3,3) & "-" & right(strvalue,4)
				converttel = new_strValue1		
			elseif length = 10 then
				new_strValue1 = "02" & "-" & mid(strvalue,3,4) & "-" & right(strvalue,4)
				converttel = new_strValue1	
			else 
				converttel = strvalue						
			end if 
		elseif left(strvalue,2) = "01" then
			if length = 10 then
				new_strValue1 = left(strvalue,3) & "-" & mid(strvalue,4,3) & "-" & right(strvalue,4) 
				converttel = new_strValue1		
			elseif length = 11 then
				new_strValue1 = left(strvalue,3) & "-" & mid(strvalue,4,4) & "-" & right(strvalue,4) 
				converttel = new_strValue1		
			else 
				converttel = strvalue						
			end if
		elseif left(strvalue,1) = "0" then
			if length = 10 then
				new_strValue1 = left(strvalue,3) & "-" & mid(strvalue,4,3) & "-" & right(strvalue,4) 
				converttel = new_strValue1		
			elseif length = 11 then
				new_strValue1 = left(strvalue,3) & "-" & mid(strvalue,4,4) & "-" & right(strvalue,4) 
				converttel = new_strValue1		
			else 
				converttel = strvalue						
			end if
		end if
	else
		converttel = strvalue				
	end if
End Function

'날짜 변경하기
Function ConvertDay(strvalue)
	if len(strvalue) = 8 then
		new_strValue = left(strvalue,4) &  "-" & mid(strvalue,5,2) & "-" & right(strvalue,2)
		convertday = new_strValue
	elseif len(strvalue) = 14 then
		new_strValue = left(strvalue,4) &  "-" & mid(strvalue,5,2) & "-" & mid(strvalue,7,2) & " " & mid(strvalue,9,2) & ":" & mid(strvalue,11,2) & ":" & right(strvalue,2)
		convertday = new_strValue
	else 
		convertday = strvalue
	end if 
End Function

'시간 변경하기
Function ConvertTime(strvalue)
	if len(strvalue) = 6 then
		new_strvalue = left(strvalue,2) & ":" & mid(strvalue,3,2) & ":" & right(strvalue,2)
		converttime = new_strvalue
	else 
		converttime = strvalue
	end if 
End Function

' 문자열 변경 - 타이틀 있음
Function ConvertString_LengthTitle(strvalue,length)
	if len(strvalue) > length then 
		new_strvalue1 = "<a title=" & strvalue & ">" & left(strvalue,length) & "..</a>"
		convertstring_lengthtitle = new_strvalue1
	else 
		convertstring_lengthtitle = strvalue
	end if 
End Function

' 문자열 변경 - 타이틀 없음
Function ConvertString_LengthNoTitle(strvalue,length)
	if len(strvalue) > length then 
		new_strvalue1 = left(strvalue,length) & ".."
		convertstring_lengthnotitle = new_strvalue1
	else 
		convertstring_lengthnotitle = strvalue
	end if 
End Function
%>
