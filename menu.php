<?php session_start();
//error_reporting( E_ALL );
//ini_set( "display_errors", 1 );
?>
<?// include "inc/db/db.php"; $ipcc_db = db_connect(); ?>
<?php include "inc/common/common.php"; ?>
<?php include "inc/common/cn_function.php"; ?>
<?php
//현재날짜를 계산한다(YYYY-MM-DD HH:MM:SS)
$datetemp = date("Y-m-d");
$datetemp1 = date("Ymd");
$writedate = date("His");
$writedatetime = $datetemp1;

$AgID = $_SESSION['AgtID'];
//$WebID	 	= $_SESSION['WebID'];
$AgtName = $_SESSION['AgtName'];
$AgtAuth = $_SESSION['AgtAuth'];

//$AgtCTI		= $_SESSION['AgtCTI'];
$AgLineNo = $_SESSION['AgtIntel']; //내선번호
//$AgtIP		= $_SESSION['AgtIP'];
//$PhonePW	= $_SESSION['PhonePW'];
//$dial_code	= $_SESSION['agt_part'];

if (isset($_REQUEST['btn_login_txt']) && !empty($_REQUEST['btn_login_txt'])) {
    $btn_login_txt = $_REQUEST['btn_login_txt'];
} else {
    $btn_login_txt = "로그인";
}

if (isset($_REQUEST['btn_daegi_txt']) && !empty($_REQUEST['btn_daegi_txt'])) {
    $btn_daegi_txt = $_REQUEST['btn_daegi_txt'];
} else {
    $btn_daegi_txt = "상담대기";
}

if(isset($_REQUEST['btn_break_txt']) && !empty($_REQUEST['btn_break_txt'])){
    $btn_break_txt = $_REQUEST['btn_break_txt'];
}else {
    $btn_break_txt = "휴식중";
}

