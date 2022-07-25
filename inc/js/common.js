function dateComp(start_dt, end_dt, diff){
  var startDate = start_dt.split("-");
  var endDate   = end_dt.split("-");
  
  var startYear = startDate[0];
  var startMonth = startDate[1];
  var startDay = startDate[2];
  
  var endYear = endDate[0];
  var endMonth = endDate[1];
  var endDay = endDate[2];
  
  var startTime = new Date(startYear,startMonth,startDay).getTime();
  var endTime = new Date(endYear,endMonth,endDay).getTime();
  
  var diffDay = diff*24*60*60*1000;
  
  var diffDays = endTime - startTime;
  if(diffDays >= 0){
    if(diffDays <= diffDay){
      return true;
    }
    else{
      alert("검색기간을 "+ diff+"일 이내로 지정하십시오");
    }
  }
  else{
    alert("검색기간을 잘못 지정하셨습니다.");
  }
  return false;
}

function dateComp(start_dt, end_dt, diff ,name_d){
  var startDate = start_dt.split("-");
  var endDate   = end_dt.split("-");
  
  var startYear = startDate[0];
  var startMonth = startDate[1];
  var startDay = startDate[2];
  
  var endYear = endDate[0];
  var endMonth = endDate[1];
  var endDay = endDate[2];
  
  var startTime = new Date(startYear,startMonth,startDay).getTime();
  var endTime = new Date(endYear,endMonth,endDay).getTime();
  
  var diffDay = diff*24*60*60*1000;
  
  var diffDays = endTime - startTime;
  if(diffDays >= 0){
    if(diffDays <= diffDay){
      return true;
    }
    else{
      alert(name_d+"을(를) "+ diff+"일 이내로 지정하십시오");
    }
  }
  else{
    alert(name_d+"을(를) 잘못 지정하셨습니다.");
  }
  return false;
}

function HopeDate(hopedate_in,name){
  
  var today_time = new Date();
  
  var hopeDate = hopedate_in.split("-");
  
  var hopeYear = hopeDate[0];
  var hopeMonth = hopeDate[1];
  var hopeDay = hopeDate[2];
  
  var hopeTime = new Date(hopeYear,hopeMonth,hopeDay).getTime();
  var new_today = new Date(today_time.getYear(), today_time.getMonth()+1, today_time.getDate()).getTime();
  var difftime = hopeTime - new_today;
  

  if(difftime < 0)
  {
    alert(name+"을 잘못 입력하셨습니다.\n오늘이후의 날짜를 지정해주세요");
    return false;
  }
  else{
    return true;
  }
  //return true;
}

function checkLength(obj,inLength){
  var len = obj.value.length;
  var han = 0;
  var res = 0;
  
  for(i=0;i<len;i++) { 
      var a=obj.value.charCodeAt(i); 
      if(a>128)
          han++;
  } 
  res = (len-han) + (han*2);

  if(res > inLength){
    //maxlength로만 제한 varchar는 한글1자지원
    alert(obj.name+"의 길이는 "+inLength+"byte까지 입니다.");
    return false;
  }
  return true;
}



function checkLength(obj,inLength,name){
  var len = obj.value.length;
  var han = 0;
  var res = 0;
  
  for(i=0;i<len;i++) { 
      var a=obj.value.charCodeAt(i); 
      if(a>128)
          han++;
  } 
  res = (len-han) + (han*2);

  if(res > inLength){
    //maxlength로만 제한 varchar는 한글1자지원
    alert(name+"의 길이는 "+inLength+"byte 까지 입니다.");
    return false;
  }
  return true;
}
function isNumerics(str)
{
  var checkStr = str.value;
  var checkOK = "0123456789";
  var isnumeric = false;

  for (i = 0;  i < checkStr.length;  i++)
  {
     ch = checkStr.charAt(i);

     isnumeric = false;
     for (j = 0;  j < checkOK.length;  j++)
     {
       if (ch == checkOK.charAt(j))
       {
           isnumeric = true;
       }
     }

     if ( isnumeric == false )
         return false;
  }

  return true;
}

function isNumAlert(str)
{
    if (!isNumerics(str)) {
        alert("숫자가 아닌 값이 입력되었습니다.");
    }
}

