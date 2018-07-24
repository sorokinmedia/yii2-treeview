<?php
namespace ma3obblu\treeview;

/**
 * основной интерфейс построителя деревьев. интерфейс имплементирован в абстрактном классе
 *
 * Interface TreeViewModelInterface
 * @package ma3obblu\treeview
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
    public static function makeTree(TreeViewModelInterface $model, int $parent_id = 0, int $level = 0);
}