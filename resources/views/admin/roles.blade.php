@extends('admin.index')

@section('content')

    @if(session('toast'))
        <script>
          $( document ).ready(function() {
            var $toastContent = $('<span>{{ session('toast') }}</span>');
            Materialize.toast($toastContent, 5000);
          });
        </script>
    @endif

<div class="container-fluid">

    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        USER TABLE
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Display name</th>
                            <th>Discription</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th></th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Display name</th>
                            <th>Discription</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th></th>

                            {{--<th></th>--}}
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>{{ $role->updated_at }}</td>
                            <td></td>

                            {{--<td><a href="{{ route('admin.users.edit',$user->id) }}" class="waves-effect waves-light btn blue"><i class="small material-icons">mode_edit</i></a></td>--}}
                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection