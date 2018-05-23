<?php
namespace app\helpers;

/**
 * 北京指南科技科有限公司
 * 版权所有，未经授权，不得擅自复制和传播，公司保留所有诉讼权利。
 * @author liangfujian
 * @ctime 2016-11-08
 * @mtime 2016-11-08
 * Website: http://www.zhinantech.com/
 */
class BrowserHelper {
    
    private $agent = 'unknown';
    private $name = 'unknown';
    private $version = '0.0.0';
    private $allowRedirect = true;
    
   
    public function __construct()
    {
        $browsers = array("firefox", "msie", "edge", "opera", "chrome", "safari",
                            "mozilla", "seamonkey", "konqueror", "netscape",
                            "gecko", "navigator", "mosaic", "lynx", "amaya",
                            "omniweb", "avant", "camino", "flock", "aol", "360se");

        $this->agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        
        if(stripos($this->agent, 'rv:')>0 && stripos($this->agent,'gecko')>0) {
            //ie 11以上
            preg_match("/rv:([\d\.]+)/", $this->agent, $match);
            $this->name = "msie";
            $this->version = $match[1] ;
        } else {
            foreach($browsers as $browser)
            {
                if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->agent, $match))
                {
                    $this->name = $match[1] ;
                    $this->version = $match[2] ;
                    break ;
                }
            }
        }

    }
    
    /**
     * 获取浏览器类型
     * @return string
     */
    public function getBrowser(){
        return $this->name;
    }
    
    /**
    * 是否移动端访问访问
    *
    * @return bool
    */
   public function isMobile()
   { 
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
        //判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia', 'sony', 'ericsson',
                'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-',
                'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 
                'ipod', 'blackberry', 'meizu', 'android', 'netfront',
                'symbian', 'ucweb', 'windowsce', 'palm', 'operamini',
                'operamobi', 'openwave', 'nexusone', 'cldc', 'midp',
                'wap', 'mobile', 'micromessenger'
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

    
    /**
     * 判断当前浏览器是否能访问
     * @return boolean
     */
    public function isAllowRedirect() {

        $this->allowRedirect = (($this->name == "msie" && intval($this->version) > 8)
                || $this->name == "chrome"
                || $this->name == "firefox"
                || $this->name == "safari"
                || $this->name == "edge"
                || $this->isMobile()
                );
        
        return $this->allowRedirect;
    }

    public function isIE_LT_10(){
        return $this->name == "msie" && intval($this->version)<10;
    }
    
}