?>
<html>
<head>
    <title>::: Call Center System ::: - CTI Module</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        <!--
        A:link {
            text-decoration: none;
            color: #000000;
        }

        A:visited {
            text-decoration: none;
            color: #000000;
        }

        A:active {
            text-decoration: none;
        }

        A:hover {
            font-size: 10pt;
            text-decoration: none;
            color: #0033CC;
        }

        table {
            font-family: "맑은 고딕";
            font-size: 11px;
            color: #5a5a5a;
        }

        td {
            font-family: "맑은 고딕";
            font-size: 12px;
            color: #5a5a5a;
        }

        input {
            background-color:;
            font-size: 9pt;
            font-family: "맑은 고딕";
        }

        select {
            font-family: "맑은 고딕";
            font-size: 12px;
            color: #5a5a5a;
            background-color: #fafafa;
            border: 1px #CFCFCF solid
        }

        .small_blue {
            font-family: "고딕";
            font-size: 12px;
            color: #3071B1;
            font-weight: bold;
            line-height: normal;
        }

        /
        /
        -->

        #telno {
            font-size: 9pt
        }

        ;
    </style>
    <script type="text/JavaScript">


        function open_extension() {

            var settings = 'toolbar=0,directories=0,status=no,menubar=0,scrollbars=auto,resizable=no,height=700,width=800,left=400,top=100';
            winObject = window.open("extension/extension.php", "", settings);

        }

        // 상담원 통화 시간 표시 함수 시작
        var clockstart = null;
        var timeID = null;

        function clockDisplay() {
            if (clockstart == null) return;

            var now = (new Date()).getTime();
            var diff = new Date(0, 0, 0, 0, 0, 0, now - clockstart);

            var hours = diff.getHours();
            var minutes = diff.getMinutes();
            var seconds = diff.getSeconds();

            if (hours < 10) {
                hours = "0" + hours;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            if (seconds < 10) {
                seconds = "0" + seconds;
            }

            parent.menuFrame.document.all["divclock"].innerHTML = "통화시간 : " + hours + ":" + minutes + ":" + seconds;

            // 메인 프레임의 상담내역 부분에 통화시간 입력
            document.fm.SdCallTime.value = hours + ":" + minutes + ":" + seconds;

            setTimeout("clockDisplay()", 1000);
        }

        // 통화시간 표시용 시계 시작
        function clockStart() {
            clockstart = (new Date()).getTime();
            setTimeout("clockDisplay()", 1000);

            var now = new Date();//(new Date()).getTime();

            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            var nowTime = hours + ":" + minutes + ":" + seconds;

            //parent.mainFrame.SangdamForm.call_start_time.value=nowTime;
        }

        // 통화시간 표시용 시계 중지
        function clockStop() {
            clockstart = null;
            //parent.mainFrame.SangdamForm.end_time.innerText="TEST";
            //parent.mainFrame.SangdamForm.SdCallTime.value = document.fm.SdCallTime.value;
            var now = new Date();//(new Date()).getTime();

            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            var nowTime = hours + ":" + minutes + ":" + seconds;

            //parent.mainFrame.SangdamForm.call_end_time.value=nowTime;
        }

        // 상담원 통화 시간 표시 함수 끝
        //-->
    </script>
</head>

<body onload="login();">

<form name="fm">
    <input type="hidden" name="popchk" value="">
    <input type="hidden" name="iogubun" value="">
    <input type="hidden" name="SdCallTime" value="">
    <input type="hidden" name="callback_idx" value="">
    <input type="hidden" id="AgID" name="AgID" value="<?= $AgID ?>">
    <input type="hidden" name="AgtName" value="<?= $AgtName ?>">
    <input type="hidden" name="AgLineNo" value="<?= $AgLineNo ?>">
    <input type="hidden" name="btn_login_txt" value=<?= $btn_login_txt ?>

<table>
    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td height="1"></td>
                            </tr>
                        </table>
                        <table>
                <tr>
                    <td><img src="image/img_side/img_05.jpg" width="440" height="12"></td>
                </tr>
                <tr>
                    <td background="image/img_side/img_87.jpg">
                        <table>
                            <tr>


                                    <td>
                                        <b>
                                            <div id="divclock" style='font-size:12pt'>통화시간 : 00:00:00</div>
                                        </b>
                                    </td>
                                    <td>
                                        <b style='font-size:12pt'>전화번호</b>
                                        <input style='font-size:12pt' type="text" id="telno" name="telno" value="" size="18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </td>
                            </tr>
                            <!--  cti module 시작  -->
                            <OBJECT style="Z-INDEX: 100; LEFT: 0px; VISIBILITY: visible; POSITION: absolute; TOP: 0px"
                                    codeBase=http://www.callnetkorea.co.kr/webphonetest/callnet.cab#version=1,0,1,0
                                    height=0 width=0 classid=clsid:130E35D9-EC3A-43E2-871E-E3AE7837D34D name="unpbx" id="unpbx" VIEWASTEXT></OBJECT>

                            <OBJECT height=0 width=0 classid=clsid:17C6A0B3-9B9D-46FC-9201-5C90702FC915
                                    name=CnRec></OBJECT>
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td height="30">&nbsp;<a href="#" onclick="makecall();"><img src="img/bua_06.gif" id="btn_makecall"></a>
                                                            &nbsp;<a href="#" onclick="javascript:answer();"><img src="img/bua_20.gif" id="btn_answer"></a>&nbsp;
                                                            <a href="#" onclick="javascript:disconnect();"><img src="img/bua_21.gif" id="btn_disconnect"></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="30">&nbsp;<a href="#" onclick="javascript:consult();"><img src="img/bua_07.gif" id="btn_consult"></a>&nbsp;<a
                                                                    href="#" onclick="javascript:reconnect();"><img src="img/bua_10.gif" id="btn_reconnect"></a>&nbsp;<a
                                                                    href="#" onclick="javascript:;transfer()"><img src="img/bua_11.gif" id="btn_transfer"></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="30">&nbsp;<input type="hidden" name="btn_break_txt" value="<?= btn_break_txt ?>">
                                                            <a href="#" onclick="javascript:breakon(1);"><img src="img/bua_04.gif" id="btn_breakon"></a>&nbsp;<a href="#" onclick="javascript:daegi(0);"><img src="img/bua_08.gif" id="btn_endready"></a>&nbsp;<a
                                                                    href="#" onclick="javascript:login();"><img
                                                                        src="img/buc_01.gif" id="btn_login"></a></td>
                                                    </tr>
                                                    <tr>

                                                        <td height="30">&nbsp;
                                                            <a href="#" onclick="open_extension();"><img
                                                                        src="img/intra.jpg" id=""></a>
                                                        </td>

                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            &nbsp;&nbsp;&nbsp;<textarea name="status" cols="21"
                                                                                        rows="6"></textarea></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <tdcolspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><img src="image/img_side/img_99.jpg" width="440"
                                                                 height="12"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <!--  cti module 끝  -->
                            <tr>
                                <td height="2"></td>

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
</form>
</body>
</html>

<!-- -------------------------  MUC module FUNCTION  ------------------------------- -->

<script type="text/javascript">
    function getInternetExplorerVersion() {
        var rv = -1;
        if (navigator.appName === 'Microsoft Internet Explorer') {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        }
        return rv;
    }

    function checkVersion() {
        var ver = getInternetExplorerVersion();
        if (ver > -1)
            msg = "Internet Explorer " + ver;
        else
            msg = "You are not using Internet Explorer";
        //alert(msg);

        return msg;
    }
</script>


<script>

    // MOIMSTONE, FiX {
    var ON = 1;
    var OFF = 0;

    // HOLD MODE TABLE
    var HOLD = 1;
    var UNHOLD = 0;

    // MUTE TABLE
    var MUTE = 1;
    var UNMUTE = 0;

    // AUDIO PATH TABLE
    var AUDIO_PATH_HANDSET = 0;
    var AUDIO_PATH_HEADSET = 1;
    var AUDIO_PATH_SPEAKER = 2;

    // RECORDING MODE TABLE
    var RECORDING_START = 0;
    var RECORDING_STOP = 1;
    var RECORDING_PAUSE = 2;
    var RECORDING_RESUME = 3;

    // SNDPLAY {
    var SNDPLAY_START = 0;
    var SNDPLAY_STOP = 1;
    var SNDPLAY_PAUSE = 2;
    var SNDPLAY_RESUME = 3;
    // SNDPLAY }

    var TAB_INDEX_DTMF = 0;
    var TAB_INDEX_1 = 1;
    var TAB_INDEX_2 = 2;
    var TAB_INDEX_3 = 3;
    var TAB_INDEX_4 = 4;
    var TAB_INDEX_5 = 5;
    var TAB_INDEX_6 = 6;
    var TAB_MAX = 7;

    var recording_time_count = 0;
    var stop_watch;
    var muc_version = "";
</script>


<script>
    //로그인
    function login() {
        if (document.fm.btn_login_txt.value == "로그인") {
            var login_check;


            login_check = fm.unpbx.Login(fm.AgID.value, fm.AgLineNo.value);
            alert("로그인 성공");
            //var cnf = ConnectDevice();
        } else {
            alert("로그인 실패");
            //fm.unpbx.Logout();
        }
    }

    //콜백
    function callback() {
        var str = document.getElementById("btn_callback").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_19.gif") {
            return;
        }
        fm.unpbx.Callback();
    }

    //모니터링
    function allagent() {
        var str = document.getElementById("btn_getagents").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_03.gif") {
            return;
        }
        fm.unpbx.GetAllAgents(9, '', '');
    }

    //전화걸기
    function makecall() {
        var dialcode = '9';
        var str = document.getElementById("btn_makecall").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_06.gif") {
            return;
        }
        document.fm.iogubun.value = "0";
        var str_telno = document.fm.telno.value;
        var i;
        i = str_telno.length;
        while (i > 0) {
            str_telno = str_telno.replace("-", "");
            i--;
        }
        i = str_telno.length;
        while (i > 0) {
            str_telno = str_telno.replace(" ", "");
            i--;
        }
        document.fm.telno.value = str_telno;
        if (str_telno.length == 0) {
            alert("번호를 입력해 주십시오");
            return false;
        } else if (str_telno.length == 4 && String(str_telno).substring(0, 1) == '2') {
            //var intelfront ='0707919';
            //str_telno = dialcode  +intelfront+ str_telno;

            fm.unpbx.makecall(str_telno);
        } else if (str_telno.length < 5) {
            fm.unpbx.makecall(str_telno);
            //document.outbound.location = "outcall.php?cid=" + document.fm.telno.value;
        } else {
            //str_telno = "9" + str_telno;
            str_telno = dialcode + str_telno;

            fm.unpbx.makecall(str_telno);

            //document.outbound.location = "outcall.php?cid=" + document.fm.telno.value;
        }

    }

    //전화받기
    function answer() {
        var str = document.getElementById("btn_answer").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_20.gif") {
            return;
        }

        fm.unpbx.answer();

        clockStart();
        document.fm.status.value = "전화 받음\n" + document.fm.status.value;
        document.getElementById("btn_answer").src = "img/bua_20.gif";
        document.getElementById("btn_disconnect").src = "img/bub_21.gif";
    }

    //전화 끊기
    function disconnect() {
        var str = document.getElementById("btn_disconnect").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_21.gif") {
            return;
        }

        fm.unpbx.disconnect();
        clockStop();


        document.fm.status.value = "전화 끊음\n" + document.fm.status.value;

        document.getElementById("btn_disconnect").src = "img/bua_21.gif";
        document.getElementById("btn_consult").src = "img/bua_07.gif";

    }

    //휴식 : status=1
    function breakon(flag) {
        var str = document.getElementById("btn_breakon").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_04.gif") {
            return;
        }
        fm.unpbx.SetStatus(flag);
        //document.fm.btn_break_txt.value = "휴식중";
        //document.fm.status.value = "휴식중\n" + document.fm.status.value;
        document.getElementById("btn_breakon").src = "img/bua_04.gif";
        document.getElementById("btn_endready").src = "img/bub_08.gif";
    }

    // 교육 : status=3
    function education(flag) {
        var str = document.getElementById("btn_eduon").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_40.gif") {
            return;
        }
        fm.unpbx.SetStatus(flag);
        document.fm.btn_edu_txt.value = "회의중";
        document.fm.status.value = "회의중\n" + document.fm.status.value;
        document.getElementById("btn_eduon").src = "img/bua_40.gif";
    }

    // 대기 : status=0
    function daegi(flag) {
        var str = document.getElementById("btn_endready").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_08.gif") {
            alert("대기 상태로 변경할 수 없습니다.   ");
            return;
        }
        fm.unpbx.SetStatus(flag);
        document.fm.telno.value = "";
        //document.fm.status.value = "상담대기\n" + document.fm.status.value;
        document.getElementById("btn_endready").src = "img/bua_08.gif";
        document.getElementById("btn_makecall").src = "img/bub_06.gif";
        document.getElementById("btn_breakon").src = "img/bub_04.gif";
        document.getElementById("btn_disconnect").src = "img/bua_21.gif";
        clockStop();
    }


    //후처리완료
    function endready() {
        var str = document.getElementById("btn_endready").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_08.gif") {
            alert("대기중으로 변경할 수 없습니다.   ");
            //alert("후처리상태가 아닙니다.   ");
            return;
        }
        fm.unpbx.endready();

        document.getElementById("btn_endready").src = "img/bua_08.gif";
        document.getElementById("btn_makecall").src = "img/bub_06.gif";
        clockStop();

        var tmp = document.fm.btn_break_txt.value;
        if (tmp == "휴식중") {
            document.getElementById("btn_breakon").src = "img/bua_04.gif";
            //document.getElementById("btn_breakoff").src		="../../img/bub_05.gif";
            document.fm.status.value = "후처리완료\n" + document.fm.status.value;
            document.fm.status.value = "휴식중" + document.fm.status.value;
        } else {	// if(tmp == "휴식취소"){
            document.getElementById("btn_breakon").src = "img/bub_04.gif";
            //document.getElementById("btn_breakoff").src		="../../img/bua_05.gif";
            document.fm.status.value = "후처리완료\n" + document.fm.status.value;
            document.fm.status.value = "상담대기\n" + document.fm.status.value;
        }
    }

    //호전환 시도
    function consult() {
        //var dialcode = '<?//=$dial_code?>//';
        var dialcode = '9';
        var str = document.getElementById("btn_consult").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_07.gif") {
            return;
        }
        document.fm.status.value = "호전환시도\n" + document.fm.status.value;
        var str_telno = document.fm.telno.value;
        str_telno = str_telno.replace('-', '');
        str_telno = str_telno.replace('-', '');


        if (str_telno.length == 4 && String(str_telno).substring(0, 1) == '2') {
            var intelfront = '0707919';
            str_telno = dialcode + intelfront + str_telno;
        }

        if (str_telno.length == 0) {
            alert("번호를 입력해 주십시오");
            return false;
        } else if (str_telno.length > 12) {
            alert("12자리 이상은 입력이 불가능 합니다");
            return false;
        }
            //if(str_telno.length > 4)
            //{
            //str_telno = str_telno;
        //}

        else {

            fm.unpbx.consult(str_telno, 1, '');//1 : blind transfer
            document.getElementById("btn_consult").src = "img/bua_07.gif";
            document.getElementById("btn_reconnect").src = "img/bub_10.gif";
            document.getElementById("btn_transfer").src = "img/bub_11.gif";
        }

        //fm.unpbx.consult(str_telno, '');
        //fm.unpbx.consult(str_telno, 2,'');//1 : blind transfer
        //document.getElementById("btn_consult").src		="../../img/bua_07.gif";
        //document.getElementById("btn_reconnect").src	="../../img/bub_10.gif";
        //document.getElementById("btn_transfer").src		="../../img/bub_11.gif";
        //document.getElementById("btn_conference").src	="../../img/bub_32.gif";


    }

    //호전환 취소
    function reconnect() {
        var str = document.getElementById("btn_reconnect").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_10.gif") {
            return;
        }
        document.fm.status.value = "호전환취소\n" + document.fm.status.value;
        fm.unpbx.reconnect();
        document.getElementById("btn_makecall").src = "img/bua_06.gif";
        document.getElementById("btn_consult").src = "img/bub_07.gif";
        document.getElementById("btn_reconnect").src = "img/bua_10.gif";
        document.getElementById("btn_transfer").src = "img/bua_11.gif";
    }

    //호전환 완료
    function transfer() {
        var str = document.getElementById("btn_transfer").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_11.gif") {
            return;
        }
        fm.unpbx.Transfer();
        //document.getElementById("btn_makecall").src		="../../img/bub_06.gif";
        document.getElementById("btn_consult").src = "img/bua_07.gif";
        document.getElementById("btn_reconnect").src = "img/bua_10.gif";
        document.getElementById("btn_transfer").src = "img/bua_11.gif";
        document.getElementById("btn_disconnect").src = "img/bua_21.gif";
    }

    //3자통화
    function conference() {
        var str = document.getElementById("btn_conference").src;
        var tmp = String(str).substring(String(str).length, String(str).length - 10);

        if (tmp == "bua_32.gif") {
            return;
        }
        document.fm.status.value = "3자통화시도\n" + document.fm.status.value;
        fm.unpbx.Conference();
    }

    //대기자 현황 (국선상태)
    function GetCoState() {
        fm.unpbx.GetCoState(0);
    }

    // 그냥 n millis 동안 멈추기
    function pause(numberMillis) {
        var now = new Date();
        var exitTime = now.getTime() + numberMillis;

        while (true) {
            now = new Date();
            if (now.getTime() > exitTime)
                return;
        }
    }


    function sleep(ms) {
        ts1 = new Date().getTime() + ms;
        do ts2 = new Date().getTime(); while (ts2 < ts1);
    }

    //-->
