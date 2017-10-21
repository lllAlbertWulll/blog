<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','blogs_count','bio'];


    public function blogs(){
        // belongsToMany(Category::class,'your_table') 定义多对多的关系
        // 第一个参数：相关联的模型类
        // 第二个参数（可选）：枢纽表/也就是关联表，如果不想使用默认的枢纽表命名方式，可以传递数据库表名
        return $this->belongsToMany(Blog::class)->withTimestamps();
    }
}
