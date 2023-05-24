@extends('layouts.dashboard')

@section('title')
    Data Master - Class Room
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Class Room List
                            </span>

                            @include('class-room.modal')
                            <div class="float-right">
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#classRoomModal">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Name</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classRooms as $classRoom)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $classRoom->name }}</td>

                                            <td>
                                                <form action="{{ route('admin.class-rooms.destroy',$classRoom->id) }}" method="POST">                                                    
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $classRooms->links() !!}
            </div>
        </div>
    </div>
@endsection
