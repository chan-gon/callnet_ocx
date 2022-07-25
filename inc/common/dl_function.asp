<%
' 주민번호 13자리 받아서 "-"으로 연결 후 주민번호 뒷자리 6자리를 *로 푯시
Function ConvertJumin(strValue)
	if len(strValue) = 13 then
		'new_strValue = left(strValue, 6) & "-" & right(strValue, 7)
		new_strValue = left(strValue, 6) & "-" & mid(strValue, 7, 1) & "******"
		ConvertJumin=new_strValue
	elseif len(strValue) = 10 then
		new_strValue = left(strValue, 3) & "-" & mid(strValue, 4, 2) & "-" & mid(strValue, 6, 1) & "****"
		ConvertJumin=new_strValue
	else 
		convertjumin = strValue
	end if
End Function

' 주민번호 13자리 받아서 "-"으로 연결
Function ConvertJumin2(strValue)
	if len(strValue) = 13 then
		new_strValue = left(strValue, 6) & "-" & right(strValue, 7)
		'new_strValue = left(strValue, 6) & "-" & mid(strValue, 7, 1) & "******"
		ConvertJumin2=new_strValue
	elseif len(strValue) = 10 then
		new_strValue = left(strValue, 3) & "-" & mid(strValue, 4, 2) & "-" & right(strValue, 5)
		'new_strValue = left(strValue, 3) & "-" & mid(strValue, 4, 2) & "-" & mid(strValue, 6, 1) & "****"
		ConvertJumin2=new_strValue
	else 
		ConvertJumin2 = strValue
	end if
End Function

'전화번호 "-"으로 연결
function converttel(strvalue)
	if strvalue = "000000000000" then
		converttel = "0000-0000-0000"
	elseif len(strvalue) = 12 then
		if mid(strvalue,5,1)="0" then 
			mid_new_strValue = mid(strvalue,6,3)
			mid_converttel = mid_new_strValue
		else 
			mid_converttel = mid(strvalue,5,4)
		end if

		if left(strvalue,3) = "000" then
			if left(strvalue,4) = "0000" then
				new_strValue = "02" &  "-" & mid_converttel & "-" & right(strvalue,4)
				converttel = new_strValue		
			else
				new_strValue = mid(strvalue,3,2) & "-" & mid_converttel & "-" & right(strvalue,4)
				converttel = new_strValue
			end if
		else 
			new_strValue = mid(strvalue,2,3) & "-" & mid_converttel & "-" & right(strvalue,4)			
			converttel = new_strValue
		end if
	else 
		converttel = strvalue
	end if 
End Function

function converttel1(strvalue)
	length = len(strvalue)
	
	if length = 7 then
		new_strValue1 = left(strvalue,3) & "-" & right(strvalue,4)
		converttel1 = new_strValue1		
	elseif length = 8 then
		new_strValue1 = left(strvalue,4) & "-" & right(strvalue,4)
		converttel1 = new_strValue1		
	elseif length > 8 then
		if left(strvalue,2) = "02" then
			if length = 9 then 
				new_strValue1 = "02" & "-" & mid(strvalue,3,3) & "-" & right(strvalue,4)
				converttel1 = new_strValue1		
			elseif length = 10 then
				new_strValue1 = "02" & "-" & mid(strvalue,3,4) & "-" & right(strvalue,4)
				converttel1 = new_strValue1	
			else 
				converttel1 = strvalue						
			end if 
		elseif left(strvalue,2) = "01" then
			if length = 10 then
				new_strValue1 = left(strvalue,3) & "-" & mid(strvalue,4,3) & "-" & right(strvalue,4) 
				converttel1 = new_strValue1		
			elseif length = 11 then
				new_strValue1 = left(strvalue,3) & "-" & mid(strvalue,4,4) & "-" & right(strvalue,4) 
				converttel1 = new_strValue1		
			else 
				converttel1 = strvalue						
			end if
		elseif left(strvalue,1) = "0" then
			if length = 10 then
				new_strValue1 = left(strvalue,3) & "-" & mid(strvalue,4,3) & "-" & right(strvalue,4) 
				converttel1 = new_strValue1		
			elseif length = 11 then
				new_strValue1 = left(strvalue,3) & "-" & mid(strvalue,4,4) & "-" & right(strvalue,4) 
				converttel1 = new_strValue1		
			else 
				converttel1 = strvalue						
			end If
		Else		
			converttel1 = strvalue	
		end if
	else
		converttel1 = strvalue				
	end if
End Function

function converttel2(strvalue)
	length = len(strvalue)

	if length > 4 then
		if left(strvalue, 2) = "02" then
			if length = 9 then
				new_strValue1 = "02-" & mid(strvalue, 3, 3) & "-" & right(strvalue, 4)
			else
				new_strValue1 = "02-" & mid(strvalue, 3, 4) & "-" & right(strvalue, 4)
			end if
		elseif left(strvalue, 2) = "01" then
			if length = 10 then
				new_strValue1 = left(strvalue, 3) & "-" & mid(strvalue, 4, 3) & "-" & right(strvalue, 4)
			else
				new_strValue1 = left(strvalue, 3) & "-" & mid(strvalue, 4, 4) & "-" & right(strvalue, 4)
			end if
		elseif left(strvalue, 1) = "0" then
			if length = 10 then
				new_strValue1 = left(strvalue, 3) & "-" & mid(strvalue, 4, 3) & "-" & right(strvalue, 4)
			else
				new_strValue1 = left(strvalue, 3) & "-" & mid(strvalue, 4, 4) & "-" & right(strvalue, 4)
			end if
		else
			new_strValue1 = ""	
		end if
		converttel2 = new_strValue1
	end if
End Function

'날짜 변경하기
function convertday(strvalue)
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
function converttime(strvalue)
	if len(strvalue) = 6 then
		new_strvalue = left(strvalue,2) & ":" & mid(strvalue,3,2) & ":" & right(strvalue,2)
		converttime = new_strvalue
	else 
		converttime = strvalue
	end if 
End Function

' 이름 변경
function convertname(strvalue)
	if len(strvalue) > 3 then 
		new_strvalue1 = "<a title=" & strvalue & ">" & left(strvalue,3) & "..</a>"
		convertname = new_strvalue1
	else 
		convertname = strvalue
	end if 
End Function

' 이름 변경
function convertname_length(strvalue,length)
	if len(strvalue) > length then 
		new_strvalue1 = "<a title=" & strvalue & ">" & left(strvalue,length) & "..</a>"
		convertname_length = new_strvalue1
	else 
		convertname_length = strvalue
	end if 
End Function

' 우편번호 6자리 받아서 "-"으로 연결
Function ConvertZip(strValue)
	if len(strValue) = 6 then
		new_strValue = left(strValue, 3) & "-" & right(strValue, 3)
		ConvertZip=new_strValue
	else 
		ConvertZip = strValue
	end if
End Function
%>
