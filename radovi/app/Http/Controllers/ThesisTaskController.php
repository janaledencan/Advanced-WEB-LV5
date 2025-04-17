<?php

namespace App\Http\Controllers;

use App\Models\ThesisTask;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ThesisTaskController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(ThesisTask::class, 'thesisTask', [
            'except' => ['available', 'apply', 'applications', 'approve']
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thesisTasks = ThesisTask::where('teacher_id', Auth::id())->get();

        return view('thesis-tasks.index', ['thesisTasks' => $thesisTasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('thesis-tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_hr' => 'required|string|max:255',
            'task' => 'required|string',
            'study_type' => 'required|in:professional,undergraduate,graduate',
        ]);

        $thesisTask = new ThesisTask();
        $thesisTask->teacher_id = Auth::id();
        $thesisTask->title_en = $request->title_en;
        $thesisTask->title_hr = $request->title_hr;
        $thesisTask->task = $request->task;
        $thesisTask->study_type = $request->study_type;
        $thesisTask->save();


        return redirect()->route('thesis-tasks.index')
            ->with('success', __('messages.thesis_task_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ThesisTask $thesisTask)
    {
        return view('thesis-tasks.show', compact('thesisTask'));
    }



    public function available()
    {
        $thesisTasks = ThesisTask::with(['teacher', 'applicants'])->get();
        return view('thesis-tasks.available', compact('thesisTasks'));
    }


    public function apply(ThesisTask $task)
    {
        $task->applicants()->attach(Auth::id());
        return redirect()->back()->with('success', __('messages.application_submitted'));
    }


    public function applications()
    {
        $myThesisTasks = ThesisTask::where('teacher_id', Auth::id())
            ->with(['applicants' => function ($query) {
                $query->withPivot('approved');
            }])
            ->get();

        return view('thesis-tasks.applications', compact('myThesisTasks'));
    }


    public function approve(ThesisTask $task, User $student)
    {
        $this->authorize('manage', $task);

        // Check if a student is already approved for this thesis
        $alreadyApproved = $task->applicants()->wherePivot('approved', true)->exists();
        if ($alreadyApproved) {
            return back()->with('error', __('messages.already_approved_for_this_thesis'));
        }

        // Approve the selected student
        $task->applicants()->updateExistingPivot($student->id, ['approved' => true]);
        return back()->with('success', __('messages.application_approved'));
    }
}
