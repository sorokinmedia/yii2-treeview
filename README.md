# yii2-treeview

***
Sorokin.Media repository
***

Компонент позволяет строить деревья объектов для заданной сущности.

AR модель должна содержать 2 обязательных атрибута: `(int) parent_id`, `(bool) has_child`.

AR модель, которая имеет дочернюю сущность с деревом, должна имплементировать интерфейс `TreeViewModelInterface` и реализовывать метод `getChildModels(int $parent_id)`.
AR модель, которая внутри себя имеет иерархическую структуру, должна имплементрировать интерфейс `TreeViewModelStaticInterface` и реализовывать статический метод `getChildModelsStatic(int $parent_id)`.

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

Далее необходимо добавить класс дерева комментариев. Он должен быть унаследован от абстракта `AbstractTreeView`. Тело класса можно оставить пустым, либо переопределить статический методы `makeTree` и `makeTreeStatic`.
  
Например `CourseLessonCommentTree`:
```php
use sorokinmedia\treeview\AbstractTreeView;

class CourseLessonCommentTree extends AbstractTreeView
{

}
```
