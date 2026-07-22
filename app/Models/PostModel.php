<?php

namespace App\Models;

class PostModel extends BaseModel
{
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'title', 'slug', 'content', 'excerpt', 'image', 'category_id', 'user_id',
        'type', 'status', 'is_featured', 'is_headline', 'views',
        'meta_title', 'meta_description', 'meta_keywords', 'og_image', 'published_at'
    ];
    protected $beforeInsert     = ['setSlug', 'setUserId'];
    protected $beforeUpdate     = ['setSlug'];

    protected $validationRules = [
        'title'   => 'required|min_length[3]|max_length[255]',
        'content' => 'required',
        'type'    => 'required|in_list[berita,pengumuman,agenda,prestasi,halaman]',
        'status'  => 'required|in_list[draft,published,trash]',
        'user_id' => 'required|integer',
    ];

    public function getPublished(string $type = null, int $limit = 10, int $offset = 0)
    {
        $builder = $this->select('posts.*, users.full_name AS author, categories.name AS category_name')
            ->join('users', 'users.id = posts.user_id')
            ->join('categories', 'categories.id = posts.category_id', 'left')
            ->where('posts.status', 'published')
            ->orderBy('posts.published_at', 'DESC');

        if ($type) {
            $builder->where('posts.type', $type);
        }

        return $builder->findAll($limit, $offset);
    }

    public function getBySlug(string $slug)
    {
        return $this->select('posts.*, users.full_name AS author, categories.name AS category_name')
            ->join('users', 'users.id = posts.user_id')
            ->join('categories', 'categories.id = posts.category_id', 'left')
            ->where('posts.slug', $slug)
            ->first();
    }

    public function incrementViews(int $id): void
    {
        $this->where('id', $id)->set('views', 'views + 1', false)->update();
    }
}
