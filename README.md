# yii2-treeview

***
Sorokin.Media repository
***

Компонент позволяет строить деревья комментариев для заданной сущности.

АР модель должна имплементировать интерфейс `TreeViewModelInterface` и реализовывать метод `getChildModel(int $parent_id)`

Пример файла основной модели (в данной случае CourseLesson):
```php
class CourseLesson extends CourseLessonAR implements TreeViewModelInterface
{
    public function getChildModels(int $parent_id)
    {
        return ($this->__courseLessonCommentClass)::find()
            ->where(['lesson_id' => $this->id, 'parent_id' => $parent_id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }
}
```

Далее необходимо добавить класс дерева комментариев. Он должен быть унаследован от абстракта `AbstractTreeView`. Тело класса можно оставить пустым, либо переопределить статический метод `makeTree`.
  
Например `CourseLessonCommentTree`:
```php
use ma3obblu\treeview\AbstractTreeView;

class CourseLessonCommentTree extends AbstractTreeView
{

}
```
