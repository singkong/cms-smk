<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowCallbacks   = true;
    protected $returnType       = 'object';

    protected function setSlug(array $data): array
    {
        if (isset($data['data']['title']) && empty($data['data']['slug'])) {
            $data['data']['slug'] = mb_url_title($data['data']['title'], '-', true);
        }
        if (isset($data['data']['name']) && empty($data['data']['slug'])) {
            $data['data']['slug'] = mb_url_title($data['data']['name'], '-', true);
        }
        return $data;
    }

    protected function setUserId(array $data): array
    {
        if (isset($data['data']['user_id']) && $data['data']['user_id'] === null) {
            $userId = session()->get('id');
            if ($userId) {
                $data['data']['user_id'] = $userId;
            }
        }
        return $data;
    }

    public function getPaginated(int $perPage = 20, array $select = ['*'], array $conditions = [], string $orderBy = 'id DESC')
    {
        $builder = $this->select(implode(',', $select));
        foreach ($conditions as $key => $value) {
            $builder->where($key, $value);
        }
        return $builder->orderBy($orderBy)->paginate($perPage);
    }
}
