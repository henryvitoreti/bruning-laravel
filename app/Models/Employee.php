<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Rules\DocumentRule;
use Carbon\Carbon;
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
            'birth_date' => 'required|date|date_format:Y-m-d|before_or_equal:'.Carbon::now()->subYears(18)->format('Y-m-d'),
            'role' => 'required|max:100',
        ];
    }

    /**
     * @param Request $request
     * @return string[]
     */
    public static function messages(Request $request): array
    {
        return [
            'required' =>  'O campo é obrigatório.',
            'max' => 'O campo ultrapassou o limite de caracteres de :max.',
            'before_or_equal' => 'O campo deve ser uma data anterior ou igual a :date.',
            'unique' => 'O campo já está sendo utilizado.',
        ];
    }

    /**
     * @return string
     */
    public function getBirthDateFormattedAttribute(): string
    {
        return $this->birth_date->format('d/m/Y');
    }

    /**
     * @return string
     */
    public function getDocumentFormattedAttribute(): string
    {
        return StringHelper::formatDocument($this->document);
    }
}
