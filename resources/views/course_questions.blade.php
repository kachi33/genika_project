<x-app-layout>
    <x-slot name="styles">
        <style>
                * {
                /* font-size: 16px; */
                box-sizing: border-box;
            }
        
                    
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
            
            .section {
                margin-top: 4em;
                width: 100%;
            }
            
            table tbody tr td:nth-child(2) {
                width: 30%;
                text-align: justify;
                overflow-x: hidden;
                text-overflow: ellipsis;
            }
            
            .accordion {
                cursor: pointer;
                outline: none;
                transition: 0.4s;
            }
            
            .panel {
                padding: 0 18px;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.4s ease-out;
                background:transparent;
            }
            
            .d-block {
                color: red;
                font-style: italic;
            }
            
            .grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                width: 100%;
                margin-bottom: 0.6em;
                background: transparent;
            }
            
            .grid div {
                display: flex;
                justify-content: flex-end;
                background: transparent;
            }
            .grid div label{
                text-align: left;
            }
            .dataTables_length label.d-flex,
            .dataTables_filter label.d-flex{
                display: flex;
                align-items: baseline;
            }
            .dataTables_length label.d-flex select{
                width: 6em;
            }

            .modal-body{
                overflow-y: scroll;
            }

            .tinymce_container{
                margin-bottom: 1em;
            }

            .modal_md_body input{
                width: 100%;
                padding: 0.25em;
                border: 1px solid lightgray;
                border-radius: 0.5em;
            }

            .modal_header button{
                margin-left: auto;
                display: block;
            }

            @media screen and(max-width: 765px) {
                .grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </x-slot>
    <div class="course">
        @include("components/course_nav")
		<div class="body">
        <div class="row">
            <section class="section">
                <div class="section-body">
                    <div class="row">
                        @if (auth()->user()->user_type != 'Student')
                            <a href="{{ route('courses.questions', ['course' => $course->id, 'date' => now()->toDateString()]) }}" class="btn btn-sm btn-success mb-2">Create Quiz</a>
                        @endif
                        <div class="col-12" id="wrapper">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table table-striped dataTable no-footer" role="grid">
                                                        <thead>
                                                            <tr role="row">
                                                                <th>#</th>
                                                                <th>date</th>
                                                                <th>Question(s)</th>
                                                                @if (auth()->user()->user_type != 'Student')
                                                                    <th>Status</th>
                                                                @endif
                                                                <th>action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="users">
                                                            @foreach ($dates as $index => $date)
                                                                <tr class="user">
                                                                    <td>
                                                                        {{ $index + 1 }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $date }}
                                                                    </td>
                                                                    <td>
                                                                        <p>{{ $questions->where('created_at', $date)->count() }}</p>
                                                                    </td>
                                                                    @if (auth()->user()->user_type != 'Student')
                                                                        <td>{{ $course->questions->where('created_at', $date)->whereNotNull('closed_at')->count() ? 'closed' : 'Open'}}</td>
                                                                    @endif
                                                                    <td>
                                                                        @if (auth()->user()->user_type != 'Student')
                                                                            <div style="display: flex; align-items: center; column-gap: 1em;">
                                                                                <a href="{{ route('courses.questions', ['course' => $course->id, 'date' => $date]) }}">View Questions</a>
                                                                                @if ($course->questions->where('created_at', $date)->whereNull('closed_at')->count())
                                                                                    <a href="{{ route('courses.quiz.close', ['course' => $course->id, 'date' => $date]) }}">Close Quiz</a>
                                                                                @endif
                                                                                {{-- {{ route('question.delete', ['course_id' => $course->id, 'question' => $question->id]) }} --}}
                                                                                <form action="{{ route('courses.quiz.delete', ['course' => $course->id, 'date' => $date]) }}" method="post">
                                                                                    @csrf
                                                                                    <button  type="submit" class="btn btn-sm btn-danger">delete</button>                                                                            
                                                                                </form>
                                                                            </div>
                                                                        @else
                                                                            <a href="{{ route('quiz.start', [$course->id, $date]) }}">Start Quiz</a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-7">
                                                    <div class="dataTables_paginate paging_simple_numbers" id="table-1_paginate">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    
    <x-slot name="footer">
       
    </x-slot>
</x-app-layout>