# base64-pwd
### 防止抓包拦截敏感数据，混淆加密传输，可以由后端控制提高安全性。

## 前端使用图列：
![image](https://github.com/1019227215/base64-pwd/blob/master/html.png)

## 前端调用方式：
```
/**
 * 字符串加密&解密
 * 混淆加密算法，后端需要一样的处理方法
 */
$(function(){

	//参数可以由后端动态生成，每个用户的参数不一样，这样可以提高安全系数（当然不动态生成也是可以的）
	//$.pwd.PWDNUB=3;
	//$.pwd.ALPHA="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	
	$("#enpwd").change(function(){
		$("#showenpwd").text($.pwd.encode($(this).val()));
	});

	$("#depwd").change(function(){
		$("#showdepwd").text($.pwd.decode($(this).val()));

	});
});
```
![image](https://github.com/1019227215/base64-pwd/blob/master/01.png)

## 后端使用图列：
![image](https://github.com/1019227215/base64-pwd/blob/master/php.png)

## 后端调用方式：
```
/**
 * 列：
 */
$base64pwd = new base64Pwd();
if ($argv[1]) {

    if ($argv[2]) {
        var_dump($base64pwd->decode($argv[1]));
    } else {
        var_dump($base64pwd->encode($argv[1]));
    }
} else {

    var_dump($base64pwd->getRandomString(3));
}
```
![image](https://github.com/1019227215/base64-pwd/blob/master/02.png)
