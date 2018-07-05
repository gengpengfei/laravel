<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Market extends Model
{
    use Notifiable;
    //--禁用自动维护时间字段
    public $timestamps = false;
    //--时间显示格式
    protected $dateFormat = 'U';
    //--指定数据表
    protected $table = 'market';
    //--需要存储并且显示的字段
//    protected $fillable = [
//        'code','name','desc','image','url','position','sort','disabled','start_time','end_time',
//    ];
    //--隐藏的字段
    protected $hidden = [
        'id','create_by','created_at','modify_by','updated_at'
    ];
}
