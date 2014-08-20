<?php
/**
 * Created by PhpStorm.
 * User: vivek
 * Date: 24/5/14
 * Time: 5:35 PM
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/phptest/includes/helpers.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Chat</title>
    <script type="text/javascript">
        /*function write() {
         document.getElementById("displaymsg").innerHTML += 'hahuuu<br>';
         }*/
    </script>
    <link rel="stylesheet" type="text/css" href="cssreset.css" media="screen">
    <!--<link rel="stylesheet" type="text/css" href="nanoscroller.css" media="screen">-->

    <style type="text/css">

        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        #outer {
            margin-right: auto;
            margin-left: auto;
            width: 640px;
            border: 1px solid #d8cdbb;
            border-top: 0;
            overflow: auto;
            background-color: #efe2ce;
        / / height : 100 %;
        }

        body {
            background-color: #e9e7e7;
        }

        /*
        #container {
            width: 640px;
            border-left: 1px solid gray;
            border-right: 1px solid gray;
            margin: 0 auto;
        }*/
        #container {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        div#displaymsg {
        / / border : 1 px solid gray;

            height: 300px;
            padding-top: 10px;
        / / width : 350 px;
        / / overflow : auto;
        / / overflow-x : hidden;
            background-color: #432818;
        / / margin : 0 auto;
        / / margin-top : 20 px;
        }

        p.message {
            width: 200px;
            margin: 8px 0;
            padding: 6px;

            background-color: #e1dea8;
            font-family: helvetica, arial, sans-serif;
            font-size: 16px;
            border: 1px solid #e3e0aa;
            border-top-color: #e8e5ae;
            border-bottom-color: #dcd9a4;
            border-radius: 3px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
        }

        p.sender {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            -moz-border-radius-topright: 0;
            -moz-border-radius-bottomright: 0;
            -webkit-border-top-right-radius: 0;
            -webkit-border-bottom-right-radius: 0;
            border-right: 4px solid #432818;
            float: right;
            background-color: #e7d2b2;
        }

        p.receiver {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            -moz-border-radius-topleft: 0;
            -moz-border-radius-bottomleft: 0;
            -webkit-border-top-left-radius: 0;
            -webkit-border-bottom-left-radius: 0;
            border-left: 4px solid #432818;
            float: left;
        }

        div#container {
            margin-left: auto;
            margin-right: auto;
        / / margin-top : 50 px;
            width: 300px;
        / / width : 100 %;
        }

        form #submitbutton {
            display: block;
            box-sizing: content-box;
            -moz-box-sizing: border-box;
            padding: 0;
            height: 42px;
            width: 46px;
            right: 0;
            border: 0;
            background-color: #506274;
            border-top: 1px solid #73879b;
            border-bottom: 1px solid #4e6177;
            border-left: 1px solid #627384;
            color: white;
            float: left;
        }

        form#msgform {
            display: block;
            padding: 0;
        / / height : 40 px;
            overflow: auto; /* to prevent height collapse */
        }

        form #msg {
            display: block;
            border: 0;
            padding: 0;
            margin: 0;
            background-color: #ac6d50;
            border-top: 1px solid #9c604c;
            border-bottom: 1px solid #ba7952;
            box-sizing: border-box;
            height: 42px;
            width: 254px;
            resize: none;
            float: left;
            padding: 6px;
            overflow: hidden;

        }

        form #msg:hover {
            background-color: #c48370;
        }

        form #msg:focus {
            background-color: #dba9a3;
            border-top: 1px solid #d3a19b;
            border-bottom: 1px solid #e6b3ad;
        }

        .nano {
        / / height : 300 px;
            width: 300px;
        / / width : 100 px;
        / / box-sizing : border-box;
            border-bottom: 2px solid #ffe4d3;
        }

        /*
        .nano .nano-content {
            padding: 10px;
        }

        .nano .nano-pane {
            background: #888;
        }

        .nano .nano-slider {
            background: #111;
        }
        */

    </style>
    <!--<link rel="stylesheet" href="mobile.css" media="handheld">
    <link rel="stylesheet" href="mobile.css" media="only screen and (max-width: 720px)">-->

</head>
<body>
<div id="outer">
    <div id="container">
        <div class="nano">
            <div id="displaymsg" class="nano-content"></div>
        </div>
        <form name="writemsg" id="msgform" method="post">
            <!--<input type="text" name="msg" id="msg">-->
            <textarea name="msg" id="msg" rows="1"></textarea>
            <input type="hidden" name="senderid" value="<?php htmlout($_SESSION['userid']); ?>">
            <input type="hidden" name="receiverid" value="<?php htmlout($friendid); ?>">
            <input type="submit" id="submitbutton" value="SEND">
        </form>
    </div>
