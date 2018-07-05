<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Message extends Model
{
    use Notifiable;
    //--禁用自动维护时间字段
    public $timestamps = false;
    //--时间显示格式
    protected $dateFormat = 'U';
    //--指定数据表
    protected $table = 'messenger_messages';
    //--需要存储并且显示的字段
//    protected $fillable = [
//        'p_id', 'code','p_code','name','level'
//    ];
    //--隐藏的字段
//    protected $hidden = [
//        'id'
//    ];
}