function checkEmail(str)
{
    var id = trim(str.value);
    var num = id;
    var checkOk = "~!#$%^&*()+|}{\":?><=\\][';/,` ";

    size = id.length;

    var at = -1;
    var dot = -1;
    var special = false;
    var lastdot = -1;
        
        if (size == 0) return true;

    for(i=0; i<size; ++i) 
    {
        var test = num.charAt(i);
        if( test == "@" ) at = i;
        else if ( test == "." ) 
        {
        if ( dot == -1 ) dot = i;
        lastdot = i;
        }
        else 
        {
        for (j=0; j < checkOk.length ; j++ )
            if ( test == checkOk.charAt(j) ) special = true;
        }
    }

    if ( special ) 
    {
        alert("E-mail에는 " + checkOk + " 등의 특수문자를 사용할 수 없습니다.");
        str.focus();    
        return false;
    }

    if ( at  == -1 || dot == -1 ) 
    {
        alert("E-mail이 형식에 맞지 않습니다. @나 .이 빠졌거나 위치가 올바르지 않습니다. 예) myid@host.co.kr");
        str.focus();    
        return false;
    }

    if ( lastdot == size - 1 ) 
    {
        alert("E-mail이 형식에 맞지 않습니다. 예) myid@host.co.kr");
        str.focus();    
        return false;
    }

    return true;
}

function replaceS(content,oldS,newS)
{
	var totS = "";
	for(i=0;i<content.length;i++)
	{
	    var subS = content.substring(i,i+oldS.length);
	    if ( subS == oldS ) { totS = totS + newS; i=i+oldS.length-1; }
	    else { totS = totS + content.substring(i,i+1); }
	}
	   totS = totS + content.substring(i);
	
	return totS;
}

function jsReplace()
{
    var RtnVal = "";
    
    if ( jsNull(arguments[0]) == false )
    {
        for (var i = 0; i < arguments[0].length; i++)
        {
            if ( arguments[0].substring(i, i+1) == arguments[1] )
                RtnVal = RtnVal + arguments[2];
            else
                RtnVal = RtnVal + arguments[0].substring(i,i+1);
        }
        return RtnVal;
    }
    else
        return arguments[0];
}

///// Null Check /////
function jsNull()
{
    if ( arguments[0] == "" || arguments[0] == null || arguments[0] == "undefined" )
        return true;
    else
        return false;
}
 
///// Numeric Check /////
function jsNumeric()
{
    if ( jsNull(arguments[0]) == false )
    {
     for (var i = 0; i < arguments[0].length; i++)
     {
      if (arguments[0].charAt(i) < "0" || arguments[0].charAt(i) > "9")
      {
          return false;
      }
     }
    }
 return true;
}
 
///// 윤달 포함 달별 일수 Return /////
function jsDaysPerMonth()
{
    var DOMonth  = new Array("31","28","31","30","31","30","31","31","30","31","30","31");
    var IDOMonth = new Array("31","29","31","30","31","30","31","31","30","31","30","31");
    if ( (arguments[0]%4) == 0 )
    {
        if ( (arguments[0]%100) == 0 && (arguments[0]%400) != 0 )
            return DOMonth[arguments[1]-1];
        return IDOMonth[arguments[1]-1];
    }
    else
        return DOMonth[arguments[1]-1];
}

///// Date Check /////
function jsDate()
{
    var vDate = arguments[0];
    var vGubun = arguments[1];          //yyyymmdd, yyyymm, yyyy
    
    var vYear = 0;
    var vMon = 0;
    var vDay = 0;
    
    if ( jsNull(vDate) )
        return false;
    
    if ( vDate.length != vGubun.length )
    {
        alert(arguments[0].title);
        arguments[0].focus();
        return false;
    }
    else
    {
        if ( jsNumeric(vDate) )
        {
            switch(vGubun)
            {
                case "yyyy"    :    return true;
                                    break;
                case "yyyymm"  :    vMon = parseInt(vDate.substr(4,2));
                                    if ( (vMon > 12) || (vMon < 0) )
                                    {
                                        alert("월을 다시 입력하세요");
                                        arguments[0].focus();
                                        return false;
                                    }
                                    break;
                case "yyyymmdd":    vYear = parseInt(vDate.substr(0,4));
                                    vMon = parseInt(vDate.substr(4,2));
                                    vDay = parseInt(vDate.substr(6,2));
                                    if ( (vMon > 12) || (vMon < 0) )
                                    {
                                        alert("월을 다시 입력하세요");
                                        arguments[0].focus();
                                        return false;
                                    }
                                    if ( (vDay > jsDaysPerMonth(vYear, vMon)) || (vDay < 0) )
                                    {
                                        alert(vMon+"월은 "+jsDaysPerMonth(vYear, vMon)+"일 까지 있습니다. \n일자를 다시 입력하세요.");
                                        arguments[0].focus();
                                        return false;
                                    }
                                    break;
                default:            break;
            }
        }
        else
        {
            alert("숫자만 입력하세요.");
            arguments[0].focus();
            return false;
        }
    }
    return true;
}

