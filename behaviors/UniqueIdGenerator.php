<?php
namespace app\behaviors;
/**
 * 北京指南科技科有限公司
 * 版权所有，未经授权，不得擅自复制和传播，公司保留所有诉讼权利。
 * Email: james@zhinantech.com
 * Website: http://www.zhinantech.com/
 */

use common\models\UniqueId;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * [
 *     "prefix" => function() {
 *          return date('Ymd')."_";
 *      }
 * ]
 *
 * @author James Hu <james@zhinantech.com>
 */
class UniqueIdGenerator extends Behavior
{
    const ALGORITHM_MD5 = "md5";
    const ALGORITHM_UNIQID = "uniqid";
    const ALGORITHM_SAFE_UNIQID = "safe_uniqid";
    
    /**
     * the prefix add to uid
     * 
     * @var string or callable
     */
    public $prefix = "";
    /**
     * the field to store unique id, typically it's uid
     * 
     * @var string
     */
    public $attribute = "uid";
    /**
     * the algorithm to generate unique id
     * 
     * @var string
     */
    public $algorithm = self::ALGORITHM_MD5;
    /**
     * The generated uid string length, only used when algorithm is ALGORITHM_SAFE_UNIQID, default is default
     * 
     * @var string
     */
    public $length = false;
    
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert'
        ];
    }
    
    public function beforeInsert($event)
    {
        if ($this->owner->hasAttribute($this->attribute)) {
            $prefix = is_callable($this->prefix)? call_user_func($this->prefix) : $this->prefix;

            if ($this->algorithm == self::ALGORITHM_MD5) {
                $value = md5(uniqid() . ":" . microtime(true) . ":" . rand(0, 1024));
            } elseif ($this->algorithm == self::ALGORITHM_UNIQID) {
                $value = uniqid();
            } else {
                $value = UniqueId::newUid(basename($this->owner->className()), $this->length);
            }
            
            if ($this->length !== false) {
                $value = substr($value, -$this->length);
            }
            
            $this->owner->{$this->attribute} = $prefix . $value;
        }
    }
}
