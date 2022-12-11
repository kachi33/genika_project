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
                    @if ($user->user_type == 'Student' && $results->count())
                        <h3 style="text-align: end"> Position: {{ $position }} of {{ $total }}</h3>
                    @endif
                    <div class="row">
                        <div class="col-12" id="wrapper">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    @if ($user->user_type == 'Student')
                                                        <table class="table table-striped dataTable no-footer" role="grid">
                                                            <thead>
                                                                <tr role="row">
                                                                    <th>#</th>
                                                                    <th>Date</th>
                                                                    <th>Result</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="users">
                                                                @foreach ($results as $key => $result)
                                                                <tr class="user">
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>{{ $result->quiz_date }}</td>
                                                                    <td>{{ $result->total }}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @else
                                                    <table class="table table-striped dataTable no-footer" role="grid">
                                                        <thead>
                                                            <tr role="row">
                                                                <th>Position</th>
                                                                <th>Student Name</th>
                                                                <th>Student Email</th>
                                                                <th>Result</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="users">
                                                            @foreach ($results as $key => $result)
                                                            <tr class="user">
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $result->user->name }}</td>
                                                                <td>{{ $result->user->email }}</td>
                                                                <td>{{ $result->total_score }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @endif
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
</x-app-layout>