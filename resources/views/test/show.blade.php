@extends('layouts.admin')

@section('content')
    <div class="container my-4">
        <div class="card">
            <img class="card-img-top" style="height: 40vh; object-fit:cover" src="{{ asset('storage/' . $corso->coverImgCourses) }}" alt="{{ $corso->name }}" />
            <div class="card-body">
                <h4 class="card-title">{{ $corso->name }}</h4>
                <p class="card-text">{{ $corso->description }}</p>
                <p class="card-text"><strong>Level:</strong> {{ ucfirst($corso->level) }}</p>
                <hr>
                <h5>Modules</h5>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($moduli as $modulo)
                            <tr>
                                <td>{{ $modulo->title }}</td>
                                <td>{!! $modulo->content !!}</td>
                                <td>
                                    <a href="{{ route('test.showMaterials', $modulo->id) }}" class="btn btn-primary btn-sm">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