</script>


<SCRIPT language=javascript event=IncomingCall for=unpbx>


    document.fm.status.value = "전화가 왔습니다\n" + document.fm.status.value;
    document.getElementById("btn_answer").src = "img/bub_20.gif";
    var cid = fm.unpbx.cid;
    var dnis = fm.unpbx.juminno;
    var space = fm.unpbx.space;


    if (cid.substring(0, 2) == "02") {
        if (cid.length == 10) {
            cid = cid.substring(0, 2) + "-" + cid.substring(2, 4) + "-" + cid.substring(6, 4)

        } else if (cid.length == 9) {
            cid = cid.substring(0, 2) + "-" + cid.substring(2, 3) + "-" + cid.substring(5, 4)
        }
    } else {
        if (cid.length == 10) {
            cid = cid.substring(0, 3) + "-" + cid.substring(3, 3) + "-" + cid.substring(6, 4)

        } else if (cid.length == 11) {
            cid = cid.substring(0, 3) + "-" + cid.substring(3, 4) + "-" + cid.substring(7, 4)
        }
    }


    document.fm.popchk.value = "0";
    document.fm.iogubun.value = "1";
    document.fm.telno.value = cid;


    var date = new Date();
    var y = date.getFullYear();
    var m = date.getMonth() + 1;
    var d = date.getDate();
    var currentDate = y + "-" + m + "-" + d;


    pause(700);


    res = window.showModalDialog("incall.php?cid=" + cid + "&space=" + space + "&dnis=" + dnis, window, "dialogWidth:570px; dialogHeight:300px; resizable:yes; center:yes; help:no; scroll:yes; status:no;");


    clockStart();

    var tmp_res = res.split(",");
    var Cust_cd = tmp_res[0];
    var Call_No = tmp_res[1];


    //parent.mainFrame.location.href = "../main/main.php?action=new&cust_idx="+Cust_cd+"&call_no="+Call_No+"&cid="+cid+"&space="+space;


