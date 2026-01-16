<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use App\Models\Document;
use App\Models\Section;

class PdfController extends Controller
{
    public function __invoke(Section $section, Request $request)
    {
        $documents = Document::join('sections', 'documents.section_id', '=', 'sections.id')
                ->where('sections.hash', '=', $request->hash)
                ->where('publish', True)
                ->select('documents.*')
                ->get()->sortBy('agency.name');

        $bulletin = Section::where('sections.hash', '=', $request->hash)
                ->first();

        
        return Pdf::loadView('pdf', compact('documents', 'bulletin'))
            ->stream($request->hash.'.pdf');
    }
}
