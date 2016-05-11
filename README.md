# uptoken 获得 
url: 
host/test/uptoken

return:

```
{"uptoken":"value"}
```















# 提供测试性
Api 主机地址/test/ajax 



提交格式 ajax  json 
内容 :

```
{
  'portrait_url':'url'
}
```

返回

```
{
  'status':'error',
  'reason':''
}
```

或返回

```
{
  'status':'success'
}
```

注:

1. 需要 **meta** 
2. 需要在 json 中加 **header** 
以上两点均可参见 : http://wenda.golaravel.com/question/650
3. 不用担心 **user_id** 的问题， 如果放在 laravel 运行的话，会自动写到 seesion 中，不需要在提交中注明。


