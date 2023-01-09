@extends('layout/main')
@section('title', "Create New Job")
@section('container')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row justify-content-center align-items-center">
        <div class="col-10">
            <a href="{{ URL::previous() }}" class="btn btn-primary btn-md"><- Back</a>
            <div class="card mt-3">
                <div class="card-header">
                    Edit Job: #{{$job->id}}
                </div>
                <div class="px-3 py-3">
                    <form id="form-regist" enctype="multipart/form-data" action="{{route('job.update', $job->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group my-3">
                            <label class="mb-1" for="role">Role</label>
                            <input type="text" class="form-control" id="role" aria-describedby="role" placeholder="Enter the role here" name="role" value="{{$job->role}}" required>
                            @error('role')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <label class="mb-1" for="level_id">Experience level</label>
                            <select class="form-select level_id" name="level_id" id="level_id" required>
                                <option disabled selected value="">Select an option</option>
                                @foreach ($jobLevels as $jobLevel)
                                    <option {{ $job->job_level_id == $jobLevel->id ? "selected" : "" }} value= {{$jobLevel->id}}>{{$jobLevel->level}}</option>
                                @endforeach
                            </select>
                            @error('level')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <label class="mb-1" for="working_type">Working Type</label>
                            <select class="form-select working_type" name="working_type" id="working_type" required>
                                <option disabled selected value="">Select an option</option>
                                <option  {{ $job->working_type == "Onsite" ? "selected" : "" }} value="Onsite">Onsite</option>
                                <option  {{ $job->working_type == "Remote"  ? "selected" : "" }} value="Remote">Remote</option>
                                <option  {{ $job->working_type == "Hybrid"  ? "selected" : "" }} value="Hybrid">Hybrid</option>
                            </select>
                            @error('working_type')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <label class="mb-1" for="job_desc">Job Description</label>
                            <textarea class="form-control" cols="30" rows="7" id="job_desc" name="job_desc" required>{{{$job->description}}}</textarea>
                            @error('job_desc')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <label class="mb-1" for="requirements">Requirements</label>
                            <textarea class="form-control" cols="30" rows="7" id="requirements" name="requirements" required>{{{$job->requirement}}}</textarea>
                            @error('requirements')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group my-3">
                            <label class="mb-1" for="notes">Notes</label>
                            <textarea class="form-control" cols="30" rows="7" id="notes" name="notes" required>{{{$job->note}}}</textarea>
                            @error('notes')
                            <span style="color:red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-4 row justify-content-center align-items-center">
                            <div class="col-sm-6 col-12 my-1">
                                <button type="submit" class="btn btn-primary w-75 rounded-20">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
