@extends('layout.master')
@section('main-content')
    <div>
        <div>
            <table>
                <thead>
                <tr>
                    <div>
                        <div>
                            <a href="{{URL::to('/')}}">
                                <button class="btn-primary">Home</button>
                            </a>
                        </div>
                        <div>
                            <h1>{{__(ucfirst($content))}}</h1>
                        </div>
                        @if(!isset($onlyShow))
                            <div>
                                <a href="{{URL::to($route.'/create')}}">
                                    <button class="btn btn-primary">Create</button>
                                </a>
                            </div>
                        @endif
                    </div>
                </tr>
                <tr>
                    @foreach($tablefields as $field)
                        <th>{{$field['name']}}</th>
                    @endforeach
                    @if(isset($onlyShow))
                        <th>{{__('User Websites')}}</th>
                    @endif
                    @if(!isset($onlyShow))
                        <th>{{__('View')}}</th>
                        <th>{{__('Edit')}}</th>
                        <th>{{__('Delete')}}</th>@endif
                </tr>
                </thead>
                <tbody>
                @foreach($dataNames as $dataName)
                    <tr>
                        @foreach($tablefields as $field)
                            @include('form.tablefields.'.$field['type'], $field)
                        @endforeach
                        @if(isset($onlyShow))
                            <td><a href="{{URL::to('/website')}}">
                                    <button class="btn btn-dark">Websites</button>
                                </a></td>
                        @endif
                        @if(!isset($onlyShow))
                            <td><a href="{{URL::to($route.'/'.$dataName->id)}}">
                                    <button class="btn btn-dark">View</button>
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
