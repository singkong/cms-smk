<?php

namespace App\Models;

class SettingModel extends BaseModel
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['key', 'value'];
    protected $useSoftDeletes   = false;

    public function getAll(): object
    {
        $settings = $this->findAll();
        $result = [];
        foreach ($settings as $s) {
            $result[$s->key] = $s->value;
        }
        return (object) $result;
    }

    public function getByKey(string $key): ?string
    {
        $setting = $this->where('key', $key)->first();
        return $setting ? $setting->value : null;
    }

    public function setValue(string $key, ?string $value): void
    {
        $existing = $this->where('key', $key)->first();
        if ($existing) {
            $this->update($existing->id, ['value' => $value]);
        } else {
            $this->insert(['key' => $key, 'value' => $value]);
        }
    }
}