function trim(sString) 
{
    while (sString.substring(0,1) == ' ')
    {
        sString = sString.substring(1, sString.length);
    }
    while (sString.substring(sString.length-1, sString.length) == ' ')
    {
        sString = sString.substring(0,sString.length-1);
    }
    return sString;
}

function error_popup(errMsg)
{
    var theURL = '/userweb/common/popup_err.jsp?errMsg='+errMsg;
    var winName = '';
    var midHeight = screen.availHeight/2-150;
    var midWidth = screen.availWidth/2-110;
    var features = 'width=320,height=231,left='+midWidth+',top='+midHeight+',scrollbars=no,toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=no,copyhistory=no';
    var winObj = window.open(theURL,winName,features);
    return winObj;
}

var nscp = (navigator.appName == "Netscape"); 
var ismc = (navigator.appVersion.indexOf("Mac") != -1); 
var vers = parseFloat(navigator.appVersion.substring(22,25)); 

function getLayerObj(obj) 
{ 
    if (nscp) 
    { 
        compLayr = document.layers[obj]; 
    }
    else
    { 
        compLayr = eval("document.all." + obj + ".style"); 
    } 
    return compLayr; 
} 

function ShowOrHideLayer(name)
{
    obj = getLayerObj(name) ;
    if(name=="Layer0") Layer1.style.visibility = "hidden";
    if(name=="Layer1") Layer0.style.visibility = "hidden";
    if(obj.visibility == "visible")
    {
     obj.visibility = "hidden" ;
    }
    else
    { 
        obj.visibility = "visible";
    } 
} 

function HideLayer(name)
{
    obj = getLayerObj(name);
    obj.visibility = "hidden";
}


function ShowLayer(name)
{
    obj = getLayerObj(name);
    obj.visibility = "visible";
}


function checkCellPhone(ele) 
{
    var phStr = trim(ele.value);
    if (phStr.indexOf('-') != -1) phStr = phStr.replace('-', '');
    if (phStr.indexOf('-') != -1) phStr = phStr.replace('-', '');

    if (phStr == '')
    {
      return true;
    }
    else if (phStr.indexOf(" ") != -1)
    {
        alert('이동전화 번호에는 공백을 입력할수 없습니다.');
        ele.focus();
        return false;               
    }
    else if (phStr.length < 10)
    {
        alert('이동전화 번호는 최소 10자리입니다.');
        ele.focus();
        return false;       
    }   
    else if (!jsNumeric(phStr))
    {
        alert('이동전화 번호는 숫자입니다.');
        ele.focus();
        return false;
    }
    else if (phStr.substr(0,3) != "011" && 
                    phStr.substr(0,3) != "010" &&
                    phStr.substr(0,3) != "017" && 
                    phStr.substr(0,3) != "016" && 
                    phStr.substr(0,3) != "018" && 
                    phStr.substr(0,3) != "019")
    {
      alert('이동 전화번호가 아닙니다. 다시입력해 주세요.');
      ele.focus();
      return false;     
    }
    else if (phStr.charAt(3)=="0")
    {
      alert('이동 전화번호의 국번은 0 으로 시작 할 수 없습니다.');
      ele.focus();
      return false;
    }
    
    return true;
}

function checkCellPhone2(ele) 
{
    if (trim(ele.value) == '' )
    {
        alert('이동전화 국번을 입력하세요.');
        ele.focus();
        return false;
    }
    else if (!isNumerics(ele))
  {
        alert('이동전화 국번은 숫자입니다.');
        ele.focus();
        return false;
    }
  else if (ele.value.charAt(0)=="0")
  {
        alert('이동 전화번호의 국번은 0 으로 시작 할 수 없습니다.');
        ele.focus();
        return false;
    }
    
    return true;
}

function checkCellPhone3(ele) 
{
    if (ele.value == '')
    {
        alert('전화 번호를 입력하세요.');
        ele.focus();
        return false;
    }
    else if (!isNumerics(ele))
    {
        alert('전화 번호는 숫자입니다.');
        ele.focus();
        return false;
    }
    return true;
}
