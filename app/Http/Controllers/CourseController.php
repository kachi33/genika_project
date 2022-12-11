<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Course;
use App\Models\Result;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Models\ScheduleConversation;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Chart\Layout;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courseList = $user->courses;
        return view('courses', compact('user', 'courseList'));
    }

    public function show(Course $course)
    {
        
        return view('view_course', ['course' => $course->load(['comments', 'comments.user'])]);
    }
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'section' => 'required|string',
            'subject' => 'required|string',
            'room' => 'required|string',
        ]);
        Course::create($data);
        return back()->with('success', 'Course created successfully');
    }
    public function courseUpdate(Request $request){
        Course::find(request()->course_id)->update(request()->all());
        return response()->json([
            'error'     => 0,
            'msg' => "Successfully Update course"
        ]);
    }

    public function routine(){
        $courseList = auth()->user()->courses()->where(['status' => 'accept','is_archive' => '0'])->get();
        return Layout::view("course.page.routine", [
            'courseList' => $courseList,
        ]);
    }

    public function join(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|exists:courses,code'
        ]);

        $courseData = Course::where($data)->firstOrFail();
        $check = $courseData->students()->where(['user_id'=>auth()->id()])->first();
  
       if($check==null){
            $courseData->students()->attach(auth()->id());
            return back()->with('success', 'You have Registered Successfully');
       }
       else{
            return back()->withErrors(['error' => 'You Already registered']);
       }  
    }


    public function update(Request $request)
    {
        $courseData = Course::create($request->all());
    }
    public function delete()
    {
        Course::find(request()->course_id)->delete();
        return response()->json([
            'error' => 0,
            'msg'   => "Successfully delete course",
        ]);
    }
    public function addTeacher(Request $request, Course $course)
    {   
        $data = $request->validate([
            'teachers_id' => "required|array|min:1",
            'role' => 'required|string|in:admin,moderator'
        ]);

        if (!count($data['teachers_id'])) {
            return back()->withErrors(['error' => 'please select at least one teacher to add']);
        }

        collect(explode(',',$request->teachers_id[0]))->each(function($id) use ($course, $request){
            if (!$user = User::find($id)) {
                return back()->withErrors(['error' => 'invalid teacher selected']);
            }
            if (!$course->teachers->contains($user)) {
                $course->teachers()->attach($id, ['role' => $request->role]);
            }
        });

        return back()->with('success', "Successfully added teacher");
    }
    public function addStudent(Request $request, Course $course)
    {   
        $data = $request->validate([
            'students_id' => "required|array|min:1",
        ]);

        if (!count($data['students_id'])) {
            return back()->withErrors(['error' => 'please select at least one Student to add']);
        }

        collect(explode(',',$request->students_id[0]))->each(function($id) use ($course, $request){
            if (!$user = User::find($id)) {
                return back()->withErrors(['error' => 'invalid Student selected']);
            }
            if (!$course->teachers->contains($user)) {
                $course->students()->attach($id);
            }
        });
        // Course::find(request()->course_id)->students()->attach(request()->user_id);
        return back()->with('success', "Successfully added student(s)");
    }
    public function confirmRequest(){
        Course::find(request()->course_id)->teachers()->updateExistingPivot(auth()->user()->id, array('status' => 'accept'), false);
    }

    public function leave(){
        if(request()->user()->user_type == 'Student'){
            Course::find(request()->course_id)->students()->detach(auth()->user()->id);
        }
        else{
        Course::find(request()->course_id)->teachers()->detach(auth()->user()->id);
        }
        return response()->json([
            'error' => 0,
            'msg'   => "Successfully leave you in this course",
        ]);
    }

    public function updateArchive(){
        $isArchive = request()->is_archive;
        Course::find(request()->course_id)->update(['is_archive'=>$isArchive]);
        $msg = $isArchive?"add archive":"add current";
        return response()->json([
            'error' => 0,
            'msg'   => "Successfully $msg this course",
        ]);
    }

    public function deletCourseTeachers(Request $request, Course $course){
        $request->validate([
            'teacher_id' => 'required|exists:users,id'
        ]);
        $course->teachers()->detach($request->teacher_id);
        return back()->with('success', 'teacher removed sucessfully');
    }
    public function deleteStudent(Request $request, Course $course){
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);
        $course->students()->detach($request->user_id);
         return back()->with('success', "Successfully deleted student");
    }
    public function teacherList(){
       
        $searchValue = request()->get('searchVal');

        $data = User::Where(['user_type' => 'Teacher'])
        ->where(function($query) use ($searchValue){
            $query->orWhere('name','LIKE','%'.$searchValue.'%');
            $query->orWhere('email','LIKE','%'.$searchValue.'%');
            $query->orWhere('phone','LIKE','%'.$searchValue.'%');
        })
        ->get();
        return response()->json($data->toArray());
    }

    public function studentList(){
       
        $searchValue = request()->get('searchVal');

        $data = User::Where(['user_type' => 'Student'])
        ->where(function($query) use ($searchValue){
            $query->orWhere('name','LIKE','%'.$searchValue.'%');
            $query->orWhere('email','LIKE','%'.$searchValue.'%');
            $query->orWhere('phone','LIKE','%'.$searchValue.'%');
        })
        ->get();
        return response()->json($data->toArray());
    }

    // update course questions
    public function question_update(Quiz $question)
    {
        $data = json_decode(file_get_contents('php://input'));
        if($question->update([$data->column => $data->value])){
             return response()->json([
                'error' => 0,
                'msg'   => "Successfully deleted student",
            ]);
        }
        return back();
    }

    // delete a course question
    public function question_delete($course_id, Quiz $question)
    {
        $course =  Course::find($course_id);
        if($course->questions->contains($question)){
            $question->delete();
        }
        return back()->with('msg', 'Question deleted seccessfully');
    }

    public function createComment(Request $request, Course $course)
    {
        $data = $request->validate([
            'comment' => 'required|string'
        ]);
        $data = array_merge($data,['course_id' => $course->id,'user_id' => auth()->id()]);
        $course->comments()->create($data);
        return back();
    }

    public function viewCourseTeachers(Course $course)
    {
        return view('course_teachers', ['course' => $course->load(['teachers'])]);
    }

    public function viewCourseStudents(Course $course)
    {
        return view('course_students', ['course' => $course->load(['students'])]);
    }

    public function scheduleList(Course $course)
    {
        return view('course_schedule_list', ['course' => $course->load(['students'])]);
    }

    public function createSchedule(Request $request, Course $course)
    {
        $data = $request->validate([
            'name'       => 'required',
            'start_time' => 'required|date',
            'end_time'   => 'required|date|after:start_time',
            'metting_link' => 'nullable|string',
            'description' => 'nullable|string'
        ]);
        $data = array_merge($data, ['course_id' => $course->id]);

        Schedule::create($data);
        return back()->with('success', 'Scheule created successfully');
    }

    public function deleteSchedule(Request $request, Course $course)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id'
        ]);

        $schedule = $course->schedules->firstWhere('id', $request->schedule_id);
        $schedule->delete();
        return back()->with('success', 'Schedule deleted successfully');

    }

    public function viewSchedule(Course $course, Schedule $schedule)
    {
        return view('view_schedule', compact('course', 'schedule'));
    }

    public function getCourseQuiz(Course $course)
    {
        $user = auth()->user();
        if ($user->user_type == 'Student') {
            $results = $user->results->where('course_id', $course->id)->pluck('quiz_date');
            $questions = $course->questions->whereNotIn('created_at', $results->all())->whereNull('closed_at');
            $dates = collect($questions->pluck('created_at'))->unique();
        } else {
            $questions = $course->questions;
            $dates = collect($course->questions->pluck('created_at'))->unique();
        }
        return view('course_questions', compact('questions', 'course', 'dates'));
    }

    public function getCourseQuizQuestions(Course $course, $date = '')
    {
        $questions = $course->questions->where('created_at', $date);
        return view('course_quiz_questions', compact('course', 'questions', 'date'));
    }

    public function deleteCourseQuizQuestions(Course $course, $date)
    {
        $questions = $course->questions->where('created_at', $date);
        $questions->each(function($question){
            $question->delete();
        });
        return back()->with('success', 'quiz deleted successfully');
    }


    public function createQuizQuestion(Request $request, Course $course)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
        ]);
        if ($request->has('date') && $request->date) {
            $data['created_at'] = Carbon::parse($request->date);
        }
        $course->questions()->create($data);
        return back()->with('success', 'Question saved Successfully');
        
    } 

    public function editQuizQuestion(Request $request, Course $course)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'option1' => 'required|string',
            'option2' => 'required|string',
            'option3' => 'required|string',
            'question_id' => 'required|exists:quizzes,id'
        ]);

        $course->questions->firstWhere('id', $request->question_id)->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3
        ]);
        return back()->with('success', 'Question updated Successfully');
    }    

    public function routineList()
    {
        $courseList = auth()->user()->courses()->where(['status' => 'accept','is_archive' => '0'])->get();
        return view('routineList', compact('courseList'));
    }

    public function saveScheduleConversation(Request $request, Schedule $schedule)
    {
        $request->validate(['message' => 'required|string']);
        ScheduleConversation::create([
            'message' => $request->message,
            'user_id' => auth()->id(),
            'schedule_id' => $schedule->id
        ]);

        return back();
    }

    public function getQuiz(Course $course, $date)
    {
        $user  = auth()->user();
        $questions = Quiz::where('created_at', $date)->paginate(1);
        $results = $user->results->where('course_id', $course->id)->where('quiz_date', $date);
        if($results->count() > 0){
            return redirect()->route('courses.quizzes', $course->id)->with('success', 'quiz already done');
        }
        return view('quiz_competition', compact('course', 'questions', 'date'));
    }

    public function saveResult(Request $request, Course $course, $date)
    {
        $questions = $course->questions->where('created_at', $date);
        $choices = collect(json_decode($request->selections));
        $score = 0;
        $choices->each(function($choice) use ($questions, &$score){
            $question = $questions->firstWhere('id', $choice->id);
            
            if ($question->answer == $choice->choice) {
                $score += 1;
            }
        });

        $user = auth()->user();
        $user->results()->create([
            'course_id' => $course->id,
            'quiz_date' => $date,
            'total' => $score
        ]);
        session()->push('success', 'quiz completed successfully');
        session()->push('quiz_status', 'quiz_status');
        // return back()->with(['quiz_status' => 'done', 'success' =>  'quiz completed successfully']);
        return back();
    }

    public function getResults(Course $course)
    {
        $user = auth()->user();
        if ($user->user_type == 'Student') {
            $positions = Result::where('course_id', $course->id)->groupBy('user_id')->selectRaw('sum(total) as total_score, user_id')->orderBy('total_score', 'desc')->get();
            $total = $positions->count();
            $position = $positions->search(function($p) use ($user) { return $p->user_id == $user->id;  }) + 1;
            $results = $course->results->where('user_id', $user->id);
            return view('result', compact('user', 'results', 'course', 'position', 'total'));
        }
        $results = Result::where('course_id', $course->id)->groupBy('user_id')->selectRaw('sum(total) as total_score, user_id')->orderBy('total_score', 'desc')->with('user')->get();
        return view('result', compact('user', 'course', 'results'));
    }

    public function closeQuiz(Course $course, $date = '')
    {
        $course->questions->where('created_at', $date)->each(function($q){
            $q->update(['closed_at' => now()]);
        });
        return back()->with('success', 'quiz closed successfully');
    }
}
