<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BulletinController extends Controller
{
    public function index(Request $request): View
    {
        $sections = Section::withCount('documents')
            ->orderByDesc('volume_name')
            ->orderBy('id', 'asc')
            ->get();

        $sectionsByVolume = $sections->groupBy('volume_name');

        /** @var \App\Models\Section|null $currentSection */
        $currentSection = null;

        if ($request->filled('section')) {
            $currentSection = $sections->firstWhere('id', (int) $request->get('section'));
        }

        if (! $currentSection) {
            $currentSection = $sections->first();
        }

        $sort = $request->get('sort', 'page');

        $documentsQuery = Document::with(['agency', 'issuanceType'])
            ->where('section_id', optional($currentSection)->id);

        switch ($sort) {
            case 'date_desc':
                $documentsQuery->orderByRaw('COALESCE(date_filed, created_at) DESC');
                break;
            case 'date_asc':
                $documentsQuery->orderByRaw('COALESCE(date_filed, created_at) ASC');
                break;
            case 'agency':
                $documentsQuery->join('agencies', 'documents.agency_id', '=', 'agencies.id')
                    ->orderBy('agencies.name')
                    ->select('documents.*');
                break;
            default:
                $documentsQuery->orderByRaw('COALESCE(date_filed, created_at) DESC');
                break;
        }

        $documents = $documentsQuery->paginate(10)->withQueryString();

        return view('bulletins', [
            'sectionsByVolume' => $sectionsByVolume,
            'currentSection' => $currentSection,
            'documents' => $documents,
            'sort' => $sort,
        ]);
    }
}


