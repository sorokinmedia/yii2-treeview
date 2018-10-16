<?php
namespace sorokinmedia\treeview;

/**
 * абстрактный класс с реализацией построения дерева
 * требует на вход класс модели имплементирующйи интерфейс TreeViewModelInterface
 *
 * Class AbstractTreeView
 * @package sorokinmedia\treeview
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

    /**
     * строит дерево моделей, для статического получения дочерних объектов
     * у класса обязательно должны быть свойства (bool) 'has_child', (int) 'parent_id'
     * @param string $class_name
     * @param int $parent_id
     * @param int $level
     * @return array
     */
    public static function makeTreeStatic(string $class_name, int $parent_id = 0, int $level = 0) : array
    {
        /** @var TreeViewModelStaticInterface $class_name */
        $roots = $class_name::getChildModelsStatic($parent_id);
        if(is_null($roots)){
            return [];
        }
        $tree = [];
        foreach ($roots as $root){
            $root->level = $level;
            $tree[] = $root;
            if( $root->has_child == 1 ) {
                $tree = array_merge($tree, self::makeTreeStatic($class_name, $root->id,$level + 1));
            }
        }
        return $tree;
    }
}