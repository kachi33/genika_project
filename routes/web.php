<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ScheduleWhiteboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    }
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}/schedules/{schedule}/whiteboard', [ScheduleWhiteboardController::class, 'viewWhiteboard']);
    Route::get('/courses/{course}/schedules/{schedule}/whiteboard/download', [ScheduleWhiteboardController::class, 'downloadBoard']);
    Route::get('/courses/{course}/schedules/{schedule}/whiteboard/get', [ScheduleWhiteboardController::class, 'getBoard']);
    Route::post('/courses/{course}/schedules/{schedule}/whiteboard/save', [ScheduleWhiteboardController::class, 'saveBoard']);
    Route::get('/courses/{course}/schedules/{schedule}/whiteboard/add_page', [ScheduleWhiteboardController::class, 'addPage']);
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/teacher/api/teacher_list', [CourseController::class, 'teacherList'])->name('courses.teachers.search');
    Route::get('/students/api/student_list', [CourseController::class, 'studentList'])->name('courses.student.search');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/students', [CourseController::class, 'viewCourseStudents'])->name('courses.students.view');
    Route::post('/courses/{course}/comment', [CourseController::class, 'createComment'])->name('courses.comment.store');
    Route::get('/courses/{course}/schedules/{schedule}', [CourseController::class, 'viewSchedule'])->name('courses.schedules.info');
    Route::get('/courses/{course}/teachers', [CourseController::class, 'viewCourseTeachers'])->name('courses.teachers.view');
    Route::get('/courses/{course}/schedules', [CourseController::class, 'scheduleList'])->name('courses.schedules.view');
    Route::post('/courses/{course}/schedules', [CourseController::class, 'createSchedule'])->name('courses.schedules.add');
    Route::post('/courses/{course}/teachers', [CourseController::class, 'addTeacher'])->name('courses.teachers.add');
    Route::post('/courses/{course}/students', [CourseController::class, 'addStudent'])->name('courses.students.add');
    Route::post('/courses/{course}/teachers/delete', [CourseController::class, 'deletCourseTeachers'])->name('courses.teachers.delete');
    Route::post('/courses/{course}/schudule/delete', [CourseController::class, 'deleteSchedule'])->name('courses.schedule.delete');
    Route::post('/courses/{course}/students/delete', [CourseController::class, 'deleteStudent'])->name('courses.students.delete');
    Route::post('/courses/join', [CourseController::class, 'join'])->name('courses.join');
    Route::get('/whiteboard', [SchedleWhiteboardController::class, 'viewWhiteboard']);
    Route::get('/whiteboard/get', [ScheduleWhiteboardController::class, 'getBoard']);
    Route::post('/whiteboard/save', [ScheduleWhiteboardController::class, 'saveBoard']);
    Route::get('/whiteboard/add_page', [ScheduleWhiteboardController::class, 'addPage']);
    Route::get('courses/{course}/quiz', [CourseController::class, 'getCourseQuiz'])->name('courses.quizzes');
    Route::get('courses/{course}/questions/{date}', [CourseController::class, 'getCourseQuizQuestions'])->name('courses.questions');
    Route::post('courses/{course}/questions', [CourseController::class, 'createQuizQuestion'])->name('courses.quiz.save.question');
    Route::post('courses/{course}/questions/edit', [CourseController::class, 'editQuizQuestion'])->name('courses.quiz.edit.question');
    Route::post('courses/{course}/questions/{date}', [CourseController::class, 'deleteCourseQuizQuestions'])->name('courses.quiz.delete');
    Route::get('routine', [CourseController::class, 'routineList'])->name('routine.list');
    Route::post('/schedule/{schedule}/conversation', [CourseController::class, 'saveScheduleConversation'])->name('schedule.conversation.save');
    Route::get('/{course}/{date}/quiz', [CourseController::class, 'getQuiz'])->name('quiz.start');
    Route::post('/{course}/{date}/quiz', [CourseController::class, 'saveResult']);
    Route::get('/{course}/results', [CourseController::class, 'getResults'])->name('courses.results');
    Route::get('/courses/{course}/{date}/close', [CourseController::class, 'closeQuiz'])->name('courses.quiz.close');
});

require __DIR__.'/auth.php';