</SCRIPT>

<SCRIPT language=javascript event=LoginOK for=unpbx>

    //document.fm.unpbx.EtcWork(3);
    document.fm.status.value = "로그인 되었습니다.\n";
    document.fm.btn_login_txt.value = "로그아웃";
    document.getElementById("btn_login").src = "img/bub_01.gif";
    // document.getElementById("btn_getagents").src	="../../img/bub_03.gif";
    document.getElementById("btn_makecall").src = "img/bub_06.gif";
    document.getElementById("btn_consult").src = "img/bua_07.gif";
    document.getElementById("btn_reconnect").src = "img/bua_10.gif";
    document.getElementById("btn_transfer").src = "img/bua_11.gif";
    document.getElementById("btn_endready").src = "img/bua_08.gif";
    document.getElementById("btn_breakon").src = "img/bub_04.gif";

    //document.getElementById("btn_breakoff").src		="../../img/bua_05.gif";
    //document.getElementById("btn_conference").src	="../../img/bua_32.gif";
    //document.getElementById("btn_eduon").src		="../../img/bub_40.gif";
    //document.getElementById("btn_eduoff").src		="../../img/bua_41.gif";

</SCRIPT>

<SCRIPT language=javascript event=LogoutOK for=unpbx>
    //document.fm.status.value = "로그아웃되었습니다.\n" + document.fm.status.value;
    document.fm.btn_login_txt.value = "로그인";
    document.getElementById("btn_login").src = "img/buc_01.gif";
    // document.getElementById("btn_getagents").src="../../img/bua_03.gif";
    document.getElementById("btn_makecall").src = "img/bua_06.gif";
    document.getElementById("btn_consult").src = "img/bua_07.gif";
    document.getElementById("btn_reconnect").src = "img/bua_10.gif";
    document.getElementById("btn_transfer").src = "img/bua_11.gif";
    document.getElementById("btn_endready").src = "img/bua_08.gif";
    document.getElementById("btn_breakon").src = "img/bua_04.gif";
    //document.getElementById("btn_breakoff").src	="../../img/bua_05.gif";
    //document.getElementById("btn_eduon").src	="../../img/bua_40.gif";
    //document.getElementById("btn_eduoff").src	="../../img/bua_41.gif";
    parent.location.href("index.php");
    //-->
