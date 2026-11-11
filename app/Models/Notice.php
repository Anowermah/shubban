<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'file',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function getTitleAttribute($value)
    {
        if (is_string($value) && str_starts_with(trim($value), '{')) {
            $data = json_decode($value, true);
            if (is_array($data)) {
                $locale = app()->getLocale();
                return $data[$locale] ?? $data['bn'] ?? reset($data);
            }
        }
        return $value;
    }

    public function getDescriptionAttribute($value)
    {
        if (is_string($value) && str_starts_with(trim($value), '{')) {
            $data = json_decode($value, true);
            if (is_array($data)) {
                $locale = app()->getLocale();
                return $data[$locale] ?? $data['bn'] ?? reset($data);
            }
        }
        return $value;
    }

    public function getTranslation($attribute, $locale = null)
    {
        return $this->{$attribute} ?? '';
    }

    public static function getArchives()
    {
        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");

        if ($driver === 'sqlite') {
            return static::selectRaw("strftime('%Y', created_at) as year, strftime('%m', created_at) as month, strftime('%m', created_at) as month_name, COUNT(*) as count")
                ->groupBy('year', 'month', 'month_name')
                ->orderByDesc('year')
                ->orderByDesc('month')
                ->get();
        }

        return static::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, 
            DATE_FORMAT(created_at, "%M") as month_name, COUNT(*) as count')
            ->groupBy('year', 'month', 'month_name')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();
    }

    public function getFileExtension()
    {
        if (!$this->file) {
            return null;
        }
        return pathinfo($this->file, PATHINFO_EXTENSION);
    }

    public function isPDF()
    {
        return $this->getFileExtension() === 'pdf';
    }
}
