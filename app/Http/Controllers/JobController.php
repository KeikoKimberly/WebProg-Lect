<?php

namespace App\Http\Controllers;

use App\Models\JobLevel;
use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index(){

        return view('jobs.index-jobs', [
            'jobs' => Job::orderBy('created_at')->get(),
            'jobLevels' => JobLevel::orderBy('level')->get()
        ]);
    }

    public function indexWithFilter(Request $request){

        $firstConditionFlag = true;
        $role = "";
        $company = "";
        $location = "";
        $level_id = 0;
        $working_type = "";

        $queryString = "SELECT * FROM jobs";

        if($request->role){
            $role = $request->role;
            if($firstConditionFlag){
                $queryString = $queryString . " WHERE role LIKE '%" . $request->role . "%' ";
                $firstConditionFlag = false;
            } else {
                $queryString = $queryString . " AND role LIKE '%" . $request->role . "%' ";
            }
        }

        if($request->company){
            $company = $request->company;
            $companyIds = Company::where('name', 'like', '%'.$request->company.'%')->get()->pluck('id')->toArray();
            if($firstConditionFlag){
                $queryString = $queryString . " WHERE company_id in(" . implode(',', $companyIds) .") ";
                $firstConditionFlag = false;
            } else {
                $queryString = $queryString . " AND company_id in(" . implode(',', $companyIds) .") ";
            }
        }

        if($request->location){
            $location = $request->location;
            $companyIds = Company::where('location', 'like', '%'.$request->location.'%')->get()->pluck('id')->toArray();
            if($firstConditionFlag){
                $queryString = $queryString . " WHERE company_id in(" . implode(',', $companyIds) .") ";
                $firstConditionFlag = false;
            } else {
                $queryString = $queryString . " AND company_id in(" . implode(',', $companyIds) .") ";
            }
        }

        if($request->level_id){
            $level_id = $request->level_id;
            if($firstConditionFlag){
                $queryString = $queryString . " WHERE job_level_id LIKE '%" . $request->level_id . "%' ";
                $firstConditionFlag = false;
            } else {
                $queryString = $queryString . " AND job_level_id LIKE '%" . $request->level_id . "%' ";
            }
        }

        if($request->working_type){
            $working_type = $request->working_type;
            if($firstConditionFlag){
                $queryString = $queryString . " WHERE working_type LIKE '%" . $request->working_type . "%' ";
                $firstConditionFlag = false;
            } else {
                $queryString = $queryString . " AND working_type LIKE '%" . $request->working_type . "%' ";
            }
        }

        $queryResult = DB::select($queryString);
        $jobs = array();

        foreach($queryResult as $data){
            $model = new Job();
            $model->id = $data->id;
            $model->company_id = $data->company_id;
            $model->job_level_id = $data->job_level_id;
            $model->role = $data->role;
            $model->working_type = $data->working_type;
            $model->description = $data->description;
            $model->requirement = $data->requirement;
            $model->note = $data->note;
            $jobs[] = $model;
        }


        return view('jobs.index-jobs', [
            'jobs' => $jobs,
            'jobLevels' => JobLevel::orderBy('level')->get(),
            'role' => $role,
            'company' => $company,
            'location' => $location,
            'level_id' => $level_id,
            'working_type' => $working_type
        ]);

    }

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
        return view('jobs.edit-jobs',[
            'job' => $job,
            'jobLevels' => JobLevel::orderBy('level')->get()
        ]);
    }

    public function destroy(Job $job){
        $job->delete();
    }

    public function update(Request $request, Job $job){

        // NANTI UPDATE INI!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        if(!Auth::check){
            return "Login Dulu";
        }
        $this->inputValidation($request);
        $job->update([
            'company_id' => auth()->user()->id,
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

        // NANTI UPDATE INI!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        if(!Auth::check){
            return "Login Dulu";
        }
        $this->inputValidation($request);

        DB::table('jobs')->insert([
            'company_id' => auth()->user()->id,
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