</SCRIPT>


<SCRIPT language=javascript event=OffHook for=unpbx>
    document.fm.status.value = "수화기를 들었습니다.\n" + document.fm.status.value;

    document.getElementById("btn_makecall").src = "img/bub_06.gif";
    document.getElementById("btn_disconnect").src = "img/bub_21.gif";
    document.getElementById("btn_breakon").src = "img/bua_04.gif";
    //document.getElementById("btn_eduon").src	="../../img/bua_40.gif";
    //document.getElementById("btn_endready").src	="../../img/bua_08.gif";
    clockStart();

    //-->
</SCRIPT>

<script event=OnHook for=unpbx>


    document.fm.status.value = "수화기를 내려놓음.\n" + document.fm.status.value;
    document.getElementById("btn_disconnect").src = "img/bua_21.gif";
    document.getElementById("btn_consult").src = "img/bua_07.gif";
    document.getElementById("btn_reconnect").src = "img/bua_10.gif";
    document.getElementById("btn_transfer").src = "img/bua_11.gif";
    //document.getElementById("btn_conference").src	="../../img/bua_32.gif";

    clockStop();

    var tmp = document.fm.btn_break_txt.value;
    if (tmp == "휴식중") {
        document.getElementById("btn_makecall").src = "img/bub_06.gif";
        document.getElementById("btn_breakon").src = "img/bua_04.gif";
        //document.getElementById("btn_breakoff").src		="../../img/bub_05.gif";
        //document.getElementById("btn_eduon").src		="../../img/bua_40.gif";
        //document.getElementById("btn_eduoff").src		="../../img/bub_41.gif";
        document.fm.status.value = "휴식중\n" + document.fm.status.value;
    } else {	// if(tmp == "회의취소"){
        document.getElementById("btn_breakon").src = "img/bub_04.gif";
        //document.getElementById("btn_breakoff").src		="../../img/bua_05.gif";
        //document.getElementById("btn_eduon").src		="../../img/bub_40.gif";
        //document.getElementById("btn_eduoff").src		="../../img/bua_41.gif";
        //document.fm.status.value = "상담대기\n" + document.fm.status.value;
    }
    //document.getElementById("btn_endready").src	="../../img/bub_08.gif";

    var AgID = document.fm.AgID.value;
    var AgtName = document.fm.AgtName.value;
    var AgLineNo = document.fm.AgLineNo.value;
    var telno = document.fm.telno.value;
    var iogubun = document.fm.iogubun.value;
    //var custnm = parent.mainFrame.CrmForm.cust_name.value;
    //var cust_idx = parent.mainFrame.CrmForm.cust_idx.value;
    //var call_no = parent.mainFrame.SangdamForm.call_no.value;

    //alert(AgLineNo);

    if (iogubun == "0") {
        iogubun = "O";
    } else {
        iogubun = "I";
    }

    /*
    alert(AgID);
    alert(AgtName);
    alert(AgLineNo);
    alert(telno);
    alert(iogubun);
    alert(custnm);
    */
    /*
    3.3 Ver.
    BSTR msgType 	: 메시지 종류
        1001 : 녹취 DATA UPDATE
        1002 : SUB 녹취 시작
        1003 : SUB 녹취 종료
    BSTR LineNum 	: 상담원 내선 번호
    BSTR CallId	: 콜에 대한 고유 ID
    BSTR AgentId	: 상담원 ID
    BSTR AgentName	: 상담원 이름
    BSTR innout	: IN/OUT 구분
    BSTR telno	: 고객 전화 번호1
    BSTR CID	: 고객 전환 번호2
    BSTR CustID, 	: 고객 ID
    BSTR CustName	: 고객 이름
    BSTR CustJumin	: 고객 주민 번호
    int Count	: 기타 전송한 DATA 수
    BSTR Body	: 기타 전송할 DATA, 구분은 | 으로 구분한다.
              각 DATA는 20Byte를 넘지 않는다.
    */
    sleep(1000);


    fm.CnRec.SendCustData('1001', AgLineNo, '', AgID, '', iogubun, telno, '', '', '', '', 0, '');
    //fm.CnRec.SendCustData ('1001',AgLineNo,'',AgID,AgtName,iogubun,telno,'',cust_idx,custnm,call_no,0,'');
    //
    //


