<x-app-layout>
    <x-slot name="styles">
        <style>
            .course .body{
              padding: 10px;
            }
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
            .course-list .inputLabel {
                font-weight: bold;
                padding-top: 12px;
                padding-bottom: 5px;
                text-align: right;
            }
            .course-list .input {
                padding: 12px;
                width: 100%;
                border-radius: 5px;
                font-size: 14px;
                border: 1px solid #aaaaaa;
                margin-bottom: 5px;
            }
        </style>
    </x-slot>
        <div class="course">
            @include("components/course_nav")
          <div class="body">
      
      
      
          <div class="row">
            <div class="col-md-12">
              <div class="body-header">
                <div class="row">
      
                <div class="pull-left title">Schedule Class List</div>
                <div class="pull-right">
                  @if($course->isAdmin())
                  <button class="btn-success" data-toggle="modal" data-target="#createCourseScheduleModal">Create Schedule</button>
                  @endif
                </div>
      
                </div>
              </div>
              <div class="box">
      
      
                <table class="table">
                  <thead>
                    <tr>
                      <th>Sl</th>
                      <th>Class Information</th>
                      <th>Live Class</th>
                      <th>Timer</th>
                      <th>Length</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Content</th>
                      @if($course->isAdmin())
                      <th>Action</th>
                    @endif
      
                    </tr>
                  </thead>
                  <tbody>
                  @foreach ($course->schedules as $key => $schedule)
                    <tr>
                      <td style="padding-top: 20px">{{$schedule->id}}</td>
                      <td style="padding-top: 20px">
                        {{$schedule->name}}
                      </td>
                      <td style="padding-top: 20px">
                        @if($schedule->isRunning())
                          <label class="label label-success"><i class="fas fa-dot-circle"></i> Class Going On</label>
                        @endif
                        @if($schedule->isNotStart())
                          <label class="label label-primary"><i class="fa fa-clock-o" aria-hidden="true"></i> Class is Not Start</label>
                        @endif
                        @if($schedule->isEnd())
                          <label class="label label-danger"><i class="fa fa-minus-circle" aria-hidden="true"></i> Class is End</label>
                        @endif
                      </td>
                      <td style="padding-top: 10px;width: 10%;">
                        @if($schedule->isRunning())
                          <span id="timer_{{$schedule->id}}"></span><br/> Remaining
                        @endif
                        @if($schedule->isNotStart())
                           <span id="timer_{{$schedule->id}}"></span> <br/>Before
                        @endif
                        @if($schedule->isEnd())
                          -
                        @endif
                        <script type="text/javascript">
                            timerList[{{$schedule->id}}] = {{$schedule->getTimer()}};
                        </script>
                      </td>
                      <td style="padding-top: 10px">
                        {{$schedule->getLength()}}
                      </td>
                      <td style="padding-top: 20px">{{$schedule->start_time->format('d M Y H:i a')}}</td>
                      <td style="padding-top: 20px">{{$schedule->end_time->format('d M Y H:i a')}}</td>
                      <td style="padding-top: 20px">
                        <a href="{{ route('courses.schedules.info', ['schedule' => $schedule->id, 'course' => $course->id]) }}">
                            <button style="padding: 3px;background-color: #595959" class="btn-sm">
                                <i class="fa fa-sign-in" aria-hidden="true"></i> Enter
                            </button>
                        </a>
                    </td>
                      @if($course->isAdmin())
                      <td style="width: 10%;padding-top: 20px">
                        {{-- <button class="btn-success btn-sm" onclick="loadUpdateSchedule({{$schedule->id}})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> --}}
                        <form action="{{ route('courses.schedule.delete', $course->id) }}" method="post" style="display: inline-block">
                            @csrf
                            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                            <button class="btn-sm" type="submit"><i class="fa fa-trash"></i></button>
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
          {{-- create schedule modal begins --}}
          <div class="modal fade modal_md in" id="createCourseScheduleModal" tabindex="-1" role="dialog" aria-labelledby="modal_md_Label" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal_header" style="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
        
                <div class="modal-content">
                    <div id="modal_md_header" class="modal_content_header">Create Schedule</div>
                        <div class="modal_md_body">
                            <form action="{{ route('courses.schedules.add', $course->id) }}" id="create_schedule" method="post">
                                @csrf
                                <div class="course-list">
                                    <div class="row">
                                        <div class="col-md-4 inputLabel">Schedule Name<font color="red">*</font>:</div>
                                        <div class="col-md-8">
                                            <input type="text" class="input" name="name" placeholder="Schedule Name" autocomplete="off">
                                        </div>
            
                                        <div class="col-md-4 inputLabel">
                                            Start Class Time<font color="red">*</font>:
                                        </div>
                                        <div class="col-md-8">
                                            <input type="datetime-local" class="input" name="start_time" placeholder="Start Class Time" autocomplete="off">
                                        </div>
                                        <div class="col-md-4 inputLabel">
                                            End Class Time<font color="red">*</font>:
                                        </div>
                                        <div class="col-md-8">
                                            <input type="datetime-local" class="input" name="end_time" placeholder="End Class Time" autocomplete="off">
                                        </div>
                                        <div class="col-md-4 inputLabel">
                                            Metting Link:
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="input" name="metting_link" placeholder="Enter Metting Link" autocomplete="off">
                                        </div>
                                        <div class="col-md-4 inputLabel">
                                            Description:
                                        </div>
                                        <div class="col-md-8">
                                            <textarea rows="5" class="input" name="description" placeholder="Description"></textarea>
                                        </div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-8">
                                            <div class="pull-right">
                                                <button type="submit" id="createBtn" style="margin-top: 20px;">Create Schedule</button>
                                            </div>
                                        </div>
            
                                    </div>
                                </div>
                            </form>
                        </div>
                                    
                    </div>
        
                </div>
            </div>
          </div>
          {{-- create schedule modal ends --}}
        </div>
      </div>
      <x-slot name="footer">
        <script type="text/javascript">
            setInterval(function(){ setTimer(); }, 1000);
            function setSingelTimer(key , seconds){
                var currTime = currTimeSecond();
                calSeconds = seconds - (currTime - startTime);
                time = timeConvert(calSeconds);
                $("#timer_"+key).html(time.hour+":"+time.minute+":"+time.second);
                if(calSeconds <=0 && seconds > 0){
                    timerList[key] = 0;
                    setTimeout(function(){  url.load(); }, 500);
                }
            }
        
            function setTimer(){
                $.each(timerList, function(key, seconds) {
                    setSingelTimer(key,seconds);
                });
            }

            function currTimeSecond(){
                return new Date().getTime() / 1000 | 0;
            }
            var timerList = [];
            var startTime = currTimeSecond();
            
            
        </script>
      </x-slot>
</x-app-layout>