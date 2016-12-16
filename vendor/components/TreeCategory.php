<?php
namespace vendor\components;
use app\models\Category;
class TreeCategory
{
        public static function tree_builder()
        {
                $categories = Category::getListCategory();

                $tree = [];
                foreach ($categories as $id => &$node) {
                        if (!$node['parent'])
                                $tree[$id] = &$node;
                        else
                                $categories[$node['parent']]['childs'][$node['id']] = &$node;
                }
                $branch = TreeCategory::categories_to_string($tree);
                return $branch;
        }
        /**
         * Получение массива категорий
         **/

        /*protected function get_cat()
        {
            global $connection;
            $query = "SELECT * FROM category";
            $res = mysqli_query($connection, $query);
            $arr_cat = array();
            while ($row = mysqli_fetch_assoc($res)) {
                $arr_cat[$row['id']] = $row;
            }
            return $arr_cat;
        }*/
        /**
         * Дерево в строку HTML
         **/
        public function categories_to_string($data)
        {
                foreach ($data as $item) {
                        $line .= TreeCategory::categories_to_template($item);
                }
                return $line;
        }
        /**
         * Шаблон вывода категорий
         **/
        public function categories_to_template($category)
        {
                ob_start();
                include 'category_template.php';
                return ob_get_clean();
        }
}