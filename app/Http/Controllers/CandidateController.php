<?php

namespace App\Http\Controllers;

use App\DataTables\AppliedCandidateDataTable;
use App\DataTables\ShortlistedCandidatesDataTable;
use App\Models\CandidateDetail;
use App\Models\EmployerDetail;
use App\Models\ShortlistedCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index()
    {
        $perPage = 5;
        $candidates = CandidateDetail::paginate($perPage);
        return view('candidate.index', compact('candidates'));
    }
    public function candidateDetails(AppliedCandidateDataTable $datatable)
    {
        $employerId = Auth::id();
        $jobAppliedCandidates = CandidateDetail::whereHas('jobs', function ($query) use ($employerId) {
            $query->where('employer_id', $employerId);
        })->with(['jobs' => function ($query) use ($employerId) {
            $query->where('employer_id', $employerId);
        }])->get();
        return $datatable->render('candidate.applied-candidates', compact('jobAppliedCandidates'));
    }

    public function show($id)
    {
        $candidates = CandidateDetail::find($id);
        return view('candidate.show', compact('candidates'));
    }

    public function candidateShow()
    {
        return view('candidate.candidate_details');
    }

    public function create()
    {
        return view('candidate.create');
    }

    public function edit($id)
    {
        $candidate = CandidateDetail::where('user_id', $id)->first();

        return view('candidate.edit', compact('candidate'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'age' => 'required|integer',
            'gender' => 'required|in:male,female,other',
            'experience' => 'required|integer',
            'language' => 'nullable|string|max:255',
            'qualification' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'description' => 'required|string',
            'professional_skill' => 'required|string',
            'software_skill' => 'required|string',
            'page' => 'nullable',
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('user_profile')) {
            $user_profile = CandidateDetail::where('user_id', $id)->value('user_profile');
            if (!empty($user_profile)) {
                Storage::delete('public/storage/user_profile/' . $user_profile);
            }
            $imagePath = $request->file('user_profile')->store('storage/user_profile', 'public');
            $imageName = basename($imagePath);

            $data['user_profile'] = $imageName;
        }
        if ($request->hasFile('resume')) {
            $existingResume = CandidateDetail::where('user_id', $id)->value('resume');
            if (!empty($existingResume)) {
                Storage::delete('public/storage/resumes/' . $existingResume);
            }

            $resumePath = $request->file('resume')->store('storage/resumes', 'public');

            $resumeName = basename($resumePath);

            $data['resume'] = $resumeName;

        }
        CandidateDetail::updateOrCreate(['user_id' => $id], $data);

        return redirect()->route('home')->with('success', 'Candidate updated successfully');
    }
    public function downloadResume($id)
    {
        $candidate = CandidateDetail::findOrFail($id);

        if (!empty($candidate->resume)) {
            $path = public_path('storage/resumes/' . $candidate->resume);
            return response()->download($path, 'resume_' . $candidate->id . '.' . pathinfo($path, PATHINFO_EXTENSION));
        }
        return response()->json([
            'error' => 'File not found',
        ]);
    }

    public function destroy($id)
    {
        $candidates = CandidateDetail::find($id);
        $candidates->delete();
    }

    public function showCandidateDetails($id)
    {
        if (Auth::user()) {
            $jobAppliedCandidate = CandidateDetail::findOrFail($id);
            return view('candidate.candidate_details', compact('jobAppliedCandidate'));
        } else {
            notify()->success('Please login first');

            return redirect()->back();
        }
    }

    public function updateShortlist($candidateDetailsId)
    {
        try {
            $employerId = EmployerDetail::where("user_id", Auth::user()->id)->value("id");

            $shortlistedCandidate = ShortlistedCandidate::firstOrCreate(
                [
                    'employer_details_id' => $employerId,
                    'candidate_details_id' => $candidateDetailsId,
                ],
                ['shortlisted' => 1]
            );

            $shortlistedCandidate->update(['shortlisted' => ($shortlistedCandidate->shortlisted == 1) ? 0 : 1]);

            if ($shortlistedCandidate->shortlisted == 1) {

                return response()->json(['status' => 'shortlisted']);
            } else {

                return response()->json(['status' => 'unshortlisted']);
            }
        } catch (\Exception $e) {
            \Log::error('Error shortlisting candidate: ' . $e->getMessage());
            \Log::error($e->getTraceAsString()); // Log the complete exception trace
            return response()->json(['error' => 'Error shortlisting candidate']);
        }
    }

    public function candidateShortlisted(ShortlistedCandidatesDataTable $dataTable)
    {
        return $dataTable->render('candidate.shortlist-candidates');
    }
}