</script>

<SCRIPT language=javascript event="CallDisconnected" for="unpbx">

    document.fm.status.value = "전화 끊어짐\n" + document.fm.status.value;
    //document.getElementById("btn_makecall").src	="../../img/bua_06.gif";
    document.getElementById("btn_consult").src = "img/bua_07.gif";
    document.getElementById("btn_reconnect").src = "img/bua_10.gif";
    document.getElementById("btn_transfer").src = "/img/bua_11.gif";
    document.getElementById("btn_breakon").src = "img/bua_04.gif";
    document.getElementById("btn_endready").src = "img/bub_08.gif";
    //document.getElementById("btn_calloff").src	="../../img/bua_21.gif";
    //document.getElementById("btn_breakoff").src	="../../img/bua_05.gif";
    //document.getElementById("btn_eduon").src	="../../img/bua_40.gif";
    //document.getElementById("btn_eduoff").src	="../../img/bua_41.gif";
    //document.getElementById("btn_conference").src	="../../img/bua_32.gif";
    //
    clockStop();

    var tmp = document.fm.btn_edu_txt.value;
    if (tmp == "휴식중") {
        //document.getElementById("btn_eduon").src		="../../img/bua_40.gif";
        //document.getElementById("btn_eduoff").src		="../../img/bub_41.gif";
        document.getElementById("btn_makecall").src = "img/bub_06.gif";
        document.getElementById("btn_breakon").src = "img/bua_04.gif";
        //document.getElementById("btn_breakoff").src		="../../img/bub_05.gif";
        document.fm.status.value = "휴식중\n" + document.fm.status.value;
    } else {	// if(tmp == "회의취소"){
        //document.getElementById("btn_eduon").src		="../../img/bub_40.gif";
        //document.getElementById("btn_eduoff").src		="../../img/bua_41.gif";
        document.getElementById("btn_breakon").src = "img/bub_04.gif";
        //document.getElementById("btn_breakoff").src		="../../img/bua_05.gif";
        //document.fm.status.value = "상담대기\n" + document.fm.status.value;
    }

    //-->
