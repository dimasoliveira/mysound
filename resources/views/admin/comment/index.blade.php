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
                        COMMENTS TABLE
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
                            <th>ID</th>
                            <th>Text</th>
                            <th>Placed by</th>
                            <th>On Post</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Text</th>
                            <th>Placed by</th>
                            <th>On Post</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>

                        @foreach($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->text }}</td>
                            <td><a href="{{ route('profile.show',$comment->user->slug)}}">{{ $comment->user->username }}</a></td>
                            <td><a href="{{ route('audio.show',[$comment->user->slug, $comment->audio->id]) }}">{{ $comment->audio->title }}</a></td>
                            <td>{{ $comment->created_at }}</td>

                            <td>{!! Form::open(['method' => 'DELETE','route' => ['comment.destroy', $comment->id]]) !!}
                                {{  Form::submit('DELETE')}}
                                {!! Form::close() !!}
                            </td>
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