@extends('layout/main')
@section('title', "Job Vacancies")
@section('container')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="row justify-content-center align-items-center">

        <div class="col-12">
            <form id="search-jobs" action="{{route('job.indexWithFilter')}}" method="GET">
                <div class="row align-items-center justify-content-between">
                    <div class="col-2 text-center p-0">
                        <input class="form-control" placeholder="Role" aria-label="role" name="role" value="{{$role}}">
                    </div>
                    <div class="col-2 text-center p-0">
                        <input class="form-control" placeholder="Company" aria-label="company" name="company" value="{{$company}}">
                    </div>
                    <div class="col-2 text-center p-0">
                        <input class="form-control" placeholder="Location" aria-label="location" name="location" value="{{$location}}">
                    </div>
                    <div class="col-2 text-center p-0">
                        <select class="form-select" name="level_id" id="level_id">
                            <option selected value="">Experience Level</option>
                            @foreach ($jobLevels as $jobLevel)
                                <option {{ $level_id == $jobLevel->id ? "selected" : "" }} value= {{$jobLevel->id}}>{{$jobLevel->level}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 text-center p-0">
                        <select class="form-select" name="working_type" id="working_type">
                            <option selected value="">Working Type</option>
                            <option {{ $working_type == "Onsite" ? "selected" : "" }} value="Onsite">Onsite</option>
                            <option {{ $working_type == "Remote" ? "selected" : "" }} value="Remote">Remote</option>
                            <option {{ $working_type == "Hybrid" ? "selected" : "" }} value="Hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="col-1 text-center p-0">
                        <button type="submit" class="btn btn-primary w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12 mt-2 p-0">
            <hr>
        </div>

        <div class="col-12 mt-2 p-0">
            <div class="row align-items-center justify-content-start mt-2">
               @foreach ($jobs as $job)
                    <div class="col-3 mt-2 p-2">
                        <div class="card p-2">
                            <div class="row align-items-center justify-content-start">
                                <div class="col-12 " style="border: 2px solid black">
                                    {{-- ini image companynya --}}
                                </div>
                                <div class="col-12">
                                    <h4 class="text-truncate">{{$job->role}}</h4>
                                </div>
                                <div class="col-12">
                                    <p class="text-truncate">{{$job->company->name}}</p>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-outline-primary w-100" href="#" target="_blank">Company</a>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-outline-primary w-100" data-bs-target="#delete{{ $job->id }}" data-bs-toggle="modal"
                                        href="#">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
               @endforeach
            </div>
        </div>
    </div>

    @foreach($jobs as $data )
        <div class="modal fade show pr-0" style="z-index: 9999;" id="delete{{ $data->id }}" tabindex="-1" role="dialog"
            aria-labelledby="alertTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-20 border-0">
                    <div class="modal-header border-bottom-0">
                        <h5 class="fw-bold">id: # {{$data->id}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-center justify-content-center">
                            <h4 class="text-center">Are you sure you want to delete job as {{$data->role}} [{{$data->jobLevel->level}}] ?</h4>
                            <div class="col-12 text-center">
                                <form action="{{route('job.destroy', $data->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-2 me-3 my-3 px-5 rounded-pill"
                                        data-bs-dismiss="modal">
                                        No
                                    </button>
                                    <button type="submit" class="btn btn-danger my-3 px-5 rounded-pill text-white">Yes</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
