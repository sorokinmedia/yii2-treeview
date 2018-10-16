<?php
namespace sorokinmedia\treeview;

/**
 * основной интерфейс построителя деревьев. интерфейс имплементирован в абстрактном классе
 *
 * Interface TreeViewModelInterface
 * @package sorokinmedia\treeview
 */
interface TreeViewInterface
{
    /**
     * собрать дерево моделей
     * @param TreeViewModelInterface $model
     * @param int $parent_id
     * @param int $level
     * @return mixed
     */
    public static function makeTree(TreeViewModelInterface $model, int $parent_id = 0, int $level = 0) : array;

    /**
     * собрать дерево моделей, для статического получения дочерних объектов
     * @param string $class_name
     * @param int $parent_id
     * @param int $level
     * @param null $filter
     * @return mixed
     */
    public static function makeTreeStatic(string $class_name, int $parent_id = 0, int $level = 0, $filter = null) : array;
}