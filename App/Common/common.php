<?php
	function p($array){
		dump($array,1,'<pre>',0);
	}
	
	// function _verify($sum=4,$width=100,$height=30){//背景图片
	// $randval=randstr($sum);//µ÷ÓÃº¯ÊýÉú²úÑéÖ¤ÂëÎÄ±¾
	// $im=imagecreatetruecolor($width,$height);//´´½¨Õæ²ÊÉ«Í¼Æ¬
	// //·Ö±ð´ú±íÈýÖÖÑÕÉ«
	// $r=array(255,215,235,195,175);
	// $g=array(255,215,235,195,175);
	// $b=array(255,215,235,195,175);
	// $key=rand(0,4);
	// $back_color=imagecolorallocate($im,$r[$key],$g[$key],$b[$key]);//±³¾°ÑÕÉ«
	// $text_color=imagecolorallocate($im,222,0,14);//ÑéÖ¤ÂëÑÕÉ«
	// $point_color=imagecolorallocate($im,111,111,111);//¸ÉÈÅÔªËØÑÕÉ«
	// imagefill($im,0,0,$back_color);//ÉèÖÃ±³¾°ÑÕÉ«
	// for($i=0;$i<=100;$i++){
	// 	$pointx=rand(2,$width-2);
	// 	$pointy=rand(2,$height-2);
	// 	imagesetpixel($im,$pointx,$pointy,$point_color);//¾àÀë×óÉÏ½ÇÌî³äÑÕÉ«$point_colorµã
	// 	}
	// 	imagestring($im,120,10,5,$randval,$text_color);//ÉèÖÃÍ¼Æ¬ÉÏ×ÖÌå£¬ÒÔ¼°×ÖÌåµÄ´óÐ¡Î»ÖÃÒÔ¼°ÑÕÉ«
	// 	imagepng($im);//Êä³öÍ¼Æ¬
	// 	imagedestroy($im);//Ïú»ÙÍ¼Æ¬
	// 		}
	// 		function randstr($len){
	// 		$chars='QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890';
	// 		$string="";
	// 		while(strlen($string)< $len){
	// 			$string.=substr($chars,(rand()%strlen($chars)),1);//´Ó$charsÖÐËæ»úÈ¡³öÒ»¸öÊý
	// 			}
	// 			return $string;
	// 		}
		 function verify_(){
			import('ORG.Util.Image');
    		Image::buildImageVerify(4,1,'png',60,30,'verify');
	}
	    function isMobile(){ 
	    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
	    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
	    {
	        return true;
	    } 
	    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
	    if (isset ($_SERVER['HTTP_VIA']))
	    { 
	        // 找不到为flase,否则为true
	        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
	    } 
	    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
	    if (isset ($_SERVER['HTTP_USER_AGENT']))
	    {
	        $clientkeywords = array ('nokia',
	            'sony',
	            'ericsson',
	            'mot',
	            'samsung',
	            'htc',
	            'sgh',
	            'lg',
	            'sharp',
	            'sie-',
	            'philips',
	            'panasonic',
	            'alcatel',
	            'lenovo',
	            'iphone',
	            'ipod',
	            'blackberry',
	            'meizu',
	            'android',
	            'netfront',
	            'symbian',
	            'ucweb',
	            'windowsce',
	            'palm',
	            'operamini',
	            'operamobi',
	            'openwave',
	            'nexusone',
	            'cldc',
	            'midp',
	            'wap',
	            'mobile'
	            ); 
	        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
	        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
	        {
	            return true;
	        } 
	    } 
	    // 协议法，因为有可能不准确，放到最后判断
	    if (isset ($_SERVER['HTTP_ACCEPT']))
	    { 
	        // 如果只支持wml并且不支持html那一定是移动设备
	        // 如果支持wml和html但是wml在html之前则是移动设备
	        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
	        {
	            return true;
	        } 
	    } 
	    return false;
	} 

?>