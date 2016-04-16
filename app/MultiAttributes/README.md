# 小描述 
利用 Laravel 的 Facade 的特性，建立一套可以添加属性，同时添加数据的类 。
Contract 描述了 操作存放属性的基本特性的文件的 基本方法
Attributes 实现了这些方法
SocialConnectAttributes 利用这些文件方法简历一套添加属性，删除属性，
添加对应该属性数据和删除对应该属性的数据的方式

# 属性的存放方式  Json 
SocialConnect 只存放 url 类型的社交属性
{
   '属性的唯一名字'
   {
     alias => '属性对应的中文名字'
     url   => '该属性对应的 url' 
   }
}
