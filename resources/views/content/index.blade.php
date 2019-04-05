@extends('layout.master')
@section('page-css')
@endsection
@section('main-content')
    <div class="card text-left">
        <div class="card-body">
            <table class="table table-light table-hover">
                <thead>
                <tr>
                    <div class="row">
                        <div class="col-lg-1 text-center">
                            <h5>{{__(ucfirst($content))}}</h5>
                        </div>
                        @if(!isset($onlyShow))
                            <div class="col-lg-5 text-right">
                                <a href="{{URL::to($route.'/create')}}">
                                    <button class="btn btn-primary">Create</button>
                                </a>
                            </div>
                        @endif
                    </div>
                    <br>
                </tr>
                <tr class="text-center">
                    @foreach($tablefields as $field)
                        <th scope="col">{{$field['name']}}</th>
                    @endforeach
                    @if(!isset($onlyShow))
                        <th scope="col">{{__('View')}}</th>
                        <th scope="col">{{__('Edit')}}</th>
                        <th scope="col">{{__('Delete')}}</th>@endif
                </tr>
                </thead>
                <tbody>
                @foreach($dataNames as $dataName)
                    <tr class="text-center">
                        @foreach($tablefields as $field)
                            @include('form.tablefields.'.$field['type'], $field)
                        @endforeach
                        @if(!isset($onlyShow))
                            <td><a href="{{URL::to($route.'/'.$dataName->id)}}">
                                    <button class="btn btn-primary">View</button>
                                </a></td>
                            <td><a href="{{URL::to($route.'/'.$dataName->id.'/edit')}}">
                                    <button class="btn btn-warning">Edit</button>
                                </a></td>
                            <form action="{{route($route.'.destroy', $dataName->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <td>
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </td>
                            </form>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