</SCRIPT>


<SCRIPT language=javascript event=Ready for=unpbx>


    document.fm.status.value = "후처리중\n" + document.fm.status.value;
    //document.getElementById("btn_endready").src	="../../img/bub_08.gif";

    document.getElementById("btn_makecall").src = "img/bua_06.gif";
    document.getElementById("btn_consult").src = "img/bua_07.gif";
    document.getElementById("btn_reconnect").src = "img/bua_10.gif";
    document.getElementById("btn_transfer").src = "img/bua_11.gif";
    //document.getElementById("btn_breakon").src	="../../img/bua_04.gif";
    //document.getElementById("btn_breakoff").src	="../../img/bua_05.gif";
    clockStop();


</SCRIPT>

<SCRIPT event=CallConnected for=unpbx>
    document.fm.status.value = "통화중\n" + document.fm.status.value;
    document.getElementById("btn_makecall").src = "img/bua_06.gif";
    document.getElementById("btn_consult").src = "img/bub_07.gif";
    document.getElementById("btn_answer").src = "img/bua_20.gif";
    //document.getElementById("btn_holdon").src	="../../img/bub_14.gif";
    //-->
</SCRIPT>

<SCRIPT language=javascript event=CallConsulting for=unpbx>
    //document.fm.status.value = "호전환요청중\n" + document.fm.status.value;
    //-->
