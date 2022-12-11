<x-app-layout>
    <x-slot name="styles">
        <style type="text/css">
            .course-list {}

            .course-list .header {
                font-weight: bold;
                font-size: 16px;
                border-bottom: 1px solid #eeeeee;
                padding: 10px 5px 10px 5px;
                height: 55px;
                margin-left: 0px;
                position: -webkit-sticky;
                position: sticky;
                top: 0;
                background-color: #ffffff;
                z-index: 999;
            }

            .course-list-body {
                padding: 15px 5px 15px 5px;
            }

            .course-list a {
                text-decoration: none;
            }

            .course-list .active {
                color: #000000;
            }

            .course-list .normal {
                font-size: 13px;
                color: #95a5a6;
            }

            .course-list .normal {
                color: #aaaaaa;
            }

            button {
                background-color: var(--red);
                color: #ffffff;
                padding: 8px;
                border: none;
                cursor: pointer;
                border-radius: 3px;
                font-size: 14px;
            }

            button:hover {
                opacity: 0.8;
                color: #ffffff;
            }

            button:disabled {
                opacity: 0.8;
                color: #ffffff;
            }

            button:focus {
                outline: none;
            }

            .course-list .input {
                padding: 12px;
                width: 100%;
                border-radius: 5px;
                font-size: 14px;
                border: 1px solid #aaaaaa;
                margin-bottom: 5px;
            }

            .course-list .inputLabel {
                font-weight: bold;
                padding-top: 12px;
                padding-bottom: 5px;
                text-align: right;
            }

            .course-list .input:focus {
                outline: none;
            }

            .course-list .card {
                padding: 2px;
                height: 205px;
                border: 1px solid #eeeeee;
                box-shadow: 2px 2px 5px 2px #aaaaaa;
                margin-bottom: 25px;
                background-color: #ffffff;
                overflow: hidden;
            }

            .course-list .card:hover {
                box-shadow: 5px 5px 10px 3px #aaaaaa;
            }

            .course-list .card img {
                height: 75px;
                width: 100%;
            }

            .course-list .card-body {
                height: 85px;
                padding: 3px;
            }
        </style>
    </x-slot>
    <div class="course-list">
        <div class="header">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left" style="margin-top: 7px">
                        @if($user->user_type=="Teacher")
                        <a href="/{{$user->user_type}}/courses"><span
                                class="{{!(isset(request()->request_courses)|isset(request()->archive_course))?'active':'normal'}}"><i
                                    class="fa fa-play"></i> Current</span></a>
                        |
                        <a href="/{{$user->user_type}}/courses?archive_course=1"><span
                                class="{{isset(request()->archive_course)?'active':'normal'}}"><i
                                    class="fa fa-clock-o"></i> Archive</span></a>
                        |
                        <a href="/{{$user->user_type}}/courses?request_courses=1"><span
                                class="{{isset(request()->request_courses)?'active':'normal'}}"><i
                                    class="fa fa-clock-o"></i> Requset</span></a>
                        @endif @if($user->user_type=="Student")
                        <a href="/{{$user->user_type}}/courses"><span
                                class="{{!(isset(request()->request_courses)|isset(request()->archive_course))?'active':'normal'}}"><i
                                    class="fa fa-play"></i> Current</span></a>
                        |
                        <a href="/{{$user->user_type}}/courses?archive_course=1"><span
                                class="{{isset(request()->archive_course)?'active':'normal'}}"><i
                                    class="fa fa-clock-o"></i> Archive</span></a>
                        @endif
                    </div>
                    @if($user->user_type == 'Teacher')
                    <div class="pull-right">
                        <button type="button" class="" data-toggle="modal" data-target="#createCourseModal">
                            <i class="fa fa-plus"></i> Create Course
                        </button>
                    </div>
                    @endif @if($user->user_type == 'Student')
                    <div class="pull-right">
                        <button type="button" class="" data-toggle="modal" data-target="#modal_md">
                            <i class="fa fa-plus"></i> Join Course
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="course-list-body">
            <div class="row">
                @foreach($courseList as $key => $data)
                <div class="col-md-3 col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <img src="{{asset($data->cover)}}" />
                            <div style="
                                    margin-top: -65px;
                                    padding-left: 5px;
                                    color: #ffffff;
                                ">
                                <font size="5px;"><b>{{$data->name(16)}}</b></font><br />
                                <div style="margin-top: -5px">
                                    {{$data->code}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style="margin-top: 20px">
                            <center>
                                @if($data->isTeacher()) @if($data->isAdmin())
                                <span class="label label-success"><i class="fas fa-user-shield"></i>
                                    Admin</span>
                                @elseif($data->isModerator())
                                <span class="label label-info"><i class="fas fa-user-cog"></i>
                                    Moderator</span>
                                @endif @endif
                            </center>
                            Subject: {{$data->subject}}<br />
                            Section: {{$data->section}}<br />
                            Room: {{$data->room}}<br />
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('courses.show', $data->id) }}" >
                                <button style="
                                        width: 100%;
                                        background-color: #f2f6f4;
                                        color: var(--blue);
                                    ">
                                    <b>View</b>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{-- start modals --}}
        <!-- Start Join Course Modal -->
        <div class="modal fade modal_md in" id="modal_md" tabindex="-1" role="dialog"
            aria-labelledby="modal_md_Label" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal_header" style="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form action="{{ route('courses.join') }}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div id="modal_md_header" class="modal_content_header">
                            Join Course
                        </div>
                        <div class="modal_md_body">
                            <div id="modal_md_body">
                                <div class="course-list">
                                    <div class="row">
                                        <div class="col-md-3 inputLabel">
                                            Course Code<font color="red">*</font>:
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="input" name="code" placeholder="Course Code"
                                                autocomplete="off" required />
                                        </div>
                                        <div class="col-md-8">
                                            <div class="pull-left">
                                                <button type="submit" style="margin-top: 20px">
                                                    Join Course
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Join Course Modal -->
        {{-- create course starts --}}
        <div class="modal fade modal_md in" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="modal_md_Label" aria-hidden="false">
            <div class="modal-dialog">
              <div class="modal_header" style="">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              </div>
          
              <div class="modal-content">
                  <div id="modal_md_header" class="modal_content_header">Create Course</div>
                      <div class="modal_md_body">
                        <form action="{{ route('courses.store') }}" id="create_course" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 inputLabel">Course Name<font color="red">*</font>:</div>
                                <div class="col-md-8">
                                    <input type="text" class="input" name="name" placeholder="Course Name" autocomplete="off" required>
                                </div>
                            
                                <div class="col-md-4 inputLabel">
                                    Section:
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="input" name="section" placeholder="Section" autocomplete="off" required>
                                </div>
                                <div class="col-md-4 inputLabel">
                                    Subject:
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="input" name="subject" placeholder="Subject" autocomplete="off" required>
                                </div>
                                <div class="col-md-4 inputLabel">
                                    Room:
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="input" name="room" placeholder="Room" autocomplete="off" required>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <div class="pull-right">
                                        <button type="submit" id="createBtn" style="margin-top: 20px;">Create Course</button>
                                    </div>
                                </div>
                            
                            </div>
          
                        </div>
                    </form>
                </div>
                                     
            </div>
        
        </div>
        {{-- create course ends --}}
        {{-- ends modals --}}

        @if (collect($errors->getMessages())->except(['error'])->count())
            <x-slot name="footer">
                <script>
                    Swal.fire(
                        'Validation Error!',
                        @json(collect($errors->getMessages())->except(['error'])->flatten(1)->join("\n")),
                        'error'
                    )
                </script>
            </x-slot>
        @endif
    </div>
</x-app-layout>