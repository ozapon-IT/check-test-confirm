<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tell',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // フルネームのアクセサ
    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }

    // 性別のテキスト表示用アクセサ
    public function getGenderTextAttribute()
    {
        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];

        return $genders[$this->gender] ?? '不明';
    }

        // 性別のミューテータ
    public function setGenderAttribute($value)
    {
        $genderMap = [
            'male' => 1,
            'female' => 2,
            'other' => 3,
        ];

        $this->attributes['gender'] = $genderMap[$value] ?? null;
    }

    // ------------------------------
    // 以下、スコープの追加
    // ------------------------------

    // キーワード検索用のスコープ
    public function scopeKeywordFilter(Builder $query, $keyword)
    {
        if (!empty($keyword)) {
            $keywordLower = mb_strtolower(trim($keyword), 'UTF-8');
            $query->where(function ($q) use ($keywordLower) {
                // 完全一致検索
                $q->whereRaw('LOWER(CONCAT(first_name, " ", last_name)) = ?', [$keywordLower])
                ->orWhereRaw('LOWER(CONCAT(last_name, " ", first_name)) = ?', [$keywordLower])
                ->orWhereRaw('LOWER(CONCAT(first_name, last_name)) = ?', [$keywordLower])
                ->orWhereRaw('LOWER(CONCAT(last_name, first_name)) = ?', [$keywordLower])
                ->orWhereRaw('LOWER(email) = ?', [$keywordLower])
                // 部分一致検索
                ->orWhere(DB::raw('LOWER(first_name)'), 'LIKE', '%' . $keywordLower . '%')
                ->orWhere(DB::raw('LOWER(last_name)'), 'LIKE', '%' . $keywordLower . '%')
                ->orWhere(DB::raw('LOWER(email)'), 'LIKE', '%' . $keywordLower . '%')
                // フルネームに対する部分一致検索
                ->orWhereRaw('LOWER(CONCAT(first_name, " ", last_name)) LIKE ?', ['%' . $keywordLower . '%'])
                ->orWhereRaw('LOWER(CONCAT(last_name, " ", first_name)) LIKE ?', ['%' . $keywordLower . '%'])
                ->orWhereRaw('LOWER(CONCAT(first_name, last_name)) LIKE ?', ['%' . $keywordLower . '%'])
                ->orWhereRaw('LOWER(CONCAT(last_name, first_name)) LIKE ?', ['%' . $keywordLower . '%']);
            });
        }
    }

    // 性別フィルタリング用のスコープ
    public function scopeGenderFilter(Builder $query, $gender)
    {
        if (!empty($gender) && $gender !== 'all') {
            $query->where('gender', $gender);
        }
    }

    // お問い合わせ種類フィルタリング用のスコープ
    public function scopeCategoryFilter(Builder $query, $category)
    {
        if (!empty($category)) {
            $query->where('category_id', $category);
        }
    }

    // 日付フィルタリング用のスコープ
    public function scopeDateFilter(Builder $query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
    }
}