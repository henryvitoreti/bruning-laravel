<?php

namespace App\Models;

use App\Rules\DocumentRule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Employee extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'code',
        'name',
        'nickname',
        'mother_name',
        'father_name',
        'document',
        'birth_date',
        'role',
    ];

    protected $casts = [
        'code' => 'string',
        'name' => 'string',
        'nickname' => 'string',
        'mother_name' => 'string',
        'father_name' => 'string',
        'document' => 'string',
        'birth_date' => 'date',
        'role' => 'string',
    ];

    /**
     * @param Request $request
     * @return string[]
     */
    public static function rules(Request $request): array
    {
        return [
            'code' => 'required|max:4',
            'name' => 'required|max:150',
            'nickname' => 'required|max:100',
            'mother_name' => 'required|max:150',
            'father_name' => 'required|max:150',
            'document' => [
                'required',
                'max:11',
                'unique:employees,document,'. $request->id ?? 'NULL' . ',id,deleted_at,NULL',
                new DocumentRule
            ],
            'birth_date' => 'required|date',
            'role' => 'required|max:100',
        ];
    }

    public function getBirthDateFormattedAttribute($value): string
    {
        return $this->birth_date->format('d/m/Y');
    }
}
