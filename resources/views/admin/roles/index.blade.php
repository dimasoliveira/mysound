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
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary waves-effect right" role="button">Add Role</a>
                    <h2>
                        ROLE TABLE
                    </h2>

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
                            <td>{{ date_format($role->created_at ,"d-m-Y") }}</td>
                            <td>{{ date_format($role->updated_at ,"d-m-Y") }}</td>

                            <td><a href="{{ route('admin.role.edit',$role->id) }}">Edit</a></td>

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