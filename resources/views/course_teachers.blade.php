<x-app-layout>
    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
        <style type="text/css">

            .body-header{
                padding: 7px 10px 7px 10px;
                background-color: #ffffff;
                border: 1px solid #eeeeee;
                margin-bottom: 10px;
            }
            .body-header .title{
                font-size: 17px;
                font-weight: bold;
                margin-top: 5px;
            }
            .body .box{
                padding: 7px 10px 7px 10px;
                background-color: #ffffff;
                border: 1px solid #eeeeee;
                margin-bottom: 10px;
            }
            table{
                width: 100%;
                background-color: #ffffff;
            }
            td{
                padding: 5px;
                border: 1px solid #eeeeee;
                text-align: center;
            }
            th{
                font-weight: bold;
                font-size: 14px;
                padding: 5px;
                border: 1px solid #eeeeee;
                text-align: center;
            }
            .listImg{
                height: 50px;
                width: 50px;
                border-radius: 100%;
            }
            .teacher-add-area{
              
            }
            .teacher-add-area input{
                width: 93%;
                padding: 5px;
                float: left;
                
            }
            .teacher-add-area .select-list-area{
                border-bottom: 1px solid #eeeeee;
                margin-bottom: 5px;
                padding: 10px;
            }
            .teacher-add-area .select-list-area i{
                padding: 5px;
            }
            .teacher-add-area .select-list-area span{
                font-size: 13px;
            }
            .teacher-add-area .select-search-area{
                padding: 10px;
            }
            .teacher-add-area .select-search-result{
                padding: 5px;
                height: 300px;
                overflow-y: scroll;
            }
            .teacher-add-area .select-search-result-li{
                border: 1px solid #eeeeee;
                padding: 5px;
                border-radius: 15px;
                margin-bottom: 2px;
            }
            .teacher-add-area .select-search-result-li img{
                height: 40px;
                width: 40px;
                border-radius: 100%;
                float: left;
                margin-right: 10px;
                margin-left: 5px;
                margin-top: 0px;
                
            }
            .teacher-add-area .select-search-result-li:hover{
                cursor: pointer;
                background-color: #f1f1f1;
                border-radius: 15px;
            }
            .cart-span{
                margin-right: 5px;
                display: inline-block;
                margin-bottom: 5px;
            }
        </style>
        
    </x-slot>
    <div class="container-fluid">
        <div id="body">
            <div class="course">
                @include('components/course_nav')
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="body-header">
                                <div class="row">
                                        
                                <div class="pull-left title">Teachers</div>
                                <div class="pull-right">
                                    @if($course->isAdmin())
                                        <button data-toggle="modal" data-target="#addTeacherModal">Add Teacher(s)</button>
                                    @endif
                                </div>

                                </div>	
                            </div>
                            <div class="box">
                                
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    @if($course->isAdmin())
                                        <th>Action</th>
                                    @endif

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($course->teachers as $key => $teacher)
                                    <tr>
                                        <td style="width: 15%">
                                            <img src="{{ asset('/upload/avatars/default_avatar.png') }}" class="listImg">
                                        </td>
                                        <td style="width: 50%;padding-top: 20px">{{$teacher->name}}</td>
                                        <td style="width: 20%;padding-top: 20px">{{$teacher->pivot->role}}</td>
                                        {{-- @php
                                            dd($course->teachers->first()->id, auth()->id(),$course->isAdmin());
                                        @endphp --}}
                                        @if($course->teachers->first()->id == auth()->id())
                                        <td style="width: 15%;padding-top: 20px">
                                            <form action="{{ route('courses.teachers.delete', $course->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                                <button class="btn-sm" onclick="deleteTeacher({{$teacher->id}})">Delete</button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>  
                                @endforeach
                                
                                </tbody>
                            </table>
                            
                            </div>
                        </div>
                    </div>	
                </div>
            </div>	

            {{-- Add teachers modal start --}}
            <div class="modal fade modal_md in" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="modal_md_Label" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal_header" style="">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
              
                    <div class="modal-content">
                        <form action="{{ route('courses.teachers.add', $course->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="teachers_id[]" id="teachers_id_input">
                            <div class="box teacher-add-area" style="padding: 0px;">
                                <div class="select-list-area" id="select-list-area">
                                </div>
                                <div class="select-search-area">
                                    <input type="text" name="" class="form-control" id="searchTeacher" autocomplete="off" />
                                    <img id="select-search-area-loader" style="margin: 5px 0px 0px 5px;display: none;" height="20px" width="20px" src="{{asset('img/site/loading.gif')}}">
                                </div>
                                <div class="select-search-result" style="width: 100%" id="responseSearch">
                                </div>
                            </div>
                            <div class="row">
                                <div class="pull-left">
                                    <select name="role">
                                        <option value="admin">Admin</option>
                                        <option value="moderator">Moderator</option>
                                    </select> 
                                </div>
                                <div class="pull-right">
                                    <button type="submit">Add Teacher</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Add teachers modal ends --}}
        </div>
    </div>
    <x-slot name="footer">
        <script defer>
            var teacherAddCartList = [];
            var teacherData = []
            let input = document.querySelector('input#searchTeacher');
            input.addEventListener('keyup', getTeachers)
            function getTeachers() {
                var searchVal = $("#searchTeacher").val();
                if (searchVal == "") {
                    $("#responseSearch").html("");
                    return;
                }
                $("#select-search-area-loader").show();
                $.get("/teacher/api/teacher_list?searchVal=" + searchVal, function(list) {
                    $("#responseSearch").html("");
                    $.each(list, function(key, teacher) {
                        teacherData[teacher.id] = teacher;
                        var div = "<div class='select-search-result-li' onclick='teacherAddCart(" + teacher.id + ")'><img src='" + teacher.avatar + "'><b>" + teacher.name + "</b><br/>" + teacher.email + "</div>";
                        $("#responseSearch").append(div);
                    });
                    $("#select-search-area-loader").hide();
                })
            }

            function teacherAddCart(id) {
                let obj =  {
                    id: id,
                    name: teacherData[id].name,
                    email: teacherData[id].email,
                };
                if (!teacherAddCartList.find(teacher => teacher.id == id)) {
                    teacherAddCartList.push(obj);
                }
                $("#select-list-area").html("");
                teacherAddCartList.forEach(prepareAddCart);
                document.querySelector('input#teachers_id_input').value = teacherAddCartList.map(teacher => teacher.id);
            }

            function prepareAddCart(data) {
                var div = "<span class='label label-primary cart-span'>(" + data.name + ") " + data.email + " <i onclick='remove(event," + data.id +")' class='fa fa-times'></i></span>";
                $("#select-list-area").append(div);
            }

            function remove(event, id){
                teacherAddCartList = teacherAddCartList.filter(teacher => teacher.id != id)
                document.querySelector('input#teachers_id_input').value = teacherAddCartList.map(teacher => teacher.id);
                $(event.target.parentNode).remove();
            }
        </script>
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
    </x-slot>
</x-app-layout>