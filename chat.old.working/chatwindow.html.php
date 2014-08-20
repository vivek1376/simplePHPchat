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
    <title>Chat</title>
    <script type="text/javascript">
        /*function write() {
         document.getElementById("displaymsg").innerHTML += 'hahuuu<br>';
         }*/
    </script>
    <style type="text/css">
        div#displaymsg {
            border: 1px solid gray;
            height: 500px;
            width: 400px;
            overflow: scroll;
            background-color: #fff2e7;
        }

        div#clickme {
            height: 50px;
            width: 100px;
            background-color: red;
        }

        p.message {
            margin: 8px;
            margin-left: 20px;
            //margin-right: 20px;
            padding: 6px;
            background-color: #51c2e1;
            font-family: helvetica, arial, sans-serif;
            font-size: 16px;
            border-bottom: 1px solid #7c869d;
            border-top: 1px solid #dce2ff;
            border-left: 1px solid #4fb0ce;
            border-right: 1px solid #4fb0ce;
            border-radius: 4px;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            right: 0px;
        }
    </style>
</head>
<body>
<div id="displaymsg"></div>
<form name="writemsg" id="msgform" method="post">
    <input type="text" name="msg" id="msg">
    <input type="submit" id="submitbutton" value="Submit">
</form>
<script type="text/javascript">

    (function () {
        var latestMsgTimestamp = '';
        var lastMsgTime = '2014-05-27 01:21:47';
        var httpRequest;
        var httpReq;
        var httpReqMsg;
        var refreshIntervalID;

        var redclick = function () {
            document.getElementById("displaymsg").innerHTML += 'haha<br>';
        };

        var callmakeReq = function () {
            makeReq('test.html')
        };

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
                alert('error!');
                return false;
            }
            httpReqMsg.onreadystatechange = fetchMsg;
            httpReqMsg.open('POST', 'chat.php');
            httpReqMsg.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpReqMsg.send('latestMsg=' + encodeURIComponent(latestMsgTimestamp));
        }

        function fetchMsg() {
            if (httpReqMsg.readyState === 4) {
                if (httpReqMsg.status === 200) {
                    var msgs = JSON.parse(httpReqMsg.responseText);
                    if (latestMsgTimestamp == '')
                        latestMsgTimestamp = msgs[0].ts;
                    else {
                        for (var i in msgs) {
                            document.getElementById("displaymsg").innerHTML += ('<p class="message"> ' + msgs[i].bd + '</p>');
                        }
                        latestMsgTimestamp = msgs[i].ts;
                    }

                } else {
                    alert('There was a problem with the request.');
                }
            }
        }

        refreshIntervalID = setInterval(refreshMsg, 1000);

        document.getElementById("msgform").onsubmit = function () {
            var msg = document.getElementById('msg').value;
            document.getElementById('msg').value = '';
            makeRequest('chat.php', msg);
            return false;
        }

        function makeReq(url) {
            if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                httpReq = new XMLHttpRequest();
            } else if (window.ActiveXObject) { // IE
                try {
                    httpReq = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e) {
                    try {
                        httpReq = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (e) {
                    }
                }
            }

            if (!httpReq) {
                alert('error!');
                return false;
            }

            httpReq.onreadystatechange = changeContent;
            httpReq.open('GET', url);
            httpReq.send();
        }

        function changeContent() {
            if (httpReq.readyState === 4) {
                if (httpReq.status === 200) {
                    document.getElementById("displaymsg").innerHTML += (httpReq.responseText + '<br>');
                } else {
                    alert('There was a problem with the request.');
                }
            }
        }

        function makeRequest(url, msg) {
            if (latestMsgTimestamp == '') {
                refreshMsg();
            }

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
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }
            httpRequest.onreadystatechange = alertContents;
            httpRequest.open('POST', url);
            httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpRequest.send('msg=' + encodeURIComponent(msg));
        }

        function alertContents() {
            if (httpRequest.readyState === 4) {
                if (httpRequest.status === 200) {
                    var msgs = httpRequest.responseText;

                    clearInterval(refreshIntervalID);
                    refreshMsg();
                    refreshIntervalID = setInterval(refreshMsg, 1000);

                } else {
                    alert('There was a problem with the request.');
                }
            }
        }
    })();
</script>
</body>
</html>