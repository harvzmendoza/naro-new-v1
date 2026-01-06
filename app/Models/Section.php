<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'volume_name',
        'book_name',
        'user_id',
        'issuance_from',
        'issuance_to',
        'hash',
    ];

    /**
     * Get the user that owns the section.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
