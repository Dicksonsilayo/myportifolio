<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'name',
        'issuing_organization',
        'issue_date',
        'credential_url',
        'image_path',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date',
        ];
    }
}
