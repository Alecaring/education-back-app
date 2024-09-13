@extends('layouts.admin')

@section('title', 'Courses')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">Courses</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('courses.create') }}" class="btn btn-primary mb-4">Create New Course</a>

        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light rounded">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->name }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                            <p class="card-text"><strong>Level:</strong> {{ ucfirst($course->level) }}</p>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewCourseModal" data-course="{{ json_encode($course) }}">
                                <i class="bi bi-eye"></i> View
                            </button>
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm" >
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteCourseModal" data-course-id="{{ $course->id }}">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- View Course Modal -->
    <div class="modal fade" id="viewCourseModal" tabindex="-1" aria-labelledby="viewCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewCourseModalLabel">Course Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 id="courseName"></h5>
                    <p id="courseDescription"></p>
                    <p><strong>Level:</strong> <span id="courseLevel"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Course Modal -->
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCourseForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editCourseName" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="editCourseName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCourseDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editCourseDescription" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editCourseLevel" class="form-label">Level</label>
                            <select class="form-select" id="editCourseLevel" name="level" required>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Course Modal -->
    <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCourseModalLabel">Delete Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this course?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteCourseForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Handle View Course Modal
            const viewCourseModal = document.getElementById('viewCourseModal');
            viewCourseModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const course = JSON.parse(button.getAttribute('data-course'));

                const courseName = viewCourseModal.querySelector('#courseName');
                const courseDescription = viewCourseModal.querySelector('#courseDescription');
                const courseLevel = viewCourseModal.querySelector('#courseLevel');

                courseName.textContent = course.name;
                courseDescription.textContent = course.description;
                courseLevel.textContent = course.level.charAt(0).toUpperCase() + course.level.slice(1);
            });

            // Handle Edit Course Modal
            const editCourseModal = document.getElementById('editCourseModal');
            editCourseModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const course = JSON.parse(button.getAttribute('data-course'));

                const form = editCourseModal.querySelector('#editCourseForm');
                form.action = `/courses/${course.id}`;

                const editCourseName = editCourseModal.querySelector('#editCourseName');
                const editCourseDescription = editCourseModal.querySelector('#editCourseDescription');
                const editCourseLevel = editCourseModal.querySelector('#editCourseLevel');

                editCourseName.value = course.name;
                editCourseDescription.value = course.description;
                editCourseLevel.value = course.level;
            });

            // Handle Delete Course Modal
            const deleteCourseModal = document.getElementById('deleteCourseModal');
            deleteCourseModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const courseId = button.getAttribute('data-course-id');

                const form = deleteCourseModal.querySelector('#deleteCourseForm');
                form.action = `/courses/${courseId}`;
            });
        });
    </script>
@endsection
