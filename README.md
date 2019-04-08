# yii2-treeview

[![Total Downloads](https://img.shields.io/packagist/dt/sorokinmedia/yii2-treeview.svg)](https://packagist.org/packages/sorokinmedia/yii2-treeview)

***
Sorokin.Media repository
***

Компонент позволяет строить деревья объектов для заданной сущности.

AR модель должна содержать 2 обязательных атрибута: `(int) parent_id`, `(bool) has_child`. 

В модель необходимо добавить атрибут `$level` - в БД добавлять не нужно.

AR модель, которая имеет дочернюю сущность с деревом, должна имплементировать интерфейс `TreeViewModelInterface` и реализовывать метод `getChildModels(int $parent_id)`.

AR модель, которая внутри себя имеет иерархическую структуру, должна имплементрировать интерфейс `TreeViewModelStaticInterface` и реализовывать статический метод `getChildModelsStatic(int $parent_id)`.

Пример файла основной модели (в данной случае CourseLesson), дерево строится для дочерней (в данном случае CourseLessonComment):
```php
class CourseLesson extends CourseLessonAR implements TreeViewModelInterface
{
    public $level;

    public function getChildModels(int $parent_id)
    {
        return CourseLessonComment::find()
            ->where(['lesson_id' => $this->id, 'parent_id' => $parent_id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    }
}
```

Далее необходимо добавить класс дерева комментариев. Он должен быть унаследован от абстракта `AbstractTreeView`. 

Тело класса можно оставить пустым, либо переопределить статический методы:

+ `public static function makeTree(TreeViewModelInterface $model, int $parent_id = 0, int $level = 0): array` - вернет массив моделей в иерархическом порядке
+ `public static function makeTreeArray(TreeViewModelInterface $model, int $parent_id = 0, string $level = ''): array` - вернет масси объектов {id, name} в иерархическом порядке (для селекта)
+ `public static function makeTreeStatic(string $class_name, int $parent_id = 0, int $level = 0, $filter = null): array` - вернет масси моделей в иерархическом порядке. вариант для статического использования
+ `public static function makeTreeStaticArray(string $class_name, int $parent_id = 0, string $level = ''): array` - вернет масси объектов {id, name} в иерархическом порядке (для селекта). вариант для статического использования
  
Например `CourseLessonCommentTree`:
```php
use sorokinmedia\treeview\AbstractTreeView;

class CourseLessonCommentTree extends AbstractTreeView
{

}
```

Пример файла модели, которая имеет внутри себя иерархическую структуру:
```php
class PromoCodeCategory extends AbstractPromoCodeCategory implements TreeViewModelStaticInterface
{
    public $level;

    public static function getChildModelsStatic(int $parent_id, $filter = null)
    {
        return static::find()
            ->where(['parent_id' => $parent_id])
            ->orderBy(['name' => SORT_ASC])
            ->all();
    }
}
```

Пример класса с деревом:
```php
use sorokinmedia\treeview\AbstractTreeView;

class PromoCodeCategoryTree extends AbstractTreeView
{

}
```
