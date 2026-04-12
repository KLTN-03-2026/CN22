<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguage extends Model
{
    protected $fillable = [
        'name',
        'version',
        'compiler_options'
    ];

    public function codeSubmit()
    {
        return $this->hashMany(CodeSubmission::class, 'language_id');
    }
}