</div>

<script type="text/javascript">

    (function () {
        var latestMsgTimestamp = '';
        var latestMsgID = '';
        var lastMsgTime = '2014-05-27 01:21:47';
        var httpRequest;
        var httpReq;
        var httpReqMsg;
        var refreshIntervalID;

        var refreshMsg = function () {
            if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                httpReqMsg = new XMLHttpRequest();
            } else if (window.ActiveXObject) { // IE
                try {
                    httpReqMsg = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e) {
                    try {
                        httpReqMsg = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (e) {
                    }
                }
            }

            if (!httpReqMsg) {
                //alert('error!');
                return false;
            }
            httpReqMsg.onreadystatechange = fetchMsg;
            httpReqMsg.open('POST', 'chat.php');
            httpReqMsg.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpReqMsg.send('latestMsgID=' + encodeURIComponent(latestMsgID)
                + '&senderid=' + <?php echo($_SESSION['userid']); ?> +'&receiverid=' + <?php echo $friendid; ?>);
        }

        function fetchMsg() {
            if (httpReqMsg.readyState === 4) {
                if (httpReqMsg.status === 200) {
                    //document.getElementById("displaymsg").innerHTML += ('<p class="message"> ' + httpReqMsg.responseText + '</p>');
                    var msgs = JSON.parse(httpReqMsg.responseText);

                    //check if last message id is null
                    if (latestMsgID == '')
                        latestMsgID = msgs[0].id;
                    else {
                        if (msgs[0]) {//without it working but showed some error in console log
                            //console.log('heyyyyy');
                            for (var i in msgs) {
                                if (msgs[i].sid ==<?php echo $_SESSION['userid']; ?>)
                                    var msgtype = 'sender';
                                else if (msgs[i].sid ==<?php echo $friendid; ?>)
                                    var msgtype = 'receiver';
                                document.getElementById("displaymsg").innerHTML += (
                                    '<p class="message'
                                        + ' '
                                        + msgtype + '">'
                                        + msgs[i].bd
                                        + '</p>'
                                    );
                                //document.getElementById("displaymsg").innerHTML += ('<p class="message"> ' + httpReqMsg.responseText + '</p>');
                            }
                            latestMsgID = msgs[i].id;

                            var objDiv = document.getElementById("displaymsg");
                            objDiv.scrollTop = objDiv.scrollHeight;
                            //$(".nano").nanoScroller();
                            //setTimeout(refreshMsg,1200);   not wrking here why??
                        }

                    }
                    refreshIntervalID = setTimeout(refreshMsg, 1200);

                } else {
                    //alert('There was a problem with the request.');
                }
            }

        }

        refreshMsg();

        //refreshIntervalID = setInterval(refreshMsg, 1000);

        //submit message on clicking send button
        document.getElementById("msgform").onsubmit = function () {
            var msg = document.getElementById('msg').value;
            document.getElementById('msg').value = '';
            makeRequest('chat.php', msg);
            return false;
        }

        function makeRequest(url, msg) {
            //if (latestMsgID == '') {
            //  refreshMsg();
            //}

            if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                httpRequest = new XMLHttpRequest();
            } else if (window.ActiveXObject) { // IE
                try {
                    httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e) {
                    try {
                        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (e) {
                    }
                }
            }

            if (!httpRequest) {
                //alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }
            httpRequest.onreadystatechange = alertContents;
            httpRequest.open('POST', url);
            httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpRequest.send('msg=' + encodeURIComponent(msg)
                + '&senderid=' + <?php echo($_SESSION['userid']); ?> +'&receiverid=' + <?php echo $friendid; ?>);
        }

        function alertContents() {
            if (httpRequest.readyState === 4) {
                if (httpRequest.status === 200) {
                    var response = httpRequest.responseText;

                    clearTimeout(refreshIntervalID);
                    refreshMsg();
                    refreshIntervalID = setTimeout(refreshMsg, 1200);

                } else {
                    //alert('There was a problem with the request.');
                }
            }
        }

        refreshMsg();
    })();
</script>
<!--<script type="text/javascript" src="jquery-1.11.1.min.js"></script>-->
<!--<script type="text/javascript" src="nanoScroller.js"></script>-->
<script type="text/javascript">
    //$(".nano").nanoScroller({ alwaysVisible: true });
    //$(".nano").nanoScroller();

</script>
</body>
</html>