</SCRIPT>

<SCRIPT language=javascript event=CallConsulted for=unpbx>
    //document.fm.status.value = "호전환요청완료\n" + document.fm.status.value;
    //-->
</SCRIPT>

<SCRIPT language=javascript event=CallCanceled for=unpbx>
    //daegi();

    //clockStop();
    //-->
</SCRIPT>

<SCRIPT language=javascript event=CallReconnected for=unpbx>
    //document.fm.status.value = "호전환취소중\n" + document.fm.status.value;
    //-->
</SCRIPT>

<SCRIPT language=javascript event=CallTransferred for=unpbx>
    //document.fm.status.value = "호전환완료\n" + document.fm.status.value;
    //-->
</SCRIPT>

<SCRIPT language=javascript event=CallConferenced for=unpbx>
    document.fm.status.value = "3자통화연결\n" + document.fm.status.value;
    //-->
</SCRIPT>

<script language="javascript" event=AgtStatus for=unpbx>
    agt_status = fm.unpbx.AgtStatus;

    if (agt_status == "03") {
        //휴식
        document.fm.status.value = "휴식중\n" + document.fm.status.value;
    } else if (agt_status == "35") {
        //교육
        document.fm.status.value = "교육중\n" + document.fm.status.value;
    } else if (agt_status == "37") {
        //기타
        document.fm.status.value = "기타\n" + document.fm.status.value;
    } else if (agt_status == "98") {
        //점심
        document.fm.status.value = "점심\n" + document.fm.status.value;
    } else if (agt_status == "75") {
        //대기
        document.fm.status.value = "대기중\n" + document.fm.status.value;
    } else if (agt_status == "69") {
        //후처리
        document.fm.status.value = "후처리중\n" + document.fm.status.value;
        document.getElementById("btn_disconnect").src = "img/bua_21.gif";
        document.getElementById("btn_endready").src = "img/bub_08.gif";
        document.getElementById("btn_consult").src = "img/bua_07.gif";
        document.getElementById("btn_makecall").src = "img/bub_06.gif";

        clockStop();
        document.fm.telno.value = "";
    } else {
    }


</script>
