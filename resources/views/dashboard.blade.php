<x-app-layout>
    <x-slot name="styles">
        <style type="text/css">
            .circle-tile {
                margin-bottom: 15px;
                text-align: center;
            }
            .circle-tile-heading {
                border: 3px solid rgba(255, 255, 255, 0.3);
                border-radius: 100%;
                color: #ffffff;
                height: 80px;
                margin: 0 auto -40px;
                position: relative;
                transition: all 0.3s ease-in-out 0s;
                width: 80px;
            }
            .circle-tile-heading .fa {
                line-height: 80px;
            }
            .circle-tile-content {
                padding-top: 50px;
            }
            .circle-tile-number {
                font-size: 26px;
                font-weight: 700;
                line-height: 1;
                padding: 5px 0 15px;
            }
            .circle-tile-description {
                text-transform: uppercase;
            }
            .circle-tile-footer {
                background-color: rgba(0, 0, 0, 0.1);
                color: rgba(255, 255, 255, 0.5);
                display: block;
                padding: 5px;
                transition: all 0.3s ease-in-out 0s;
            }
            .circle-tile-footer:hover {
                background-color: rgba(0, 0, 0, 0.2);
                color: rgba(255, 255, 255, 0.5);
                text-decoration: none;
            }
            .circle-tile-heading.dark-blue:hover {
                background-color: #2e4154;
            }
            .circle-tile-heading.green:hover {
                background-color: #138f77;
            }
            .circle-tile-heading.orange:hover {
                background-color: #da8c10;
            }
            .circle-tile-heading.blue:hover {
                background-color: #2473a6;
            }
            .circle-tile-heading.red:hover {
                background-color: #cf4435;
            }
            .circle-tile-heading.purple:hover {
                background-color: #7f3d9b;
            }
            .tile-img {
                text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
            }

            .dark-blue {
                background-color: #34495e;
            }
            .green {
                background-color: #16a085;
            }
            .blue {
                background-color: #2980b9;
            }
            .orange {
                background-color: #f39c12;
            }
            .red {
                background-color: #e74c3c;
            }
            .purple {
                background-color: #8e44ad;
            }
            .dark-gray {
                background-color: #7f8c8d;
            }
            .gray {
                background-color: #95a5a6;
            }
            .light-gray {
                background-color: #bdc3c7;
            }
            .yellow {
                background-color: #f1c40f;
            }
            .text-dark-blue {
                color: #34495e;
            }
            .text-green {
                color: #16a085;
            }
            .text-blue {
                color: #2980b9;
            }
            .text-orange {
                color: #f39c12;
            }
            .text-red {
                color: #e74c3c;
            }
            .text-purple {
                color: #8e44ad;
            }
            .text-faded {
                color: rgba(255, 255, 255, 0.7);
            }

            .container {
                width: 100%;
            }
            .container .table-bordered {
                background: white;
                width: 80%;
                margin-left: 65px;
                margin-top: 25px;
            }
            .container .table-bordered thead {
                background: #c9dff1;
                border-style: solid;
                border-color: pink;
            }
            .container .table-bordered .thead .tr {
                color: pink;
                border-style: solid;
                border-color: black;
            }
            /* .container .design th{
                
                border-style: solid;
                border-color: #FF83A8;
            } */
            .container .table-bordered tbody {
                background: #c9dff1;
                border-style: solid;
                border-color: pink;
            }
            .circle-tile {
                    margin-bottom: 15px;
                    text-align: center;
                }
                .circle-tile-heading {
                    border: 3px solid rgba(255, 255, 255, 0.3);
                    border-radius: 100%;
                    color: #ffffff;
                    height: 80px;
                    margin: 0 auto -40px;
                    position: relative;
                    transition: all 0.3s ease-in-out 0s;
                    width: 80px;
                }
                .circle-tile-heading .fa {
                    line-height: 80px;
                }
                .circle-tile-content {
                    padding-top: 50px;
                }
                .circle-tile-number {
                    font-size: 26px;
                    font-weight: 700;
                    line-height: 1;
                    padding: 5px 0 15px;
                }
                .circle-tile-description {
                    text-transform: uppercase;
                }
                .circle-tile-footer {
                    background-color: rgba(0, 0, 0, 0.1);
                    color: rgba(255, 255, 255, 0.5);
                    display: block;
                    padding: 5px;
                    transition: all 0.3s ease-in-out 0s;
                }
                .circle-tile-footer:hover {
                    background-color: rgba(0, 0, 0, 0.2);
                    color: rgba(255, 255, 255, 0.5);
                    text-decoration: none;
                }
                .circle-tile-heading.dark-blue:hover {
                    background-color: #2e4154;
                }
                .circle-tile-heading.green:hover {
                    background-color: #138f77;
                }
                .circle-tile-heading.orange:hover {
                    background-color: #da8c10;
                }
                .circle-tile-heading.blue:hover {
                    background-color: #2473a6;
                }
                .circle-tile-heading.red:hover {
                    background-color: #cf4435;
                }
                .circle-tile-heading.purple:hover {
                    background-color: #7f3d9b;
                }
                .tile-img {
                    text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
                }

                .dark-blue {
                    background-color: #34495e;
                }
                .green {
                    background-color: #16a085;
                }
                .blue {
                    background-color: #2980b9;
                }
                .orange {
                    background-color: #f39c12;
                }
                .red {
                    background-color: #e74c3c;
                }
                .purple {
                    background-color: #8e44ad;
                }
                .dark-gray {
                    background-color: #7f8c8d;
                }
                .gray {
                    background-color: #95a5a6;
                }
                .light-gray {
                    background-color: #bdc3c7;
                }
                .yellow {
                    background-color: #f1c40f;
                }
                .text-dark-blue {
                    color: #34495e;
                }
                .text-green {
                    color: #16a085;
                }
                .text-blue {
                    color: #2980b9;
                }
                .text-orange {
                    color: #f39c12;
                }
                .text-red {
                    color: #e74c3c;
                }
                .text-purple {
                    color: #8e44ad;
                }
                .text-faded {
                    color: rgba(255, 255, 255, 0.7);
                }
                .container {
                    width: 100%;
                }
                .container .table-bordered {
                    background: white;
                    width: 80%;
                    margin-left: 65px;
                    margin-top: 25px;
                }
                .container .table-bordered thead {
                    background: #c9dff1;
                    border-style: solid;
                    border-color: pink;
                }
                .container .table-bordered .thead .tr {
                    color: pink;
                    border-style: solid;
                    border-color: black;
                }
                /* .container .design th{
                    
                    border-style: solid;
                    border-color: #FF83A8;
                } */
                .container .table-bordered tbody {
                    background: #c9dff1;
                    border-style: solid;
                    border-color: pink;
                }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="container">
                <div class="row-sm-3" style="margin-left: 55px">
                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            <a href="#"
                                ><div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-users fa-fw fa-3x"></i></div
                            ></a>
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Active
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {{$activeList->count()}}
                                </div>

                                <!-- <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            <a href="#"
                                ><div class="circle-tile-heading red">
                                    <i class="fa fa-users fa-fw fa-3x"></i></div
                            ></a>
                            <div class="circle-tile-content red">
                                <div class="circle-tile-description text-faded">
                                    Archive Course
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {{$archiveCourseList->count()}}
                                </div>

                                <!-- <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a> -->
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->user_type =="Teacher")
                    <div class="col-lg-3 col-sm-6">
                        <div class="circle-tile">
                            <a href="#"
                                ><div class="circle-tile-heading blue">
                                    <i class="fa fa-users fa-fw fa-3x"></i></div
                            ></a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                    Request Course
                                </div>
                                <div class="circle-tile-number text-faded">
                                    {{$requestCourseList->count()}}
                                </div>
                                <!-- <a class="circle-tile-footer" href="#">More Info<i class="fa fa-chevron-circle-right"></i></a> -->
                            </div>
                        </div>
                    </div>

                    @endif
                </div>
            </div>
            @if ($activeList->count())
                <h4 style="margin-left: 355px; margin-bottom: -17px">
                    ACTIVE COURSE LIST
                </h4>
                @foreach($activeList as $course)
                    <!-- {{ $course->name.$course->teachers()->count().$course->students()->count()}} -->
                    <div class="container">
                        <!-- <div class="design">       -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Total Teacher</th>
                                    <th>Total Student</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $course->name}}</td>
                                    <td>{{$course->teachers()->count()}}</td>
                                    <td>{{$course->students()->count()}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- </div> -->
                    </div>
                @endforeach
            @endif
            @if ($archiveCourseList->count())
                <h4 style="margin-left: 355px; margin-bottom: -17px">
                    ARCHIVE COURSE LIST
                </h4>
                @foreach($archiveCourseList as $course)
                    <div class="container">
                        <!-- <div class="design">       -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Total Teacher</th>
                                    <th>Total Student</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $course->name}}</td>
                                    <td>{{$course->teachers()->count()}}</td>
                                    <td>{{$course->students()->count()}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- </div> -->
                    </div>
                @endforeach 
            @endif
            @if ($requestCourseList->count())
                
                <h4 style="margin-left: 355px; margin-bottom: -17px">
                    REQUESTED COURSE LIST
                </h4>
                @foreach($requestCourseList as $course)
                    <div class="container">
                        <!-- <div class="design">       -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Total Teacher</th>
                                    <th>Total Student</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>{{ $course->name}}</td>
                                    <td>{{$course->teachers()->count()}}</td>
                                    <td>{{$course->students()->count()}}</td>
                                </tr>
                            </tbody>
                        </table>
                    <!-- </div> -->
                </div>

                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
