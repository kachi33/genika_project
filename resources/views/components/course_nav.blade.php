<style>
    .course .body{
        padding: 10px;
    }
    .course .header {
        font-size: 14px;
        border-bottom: 1px solid #eeeeee;
        height: 55px;
        padding-top: 16px;
        margin-left: 0px;
        overflow-x: auto;
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        background-color: #ffffff;
        z-index: 999;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    .courseHeader a {
        text-align: center;
        padding: 15px 20px 15px 20px;
        color: #7f8c8d;
    }

    .course .active {
        border-bottom: 5px solid var(--blue);
        color: var(--blue) !important;
        font-weight: bold;
    }

    .course .header .title {
        font-weight: bold;
        font-size: 18px;
    }
</style>
<div class="header courseHeader">
    <div class="row">
        <div class="pull-left">
            <a href="{{ route('courses.show', $course->id) }}" class="title">{{ $course->name }}</a>
        </div>
        <center>
            <a href="{{ route('courses.show', $course->id) }}" class="@if(request()->routeIs('courses.show', $course->id)) active @endif">
                <span class="fas fa-home"></span> Stream
            </a>

            <a href="{{ route('courses.teachers.view', $course->id) }}" class="@if(request()->routeIs('courses.teachers.view', $course->id)) active @endif"><span
                    class="fas fa-chalkboard-teacher"></span>
                Teachers</a>

            <a href="{{ route('courses.students.view', $course->id) }}" class="@if(request()->routeIs('courses.students.view', $course->id)) active @endif"><span
                    class="fas fa-calendar-alt"></span>
                Student</a>

            <a href="{{ route('courses.quizzes', $course->id) }}" class="@if(request()->routeIs('courses.quizzes', $course->id)) active @endif"><span
                    class="fas fa-calendar-alt"></span>
                Quiz</a>

            <a href="{{ route('courses.schedules.view', $course->id) }}" class="@if(request()->routeIs('courses.schedules.view', $course->id)) active @endif"><span
                    class="fas fa-user"></span> Schedule</a>

            <a href="{{ route('courses.results', $course->id) }}" class="@if(request()->routeIs('courses.results', $course->id)) active @endif"><span
                    class="fas fa-user"></span> Results</a>
            @if (auth()->user()->user_type == 'Teacher' || auth()->user()->user_type == 'Admin')
                <a href="http://classrooom.test/student/courses/2/setting" class=""><span
                        class="fas fa-sign-out-alt"></span>
                    Setting</a>
            @endif
        </center>
    </div>
</div>