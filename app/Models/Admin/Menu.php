<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Rol;


class Menu extends Model
{
    protected $fillable = ['menu_name', 'menu_url', 'menu_icon'];
    protected $primaryKey = 'menu_id';

    public function rols()
    {
        return $this->belongsToMany(Rol::class, 'menu_rols', 'menu_id', 'rol_id');
    }

    public function getSons($fathers, $line)
    {
        $children = [];
        foreach ($fathers as $line1) {
            if ($line['menu_id'] == $line1['menu_type']) {
                $children = array_merge($children, [array_merge($line1, ['submenu' => $this->getSons($fathers, $line1)])]);
            }
        }
        return $children;
    }

    public function getFather($front)
    {
        if ($front) {
            return $this->whereHas('rols', function ($query) {
                $query->where('rols.rol_id', session()->get('rol_id'))->orderby('menu_type');
            })->orderby('menu_type')
                ->orderby('menu_order')
                ->get()
                ->toArray();
        } else {
            return $this->orderby('menu_type')
                ->orderby('menu_order')
                ->get()
                ->toArray();
        }
    }

    public static function getMenu($front = false)
    {
        $menus = new Menu();
        $fathers = $menus->getFather($front);
        $menuAll = [];
        foreach ($fathers as $line) {
            if ($line['menu_type'] != 0)
                break;
            $item = [array_merge($line, ['submenu' => $menus->getSons($fathers, $line)])];
            $menuAll = array_merge($menuAll, $item);
        }
        return $menuAll;
    }

    public function saveOrder($menu)
    {
        $menus = json_decode($menu);
        foreach ($menus as $var => $value) {
            $this->where('menu_id', $value->id)->update(['menu_type' => 0, 'menu_order' => $var + 1]);
            if (!empty($value->children)) {
                foreach ($value->children as $key => $vchild) {
                    $update_id = $vchild->id;
                    $parent_id = $value->id;
                    $this->where('menu_id', $update_id)->update(['menu_type' => $parent_id, 'menu_order' => $key + 1]);

                    if (!empty($vchild->children)) {
                        foreach ($vchild->children as $key => $vchild1) {
                            $update_id = $vchild1->id;
                            $parent_id = $vchild->id;
                            $this->where('menu_id', $update_id)->update(['menu_type' => $parent_id, 'menu_order' => $key + 1]);

                            if (!empty($vchild1->children)) {
                                foreach ($vchild1->children as $key => $vchild2) {
                                    $update_id = $vchild2->id;
                                    $parent_id = $vchild1->id;
                                    $this->where('menu_id', $update_id)->update(['menu_type' => $parent_id, 'menu_order' => $key + 1]);

                                    if (!empty($vchild2->children)) {
                                        foreach ($vchild2->children as $key => $vchild3) {
                                            $update_id = $vchild3->id;
                                            $parent_id = $vchild2->id;
                                            $this->where('menu_id', $update_id)->update(['menu_type' => $parent_id, 'menu_order' => $key + 1]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
