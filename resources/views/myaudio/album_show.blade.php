@extends('layouts.app')

@section('expanded-navbar')

@endsection

@section('content')



    <div class="section"></div>

    <div class="container">

        <div class="card horizontal">
            <div class="card-image">
                <img src="https://d2qqvwdwi4u972.cloudfront.net/static/img/default_album.png">

                <div>


                </div>
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <h4>{{$album->name}}</h4>
                    <h6>
                        {{implode(', ',$album->artist )}}
                        </h6>



                    <div class="row">

                        <table>
                            <thead>
                            <tr>
                                <th>Nr.</th>
                                <th>Name</th>
                                <th>Artist</th>
                                <th>Year</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($album->audio as $song)
                                <tr>
                                    <td>{{ $song->tracknumber }}</td>
                                    <td>{{ $song->title }}</td>
                                    <td>{{ $song->artist }}</td>
                                    <td>{{ $song->year }}</td>
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