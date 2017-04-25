<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Demo</title>
    <style>
        body, input, select, button, h1 {
            font-size: 28px;
            line-height:1.7;
        }
    </style>
</head>

<body>

    <h1>员工查询</h1>

    <label>请输入员工编号：</label>
    <input type="text" id="query" />
    <button id="search">查询</button>

    <p id="searchResult"></p>

    <h1>员工新建</h1>
    <label>请输入员工姓名：</label>
    <input type="text" id="name" /><br>
    <label>请输入员工编号：</label>
    <input type="text" id="num" /><br>
    <label>请选择员工性别：</label>
    <select id="sex">
        <option>女</option>
        <option>男</option>
    </select><br>
    <button id="save">保存</button>
    <p id="createResult"></p>


<script>
    //查询的js
    document.getElementById("search").onclick = function() {
        var request = new XMLHttpRequest();
        request.open("GET", "/yangyang/Ajax/search?num=" + document.getElementById("query").value);
        request.send();
        request.onreadystatechange = function() {
            if (request.readyState===4) {
                if (request.status===200) {
                    document.getElementById("searchResult").innerHTML = request.responseText;
                } else {
                    alert("发生错误：" + request.status);
                }
            }
        }
    }
    //添加的js
    document.getElementById("save").onclick = function() {
        var request = new XMLHttpRequest();
        request.open("POST", "/yangyang/Ajax/create");
        var data = "name=" + document.getElementById("name").value
            + "&num=" + document.getElementById("num").value
            + "&sex=" + document.getElementById("sex").value;
        request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        request.send(data);
        request.onreadystatechange = function() {
            if (request.readyState===4) {
                if (request.status===200) {
                    document.getElementById("createResult").innerHTML = request.responseText;
                } else {
                    alert("发生错误：" + request.status);
                }
            }
        }
    }
</script>
</body>
</html>