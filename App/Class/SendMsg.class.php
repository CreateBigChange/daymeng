<?php
/*设置UTF编码*/
header("Content-type: text/html; charset=utf-8"); 
/*默认时区设置，避免时间戳误差，本地程序有设置则无须重复设置*/
function_exists('date_default_timezone_set') && date_default_timezone_set('Etc/GMT-8');
/*应用参数信息,请将以下参数值设定为自身应用的参数信息*/
define("APP_ID","136699200000037596");	//应用ID
define("APP_SECRET","bc3e14f8cf10fcc28210169e156491e3");	//应用密钥
define("ACCESS_TOKEN", "a69958881937a344fb635e577721c4c01416994985040");	//应用TOEKN

class SendMsg{

	/*准备所有参数，进行排序，拼接*/
  	public $acceptor_tel;	//必选参数，接收方号码
	public	$template_id = "91002565";		//必选参数，短信模板ID
	public $template_param;	//必选参数，模板匹配参数
	public $timestamp;	//必选参数，时间戳

	/**
	 *构造函数 
	 *@param $acceptor_tel 接收方号码
	 *@param $template_param 模板匹配值
	 */
	public function __construct($acceptor_tel="13017148493",$template_param="{\"param1\":\"10000\"}"){
		$this->acceptor_tel	 =	$acceptor_tel;
		$this->template_param =	$template_param;
		$this->timestamp = utf8_encode(date('Y-m-d H:i:s'));
	}

	/**
	 * 初始化
	 */
	public function init(){
		$params_array = array(
			'app_id'			=> APP_ID,
			'access_token'		=> ACCESS_TOKEN,
			'acceptor_tel'		=> $this->acceptor_tel,
		   	'template_id'       => $this->template_id,
		   	'template_param'    => $this->template_param,
			'timestamp'			=> $this->timestamp
		);
		ksort($params_array);	//按照key进行字典升序

		$params_str = "";	//请求参数间以‘&’字符拼接成的字符串
		foreach ($params_array as $k=>$v){
			$params_str .= '&'.$k.'='.$v;
		}
		$params_str = substr($params_str, 1);

		/*sign参数签名获取*/
		$hmac = hash_hmac("sha1", $params_str, APP_SECRET, true);
		$sign = base64_encode($hmac);	//非必选参数，参数签名
		$params_array['sign'] = $sign;

		$url = 'http://api.189.cn/v2/emp/templateSms/sendSms';	//模板短信请求地址

		//获取结果
		$result = $this->post($url, $params_array);
		return $result;
	}
	
	/**
	 * POST 请求
	 * @param  $url	请求地址
	 * @param  $params	请求参数数组
	 * @param  $header	HTTP头信息
	 */
  	 public function post($url , $params_array = array(), $header = array()){
        $ch = curl_init();	// 初始化CURL句柄
        curl_setopt($ch, CURLOPT_URL, $url);	//设置请求的URL
        curl_setopt($ch, CURLOPT_POST, 1);	//启用POST提交
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);		// 设为TRUE把curl_exec()结果转化为字串，而不是直接输出
        $postdata = '';		//请求参数数组转化为以‘&’分隔的字符串
  		if(!empty($params_array)) {
			foreach($params_array as $k=>$v) {
				$postdata .= $k.'='.rawurlencode($v).'&';		//注意，此处统一对传入参数做urlencode处理，请勿重复encdoe参数
			}
			$postdata = substr($postdata, 0, -1);
		}
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);	//设置POST提交的请求参数
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);	//设置HTTP头信息
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);	//设置超时时间15秒
        $response = curl_exec($ch);	//执行预定义的CURL
        curl_close($ch);	//关闭CURL
        return $response;
    }
    
	/**
	 * GET 请求
	 * @param  $url	请求地址
	 */
	public function get($url){
		$ch = curl_init();	// 初始化CURL句柄
		curl_setopt($ch, CURLOPT_URL, $url);	//设置请求的URL
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);		// 设为TRUE把curl_exec()结果转化为字串，而不是直接输出
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);	//设置超时时间15秒
        $response = curl_exec($ch);	//执行预定义的CURL
        curl_close($ch);	//关闭CURL
        return $response;
	}
}
?>