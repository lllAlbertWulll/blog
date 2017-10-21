<?php
/**
 * Created by PhpStorm.
 * User: GeGe WU
 * Date: 2017/8/28
 * Time: 下午 4:06
 */

namespace App\Repositories;


use App\Blog;
use App\Category;
use App\User;

class BlogRepository
{
    public function createBlog(array $attributes) {
        return Blog::create($attributes);
    }

    public function deleteById($id) {
        return Blog::destroy($id);
    }

    public function findSingleById($id) {
        return Blog::find($id);
    }

    public function findSingleByIdWithCategories($id) {
        return Blog::where('id', $id)->with('categories')->first();
    }

    public function findAllByTime(){
        return Blog::latest()->get();
    }

    public function articleIncrement($id) {
        return User::find($id)->increment('articles_count');
    }

    public function normalizeCategory($categories)
    {
        return collect($categories)->map(function ($category) {
            if (is_numeric($category)) {
                Category::find($category)->increment('blogs_count');
                return (int)$category;
            }
            $newCategory = Category::create(['name' => $category, 'blogs_count' => 1]);
            return $newCategory->id;
        })->toArray();
    }
}