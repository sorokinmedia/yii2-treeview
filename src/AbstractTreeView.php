<?php
namespace ma3obblu\treeview;

/**
 * абстрактный класс с реализацией построения дерева
 * требует на вход класс модели имплементирующйи интерфейс TreeViewModelInterface
 *
 * Class AbstractTreeView
 * @package ma3obblu\treeview
 */
abstract class AbstractTreeView implements TreeViewInterface
{
    /**
     * строит дерево моделей
     * у класса обязательно должны быть свойства (bool) 'has_child', (int) 'parent_id'
     * @param TreeViewModelInterface $model
     * @param int $parent_id
     * @param int $level
     * @return array
     */
    public static function makeTree(TreeViewModelInterface $model, int $parent_id = 0, int $level = 0) : array
    {
        $roots = $model->getChildModels($parent_id);
        if(is_null($roots)){
            return [];
        }
        $tree = [];
        foreach ($roots as $root){
            $root->level = $level;
            $tree[] = $root;
            if( $root->has_child == 1 ) {
                $tree = array_merge($tree, self::makeTree($model, $root->id,$level + 1));
            }
        }
        return $tree;
    }
}