<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

  protected $fillable = [
      'text', 'label', 'url', 'icon', 'can', 'parent_id',
  ];

  public function submenu()
  {
    return $this->hasMany('App\Menu', 'parent_id')->select(['id','text','label','can','url','icon']);
  }
}
