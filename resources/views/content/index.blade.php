@extends('layout.master')
@section('page-css')
@endsection
@section('content')
    <div class="card text-left">
        <div class="card-body">
            <table class="table table-light table-hover">
                <thead>
                <tr>
                    <div class="row">
                        <div id="search_result" class="text-center col-lg-6">
                            <form action="{{url('admin/'.auth()->id().'/'.$content.'')}}" method="get">
                                <div class="input-group" id="search_block">
                                    <input type="search" name="search" placeholder="Search users" id="search_bar"
                                           class="appearance-none form-control form-input w-search pl-search">
                                    <button class="btn btn" id="searchBtn"><i class="i-Magnifi-Glass1"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-1 text-center">
                            <h5>{{__(ucfirst($content))}}</h5>
                        </div>
                        <div class="col-lg-5 text-right">
                            <button class="crud-button  col-sm-2 MainBtn" id="multiDelete" data-content="{{$content}}"
                                    data-name="Multi Delete"
                                    data-action="mdelpage" data-toggle="modal" data-target="#crud-modal">Delete
                            </button>
                            <button class="crud-button m-1 col-sm-2 MainBtn" id="create" data-content="{{$content}}"
                                    data-name="Create"
                                    data-action="createpage" data-toggle="modal" data-target="#crud-modal">Create
                            </button>
                        </div>
                    </div>
                    <br>
                </tr>
                <tr class="text-center">
                    @foreach($tablefields as $field)
                        <th scope="col">{{$field['name']}}</th>
                    @endforeach
                    <th scope="col">{{__('View')}}</th>
                    <th scope="col">{{__('Edit')}}</th>
                    <th scope="col">{{__('Delete')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataNames as $dataName)
                    <tr class="text-center">
                        @foreach($tablefields as $field)
                            @include('admin.form.tablefields.'.$field['type'], $field)
                        @endforeach
                        <td>
                            <button class="btn btn-primary  crud-button" data-content="{{$content}}"
                                    data-uid="{{$dataName->id}}" data-name="View {{$content}}" data-action="view"
                                    data-toggle="modal" data-target="#crud-modal">
                                <i class="nav-icon i-Eye-Visible "></i>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-success crud-button" data-content="{{$content}}"
                                    data-uid="{{$dataName->id}}" data-name="Edit {{$content}}"
                                    data-action="editpage" data-toggle="modal" data-target="#crud-modal">
                                <i class="nav-icon i-Pen-2 "></i>
                            </button>
                        </td>
                        <td>
                            <button data-content="{{$content}}"
                                    data-uid="{{$dataName->id}}"
                                    data-action="deletepage" data-toggle="modal" data-target="#crud-modal"
                                    class="btn btn-danger crud-button" data-name="Delete {{$content}}">
                                <i class="nav-icon i-Close-Window"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript"
            src="{{ \Illuminate\Support\Facades\URL::asset('js/admin/adminModal.js') }}"></script>
    </body>
@endsection
