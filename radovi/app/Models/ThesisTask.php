<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ThesisTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'title_en',
        'title_hr',
        'task',
        'study_type',
    ];


    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function applicants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'thesis_task_user')
            ->withPivot('approved')
            ->withTimestamps();
    }

    public function getTranslation($attribute, $locale, $default = '')
    {
        if (isset($this->$attribute) && isset($this->$attribute[$locale])) {
            return $this->$attribute[$locale];
        }

        return $default;
    }
}
