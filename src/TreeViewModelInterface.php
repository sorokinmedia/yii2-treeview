<?php

namespace sorokinmedia\treeview;

/**
 * интерфейс должен быть имплементирован любой моделью, дерево которой надо построить
 *
 * Interface TreeViewModelInterface
 * @package sorokinmedia\treeview
 */
interface TreeViewModelInterface
{
    /**
     * получить дочерние модели родителя
     * @param int $parent_id
     * @return array
     */
    public function getChildModels(int $parent_id): array;
}
