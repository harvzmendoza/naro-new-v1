<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    /** @use HasFactory<\Database\Factories\DocumentFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'issuance_no',
        'title',
        'onar_no',
        'signatory',
        'doc_date',
        'doc_year',
        'publish',
        'content',
        'committee',
        'councilor',
        'author',
        'division_id',
        'members_of_division',
        'ponente',
        'subject',
        'parties',
        'case_status',
        'issuance_type_id',
        'agency_id',
        'section_id',
        'file',
        'date_filed',
        'tags',
    ];

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }

    public function issuanceType(): BelongsTo
    {
        return $this->belongsTo(IssuanceType::class);
    }
}
