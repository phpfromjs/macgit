//功能:判断是否为空
//参数:theField:要判断的文本框对象
//     massage:提示消息
//返回:若str不为空,返回true;否则,弹出消息提示,返回false
function strNoEmpty(theField,massage)
{
    if (theField.value==""){
		alert(massage);
        theField.focus();
        return false;
    }
	return true
}
//功能:判断是否相等
//参数:theField:要判断的文本框对象
//     theField2:要判断的文本框对象
//     massage:提示消息
//返回:若相等,返回true;否则,弹出消息提示,返回false
function strNoEqual(theField,theField2,massage)
{
    if (theField.value!=theField2.value){
		alert(massage);
        theField2.focus();
		theField2.select();
        return false;
    }
	return true
}
//功能:判断单(多)选按钮组是否选值
//参数:theRadio:要判断的单(多)选按钮组对象
//     massage:提示消息
//返回:若至少选了一个项,返回true;否则,弹出消息提示,返回false
function checkOne(theRadio,massage)
{
	if(typeof(theRadio)=="object")
	{
		if(theRadio.length==null)
		{
			if(theRadio.checked) return true;
		}
		else
		{
			for(var i=0;i<theRadio.length;i++)
			{
				if(theRadio[i].checked)
				{
					return true;
				}
			}
		}
	}
    alert(massage);
    return false;
}
//功能:判断单(多)选按钮组是否选值
//参数:theRadio:要判断的单(多)选按钮组对象
//     massage:提示消息
//返回:若至少选了一个项,返回true;否则,弹出消息提示,返回false
function selectOne(theSelect,massage)
{
	if(typeof(theSelect)=="object")
	{
		for(var i=0;i<theSelect.length;i++)
		{
			if(theSelect.options[i].selected)
			{
				return true;
			}
		}
	}
	
    alert(massage);
    return false;
}
//================================
//功能:判断非法字符
//参数:theField:要判断的文本框对象
//     massage:提示消息
//返回:若str合法,返回true;否则,弹出消息提示,返回false
function strFilter(theField,massage)
{
var filterChar="><' ;";  //需要过滤的字符
var filterTip=["大于号","小于号","单撇号","空格","分号"];  //字符说明

	for (i = 0; i < filterChar.length;i++)
    {   
        var c = filterChar.charAt(i);
        if (theField.value.indexOf(c) != -1){
			alert(massage + filterTip[i]);
			theField.focus();
			return false;
			}
    }
	return true
}
//================================
//判断数值型数据
function IsNum(theField,massage)
{
    var Number = "0123456789";
    var s=theField.value;

    if(s=="")
	{
		alert(massage);
	    theField.focus();
	    return false;
	}
    for (i = 0; i < s.length;i++)
        {   
            var c = s.charAt(i);
            if (Number.indexOf(c) == -1)
                {
					alert(massage);
                    theField.focus();
                    return false;
                }
        }
    return true;
}
//判断字符串是否由数字、字母和下划线组成(用于帐号和密码)
function IsLetterNum(str)
{
	if(str=="") return false;
	for (var i=0; i<str.length;i++)
	{
		var c=str.charAt(i)
		if(!((c>='0'&&c<='9')||(c>='A'&&c<='Z')||(c>='a'&&c<='z')||c=='_'))
			return false;
	}
	return true;
}
//功能:四舍五入函数
//参数:fNum  传入的数值；fBit 保留几位小数
function JSRound(fNum,fBit)
{ 
	var i = 1; 
	var m = 1; 
	var tempNum= fNum; 
	for(i=1;i <= fBit;i++)  m = m * 10; 
	tempNum = tempNum * m; 
	tempNum = Math.round(tempNum); 
	tempNum = tempNum / m; 
	return tempNum;
}
//================================
//功能:判断是否是中文字符
//参数:str要判断的字符
function isChinese(str)
{
   var lst = /[u00-uFF]/;       
   return !lst.test(str);      
}
//功能:判断中英文字符长度
//参数:str要判断的字符串
function strlen(str) 
{
   var strlength=0;
   for (i=0;i<str.length;i++)
  {
     if (isChinese(str.charAt(i))==true)
        strlength=strlength + 2;
     else
        strlength=strlength + 1;
  }
return strlength;
}
//=================================

//功能：检查是否为Email Address
//参数：要检查的字符串
//返回值：false：不是  true：是
function chkEmail(theField,message)
{
	var i=theField.value.length;
	var temp = theField.value.indexOf("@");
	var tempd = theField.value.indexOf(".");
	if (temp > 1) {
		if ((i-temp) > 3){	
			if ((i-tempd)>0){
			 return true;
			}
		}
	}
	alert(message);
	theField.focus();
	theField.select();
	return false;
}
//功能：检查是否为合法帐号
//参数：要检查的字符串
//返回值：false：不是  true：是
function chkAcc(theField)
{
	if(!strNoEmpty(theField,"请您输入帐号!")) return false;
	if(!IsLetterNum(theField.value)){
		alert("帐号只能由字母、数字和下划线组成!");
		theField.select();
		return false;
	}
	if(strlen(theField.value)<4||strlen(theField.value)>20){
		alert("帐号长度为4-20字符!");
		theField.select();
		return false;
	}
	return true;
}
//功能：检查是否为合法密码
//参数：要检查的字符串
//返回值：false：不是  true：是
function chkPwd(theField)
{
	if(!strNoEmpty(theField,"请您输入密码!")) return false;
	if(!IsLetterNum(theField.value)){
		alert("密码只能由字母、数字和下划线组成!");
		theField.select();
		return false;
	}
	if(strlen(theField.value)<6||strlen(theField.value)>16){
		alert("密码长度为6-16字符!");
		theField.select();
		return false;
	}
	return true;
}	