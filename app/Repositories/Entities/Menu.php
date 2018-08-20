<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * {@inheritDoc}
     */
    protected $table = 'menus';

    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'parent', 'name', 'display_name', 'icon', 'pattern', 'href', 'is_parent',
    ];

    /**
     * Dropdown list for menu.
     * 
     * @return array
     */
    public function dropdown()
    {
        return static::orderBy('display_name', 'asc')->where('is_parent', false)->lists('name', 'name');
    }

    /**
     * Return menu's query for Datatables.
     *
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function datatables()
    {
        return static::select('id', 'is_parent', 'display_name', 'href');
    }

    /**
     * Dropdown.
     * 
     * @param  bool $parent
     * @return array
     */
    public function dropdownSelect($parent = false, $id = null)
    {
        $return = static::orderBy('display_name', 'asc')->where('is_parent', $parent);

        if (! is_null($id)) {
            $return->where('id', '!=', $id);
        }

        return $return->lists('display_name', 'id');
    }

    /**
     * Create Menu Nodes (multiple)
     *
     * @param mixed $menuAttributes
     * @param mixed Menu parent node
     * @return Menu
     */
    public static function createMenus($menuAttributes, $parent = null)
    {
        if (!($parent instanceof Menu))
        {
            $parent = new Menu;
        }

        foreach ($menuAttributes as $menuData)
        {
            $data = [
                    'is_parent'     => Menu::assignMenuParent($menuData, $parent),
                    'name'          => Menu::assignMenuName($menuData, $parent),
                    'display_name'  => Menu::assignMenuDisplayName($menuData, $parent),
                    'icon'          => Menu::assignMenuIcon($menuData, $parent),
                    'pattern'       => Menu::assignMenuPattern($menuData, $parent),
                    'href'          => Menu::assignMenuHref($menuData, $parent),
                    'parent'        => $parent->id,
                ];

            $menuNode = Menu::createMenu($data);

            if (isset($menuData['child']) && !empty($menuData['child']) && count($menuData['child']))
            {
                // Populate child
                Menu::createMenus($menuData['child'], $menuNode);
            }
        }
    }

    public static function assignMenuParent($menuData, Menu $parent)
    {
        return (isset($menuData['is_parent']) && !empty($menuData['is_parent'])) ? $menuData['is_parent'] : false;
    }

    public static function assignMenuName($menuData, Menu $parent)
    {
        return (isset($menuData['name']) && !empty($menuData['name'])) ? $menuData['name'] : null;
    }

    public static function assignMenuDisplayName($menuData, Menu $parent)
    {
        return (isset($menuData['display_name']) && !empty($menuData['display_name'])) ? $menuData['display_name'] : null;
    }

    public static function assignMenuIcon($menuData, Menu $parent)
    {
        return (isset($menuData['icon']) && !empty($menuData['icon'])) ? $menuData['icon'] : null;
    }

    public static function assignMenuPattern($menuData, Menu $parent)
    {
        return (isset($menuData['pattern']) && !empty($menuData['pattern'])) ? $menuData['pattern'] : null;
    }

    public static function assignMenuHref($menuData, Menu $parent)
    {
        return (isset($menuData['href']) && !empty($menuData['href'])) ? $menuData['href'] : null;
    }

    public static function createMenu($menuAttribute)
    {
        return Menu::create($menuAttribute);
    }
}
