<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\Document;
use App\Models\IssuanceType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get top 4 agencies with document counts
        $agencies = Agency::withCount('documents')
            ->orderBy('documents_count', 'desc')
            ->limit(4)
            ->get();

        // Get recent documents from the last 7 days
        $recentDocuments = Document::with(['agency', 'issuanceType'])
            ->where(function ($query) {
                $query->whereDate('date_filed', '>=', now()->subDays(7))
                    ->orWhere('created_at', '>=', now()->subDays(7));
            })
            ->orderByRaw('COALESCE(date_filed, created_at) DESC')
            ->limit(5)
            ->get();

        // Get available years for dropdown
        $availableYears = Document::selectRaw('DISTINCT YEAR(COALESCE(date_filed, created_at)) as year')
            ->whereNotNull('date_filed')
            ->orWhereNotNull('created_at')
            ->pluck('year')
            ->filter()
            ->sortDesc()
            ->toArray();

        return view('welcome', [
            'agencies' => $agencies,
            'recentDocuments' => $recentDocuments,
            'availableYears' => $availableYears,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $referenceNo = $request->get('reference_no', '');
        $agencyId = $request->get('agency_id');
        $issuanceTypeIds = $request->get('issuance_type_id', []);
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $year = $request->get('year');
        $sort = $request->get('sort', 'relevance');
        $perPage = 10;

        // Build query
        $documentsQuery = Document::with(['agency', 'issuanceType']);

        // Search by keyword
        if ($query) {
            $documentsQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('subject', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            });
        }

        // Search by reference number
        if ($referenceNo) {
            $documentsQuery->where(function ($q) use ($referenceNo) {
                $q->where('issuance_no', 'like', "%{$referenceNo}%")
                    ->orWhere('onar_no', 'like', "%{$referenceNo}%");
            });
        }

        // Filter by agency
        if ($agencyId) {
            $documentsQuery->where('agency_id', $agencyId);
        }

        // Filter by issuance types
        if (! empty($issuanceTypeIds) && is_array($issuanceTypeIds)) {
            $documentsQuery->whereIn('issuance_type_id', $issuanceTypeIds);
        }

        // Filter by year
        if ($year) {
            $documentsQuery->where(function ($q) use ($year) {
                $q->whereYear('created_at', $year)
                    ->orWhere('doc_year', $year);
            });
        }

        // Filter by date range
        if ($dateFrom) {
            $documentsQuery->whereDate('date_filed', '>=', $dateFrom);
        }
        if ($dateTo) {
            $documentsQuery->whereDate('date_filed', '<=', $dateTo);
        }

        // Sort
        switch ($sort) {
            case 'date_newest':
                $documentsQuery->orderByRaw('COALESCE(date_filed, created_at) DESC');
                break;
            case 'date_oldest':
                $documentsQuery->orderByRaw('COALESCE(date_filed, created_at) ASC');
                break;
            case 'title_az':
                $documentsQuery->orderBy('title', 'asc');
                break;
            default: // relevance
                if ($query) {
                    $documentsQuery->orderByRaw('CASE
                        WHEN title LIKE ? THEN 1
                        WHEN issuance_no LIKE ? THEN 2
                        WHEN subject LIKE ? THEN 3
                        ELSE 4
                    END', ["%{$query}%", "%{$query}%", "%{$query}%"]);
                }
                $documentsQuery->orderByRaw('COALESCE(date_filed, created_at) DESC');
                break;
        }

        // Paginate
        $documents = $documentsQuery->paginate($perPage)->withQueryString();

        // Get filter options
        $agencies = Agency::orderBy('name')->get();
        $issuanceTypes = IssuanceType::orderBy('name')->get();
        $availableYears = Document::selectRaw('DISTINCT YEAR(COALESCE(date_filed, created_at)) as year')
            ->whereNotNull('date_filed')
            ->orWhereNotNull('created_at')
            ->pluck('year')
            ->filter()
            ->sortDesc()
            ->toArray();

        return view('search', [
            'documents' => $documents,
            'agencies' => $agencies,
            'issuanceTypes' => $issuanceTypes,
            'query' => $query,
            'referenceNo' => $referenceNo,
            'selectedAgencyId' => $agencyId,
            'selectedIssuanceTypeIds' => $issuanceTypeIds,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'year' => $year,
            'sort' => $sort,
            'availableYears' => $availableYears,
        ]);
    }

    public function show(Document $document): View
    {
        $document->load(['agency', 'issuanceType']);

        // Get related documents from the same agency
        $relatedDocuments = Document::with(['agency', 'issuanceType'])
            ->where('agency_id', $document->agency_id)
            ->where('id', '!=', $document->id)
            ->orderByRaw('COALESCE(date_filed, created_at) DESC')
            ->limit(5)
            ->get();

        return view('documents.show', [
            'document' => $document,
            'relatedDocuments' => $relatedDocuments,
        ]);
    }

    public function agencies(Request $request): View
    {
        $query = $request->get('q', '');
        $category = $request->get('category', '');
        $letter = $request->get('letter', '');
        $sort = $request->get('sort', 'name_az');
        $perPage = 12;

        // Build query
        $agenciesQuery = Agency::withCount('documents');

        // Search by name or code
        if ($query) {
            $agenciesQuery->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('agency_code', 'like', "%{$query}%");
            });
        }

        // Filter by first letter
        if ($letter && $letter !== 'all') {
            $agenciesQuery->where('name', 'like', "{$letter}%");
        }

        // Sort
        switch ($sort) {
            case 'issuance_count':
                $agenciesQuery->orderBy('documents_count', 'desc');
                break;
            case 'recently_updated':
                $agenciesQuery->orderBy('updated_at', 'desc');
                break;
            default: // name_az
                $agenciesQuery->orderBy('name', 'asc');
                break;
        }

        // Paginate
        $agencies = $agenciesQuery->paginate($perPage)->withQueryString();

        // Get total count for display
        $totalAgencies = Agency::count();

        return view('agencies', [
            'agencies' => $agencies,
            'totalAgencies' => $totalAgencies,
            'query' => $query,
            'category' => $category,
            'letter' => $letter,
            'sort' => $sort,
        ]);
    }
}
