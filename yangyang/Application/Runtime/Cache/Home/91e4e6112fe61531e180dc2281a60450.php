<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<title>省市联动</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<script src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.js"></script>
	<style>
		select{
			width:150px ;
			height: 25px;
		}
	</style>
</head>
<body>
	<div>
		<select onchange="sech(this.id)" id="sheng">
		<option value="province">-----请选择省份-----</option>
		</select>
		
		<select onchange="sech(this.id)" id="shi">
		<option value="city">-----请选择市区-----</option>
		</select>

		<select id="xian">
		<option value="county">-----请选择县区-----</option>
		</select>
		<P id="dsd"></P>
	</div>
	<script>
        window.onload = getProvince;

        function sech(id) {
            //省市改变时触发，select的onchange事件
            var aa = document.getElementById(id);
            if(id =="sheng"){
                getCity(aa.value);//这里aa.value为省的id
            }
            if(id =="shi"){
                getCounty(aa.value);//这里aa.value为市的id
            }
        }

		 function getProvince () {
            var request = new XMLHttpRequest();
            request.open("GET", "/yangyang/Liandong/getProvince?ID=0");
            request.send();
            request.onreadystatechange = function() {
                if (request.readyState===4) {
                    if (request.status===200) {
                        var data = JSON.parse(request.responseText);
                        document.getElementById("sheng").length=1;
                        var obj=document.getElementById("sheng");
                        for(i=0;i<data.length;i++){
                            obj.options.add(new Option(data[i]['name'],data[i]['id']));
                        }
                        //动态生成OPTION加到select中，第一个参数为Text,第二个参数为Value值.
                    } else {
                        alert("发生错误：" + request.status);
                    }
                }
            }
        }

        function getCity (id) {
            var request = new XMLHttpRequest();
            request.open("GET", "/yangyang/Liandong/getCity?ID=" + id);
            request.send();
            request.onreadystatechange = function() {
                if (request.readyState===4) {
                    if (request.status===200) {
                        var data = JSON.parse(request.responseText);
                        document.getElementById("shi").length=1;
                        var obj=document.getElementById("shi");
                        for(i=0;i<data.length;i++){
                            obj.options.add(new Option(data[i]['name'],data[i]['id']));
                        }
                        //动态生成OPTION加到select中，第一个参数为Text,第二个参数为Value值.
                    } else {
                        alert("发生错误：" + request.status);
                    }
                }
            }
        }

        function getCounty (id) {
            var request = new XMLHttpRequest();
            request.open("GET", "/yangyang/Liandong/getCounty?ID=" + id);
            request.send();
            request.onreadystatechange = function() {
                if (request.readyState===4) {
                    if (request.status===200) {
                        var data = JSON.parse(request.responseText);
                        document.getElementById("xian").length=1;
                        var obj=document.getElementById("xian");
                        for(i=0;i<data.length;i++){
                            obj.options.add(new Option(data[i]['name'],data[i]['id']));
                        }
                        //动态生成OPTION加到select中，第一个参数为Text,第二个参数为Value值.
                    } else {
                        alert("发生错误：" + request.status);
                    }
                }
            }
        }

	</script>
</body>
</html>