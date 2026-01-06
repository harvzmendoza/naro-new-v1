<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    /** @use HasFactory<\Database\Factories\ApprovalFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'section_id',
        'status',
        'remarks',
    ];

    /**
     * Get the user that owns the approval.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the section that owns the approval.
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
