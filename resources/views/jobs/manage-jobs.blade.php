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
            <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col" class="align-middle text-center">ID</th>
                    <th scope="col" class="align-middle text-center">Experience Level</th>
                    <th scope="col" class="align-middle text-center">Role</th>
                    <th scope="col" class="align-middle text-center">Applicants</th>
                    <th scope="col" class="align-middle text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <td class="align-middle text-center">{{$job->id}}</td>
                        <td class="align-middle text-center">{{$job->jobLevel->level}}</td>
                        <td class="align-middle text-center">{{$job->role}}</td>
                        <td class="align-middle text-center">Ini nanti jumlah applicants</td>
                        <td class="align-middle ">
                            <div class="btn-toolbar flex-nowrap justify-content-center align-items-center">
                                <div class="btn-group me-2">
                                    <a class="btn btn-sm btn-warning text-white" href="{{route('job.edit', $job->id)}}" target="_blank" title="Edit">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="btn-group me-2">
                                    <button class="btn btn-sm btn-danger text-white"
                                            data-bs-target="#delete{{ $job->id }}" data-bs-toggle="modal" title="Move to Recycle Bin">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
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

