<?php
namespace ma3obblu\treeview;

/**
 * интерфейс должен быть имплементирован любой моделью, дерево которой надо построить
 * 
 * Interface TreeViewModelInterface
 * @package ma3obblu\treeview
 */
interface TreeViewModelInterface
{    
    /**
     * получить дочерние модели родителя
     * @param int $parent_id
     * @return mixed
     */
    public function getChildModels(int $parent_id);
}