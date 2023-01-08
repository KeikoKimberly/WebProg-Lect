<?php

namespace App\Http\Controllers;

use App\Models\JobLevel;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobController extends Controller
{
    public function create(){
        return view('jobs.create-jobs', [
            'jobLevels' => JobLevel::orderBy('level')->get()
        ]);
    }

    public function manage(){
        return view('jobs.manage-jobs',[
            'jobs' => Job::orderBy('id')->get()
        ]);
    }

    public function edit(Job $job){
        return view('jobs.edit',[
            'job' => $job,
            'jobLevels' => JobLevel::orderBy('level')->get()
        ]);
    }

    public function destroy(Job $job){
        $job->delete();
    }

    public function update(Request $request, Job $job){
        $this->inputValidation($request);
        $job->update([
            'company_id' => 1,
            'role' => $request->role,
            'job_level_id' => $request->level_id,
            'working_type' => $request->working_type,
            'description' => $request->job_desc,
            'requirement' => $request->requirements,
            'note' => $request->notes,
            'created_at' =>  Carbon::now(),
        ]);
    }

    public function store(Request $request){
        //ini id company masih hardcode

        $this->inputValidation($request);

        DB::table('jobs')->insert([
            'company_id' => 1,
            'role' => $request->role,
            'job_level_id' => $request->level_id,
            'working_type' => $request->working_type,
            'description' => $request->job_desc,
            'requirement' => $request->requirements,
            'note' => $request->notes,
            'created_at' =>  Carbon::now(),
        ]);
    }

    private function inputValidation($request)
    {
        $request->validate([
            'role' => 'required|string',
            'level_id' => 'required|integer',
            'working_type' => 'required|string',
            'job_desc' => 'required|string',
            'requirements' => 'required|string',
            'notes' => 'nullable|string',
        ], [
            'role.required' => "Please fill the role",
            'level_id.required' => "Please select the experience level",
            'working_type.required' => "Please select the working type",
            'job_desc.required' => "Please fill the description",
            'requirements.required' => "Please fill the requirement",
        ]);
    }
}
