<?php
namespace sorokinmedia\treeview;

/**
 * интерфейс должен быть имплементирован любой моделью, дерево которой надо построить
 *
 * Interface TreeViewModelStaticInterface
 * @package sorokinmedia\treeview
 */
interface TreeViewModelStaticInterface
{
    /**
     * получить дочерние модели родителя, статическая версия
     * @param int $parent_id
     * @return mixed
     */
    public static function getChildModelsStatic(int $parent_id);
}