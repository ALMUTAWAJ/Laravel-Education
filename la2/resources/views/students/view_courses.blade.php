@extends('layout')

@section('view-courses')
    <div class="container">
        <h1>Courses Information</h1>

        @if (count($courses) <= 0)
            <div style='margin-top:7rem' class='alert alert-info'>There are no courses to display 📪</div>
        @else
            <table class="table table-striped" border='1' style='min-height:25rem;min-width:50rem;margin-bottom:5rem;'>
                <thead class="thead-light">
                    <tr>
                        <th>Code</th>
                        <th>Credit</th>
                        <th>Grade</th>
                        <th>Major</th>
                        <th>Edit Course</th>
                        <th>Delete Course</th>
                    </tr>
                </thead>

                <!-- Loop through the courses array and create a row for each course -->
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course['code'] }}</td>
                        <td>{{ $course['credit'] }}</td>
                        <td>{{ $course['grade'] }}</td>
                        <td>{{ $course['major'] }}</td>
                        <td><a href="{{ route("Student.edit", $course->id) }}"><button
                                    class="btn btn-warning">Edit</button></a></td>
                        <td>
                            <form method='post' action="{{ route('Student.destroy', $course->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection
