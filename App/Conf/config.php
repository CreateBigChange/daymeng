<?php
header("Content-type:text/html;charset=utf-8");
//公用配置文件
return array(
	//'配置项'=>'配置值'
	'APP_GROUP_LIST'=>'Index,Admin',//开启分组
	'DEFAULT_GROUP'=>'Index', //默认分组
	//数据库配置信息
        'DB_TYPE'   => 'mysql', // 数据库类型
        'DB_HOST'   => 'localhost', // 服务器地址
        'DB_NAME'   => 'daimeng', // 数据库名
        'DB_USER'   => 'meng', // 用户名
        'DB_PWD'    => 'meng2014', // 密码
        'DB_PORT'   => '3306', // 端口
        'URL_HTML_SUFFIX'=>'shtml',//开启伪静态
        'DB_PREFIX' => '', // 数据库表前缀 
        //点语法默认解析 
        // 'TEMP_VAR_IDENTIFY'=>'array',
        // 'TEM_FILE_DEPR'=>'_',修改文件名，减少路径
        'URL_MODEL' => '2',
        'URL_ROUTER_ON'   => true, 
        'URL_ROUTE_RULES'=>array(     
        //发起项目路由规则
        'start/agreement'   =>'index/Startitem/index',  
        'start/info'           =>'index/Startitem/startitem2',
        'start/item'           =>'index/Iteminfo/index',
        'start/return'           =>'index/Returninfo/index',
        'start/finish'           =>'index/Returninfo/finish',
        //公众平台路由规则
        'mp/index'      =>'index/Publicplatform/index',
        'mp/item'       =>'index/Publicplatform/manageitem',
        'mp/news'       =>'index/Publicplatform/managenews',
        'mp/product'    =>'index/Publicplatform/manageproduct',
        'mp/user'       =>'index/Publicplatform/manageuser',
        'mp/msg'        =>'index/Publicplatform/sendgroupmsg',
        'mp/set'        =>'index/Publicplatform/setinfo',
        //帮助页面路由规则
        'help/125'      =>'index/Help/help125',
        'help/120'      =>'index/Help/index',
        'help/121'      =>'index/Help/help121',
        'help/122'      =>'index/Help/help122',
        'help/123'      =>'index/Help/help123',
        'help/124'      =>'index/Help/help124',
        'help/125'      =>'index/Help/help125',
        'help/126'      =>'index/Help/help126',
        'help/127'      =>'index/Help/help127',
        'help/128'      =>'index/Help/help128',
        'help/129'      =>'index/Help/help129',
        'help/130'      =>'index/Help/help130',
        //个人中心路由规则
        'address'       =>'index/PersonalPage/addressmanage',
        'password'      =>'index/PersonalPage/changepasswd',
        'my'            =>'index/PersonalPage/index',
        'friend'        =>'index/PersonalPage/managefriends',
        'comment'       =>'index/PersonalPage/mycomment', 
        'crowdfund'     =>'index/PersonalPage/mycrowdfunding',
        'atten'         =>'index/PersonalPage/myinterstitem',
        'support'       =>'index/PersonalPage/mysupportitem',
        'news'          =>'index/PersonalPage/newscenter',
        'system'        =>'index/PersonalPage/systemnews',
        'trade'         =>'index/PersonalPage/tradeinfo',
        //登陆注册,爱心天使湾
        'login'         =>'index/Login/index',
        'register'      =>'index/Register/index',
        'love'          =>'index/Love/index',
        'forget'        =>'index/Password/index',

        //主页,浏览项目，项目详情,个人页面
        'item'         =>'index/Items/index',
        'person/:id\d'  =>'index/Person/index',
        'detail/:item_id\d'	=>'index/Detail/index',
        'replynews/:receiver_id\d' =>'index/PersonalPage/replynews'

        ),
        'URL_CASE_INSENSITIVE'=>'true',//不区分大小写
       // 'VAR_FILTERS'=>'filter_default,filter_exp',//字符串过滤
    //自定义session,数据库存储
    //   'SESSION_TYPE'=>'Db',
       'URL_HTML_SUFFIX'=>'',
	   'SHOW_PAGE_TRACE' =>true,
       'alipay_config'=>array(
            'partner' =>'2088511263006282',   //这里是你在成功申请支付宝接口后获取到的PID;
            'key'=>'4me3ydx2mvk7tcgm03yon1pdbbrh3tw5',//这里是你在成功申请支付宝接口后获取到的Key
            'sign_type'=>strtoupper('MD5'),
            'input_charset'=> strtolower('utf-8'),
            'cacert'=> getcwd().'\\cacert.pem',
            'transport'=> 'http',
                             ),
       //以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；
       'alipay'=>array(
         //这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
        'seller_email'=>'checent@163.com',
        //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
        'notify_url'=>'www.daymeng.com/index.php/index/Pay/notifyurl', 
         //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
        'return_url'=>'www.daymeng.com/index.php/index/Pay/returnurl',
         //支付成功跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参payed（已支付列表）
        'successpage'=>'Pay/myorder?ordtype=payed', 
        //支付失败跳转到的页面，我这里跳转到项目的User控制器，myorder方法，并传参unpay（未支付列表）
        'errorpage'=>'Pay/myorder?ordtype=unpay', 
                ),
       
);
?>
