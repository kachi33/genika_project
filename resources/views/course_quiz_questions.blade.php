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
                        <button type="button" class="btn btn-sm btn-success mb-2" data-toggle="modal" data-target="#createCourseQuizQuestionModal">Add Question</button>
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
                                                                <th>Question</th>
                                                                <th>Answer</th>
                                                                <th>Option 1</th>
                                                                <th>Option 2</th>
                                                                <th>Option 3</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="users">
                                                            @foreach ($questions as $index => $row)
                                                                <tr class="user">
                                                                    <td>
                                                                        {{ $index + 1 }}
                                                                    </td>
                                                                    <td>
                                                                        {!! $row->question !!}
                                                                    </td>
                                                                    <td>
                                                                        <p>{{ $row->answer }}</p>
                                                                    </td>
                                                                    <td>
                                                                        <p>{{ $row->option1 }}</p>
                                                                    </td>
                                                                    <td>
                                                                        <p>{{ $row->option2 }}</p>
                                                                    </td>
                                                                    <td>
                                                                        <p>{{ $row->option3 }}</p>
                                                                    </td>
                                                                    <td>
                                                                        <div style="display: flex; align-items: center; column-gap: 1em;">
                                                                            <button 
                                                                                type="button" class="btn btn-sm btn-primary" 
                                                                                data-toggle="modal" 
                                                                                data-target="#EditCourseQuizQuestionModal" 
                                                                                data-question_id="{{ $row->id }}"
                                                                                data-question="{!! $row->question !!}"
                                                                                data-answer="{{ $row->answer }}"
                                                                                data-option1="{{ $row->option1 }}"
                                                                                data-option2="{{ $row->option2 }}"
                                                                                data-option3="{{ $row->option3 }}"
                                                                                >
                                                                                Edit
                                                                            </button>
                                                                            {{-- {{ route('question.delete', ['course_id' => $course->id, 'question' => $question->id]) }} --}}
                                                                            <form action="{{ route('courses.quiz.delete', ['course' => $course->id, 'date' => $date]) }}" method="post">
                                                                                @csrf
                                                                                <button  type="submit" class="btn btn-sm btn-danger">delete</button>                                                                            
                                                                            </form>
                                                                        </div>
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
    {{-- add question modal begins --}}
    <div class="modal fade modal_md in" id="createCourseQuizQuestionModal" tabindex="-1" role="dialog" aria-labelledby="modal_md_Label" aria-hidden="false">
        <div class="modal-dialog  modal-dialog-scrollable">
            <div class="modal_header" style="">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
    
            <div class="modal-content">
                <div id="modal_md_header" class="modal_content_header">Create Question</div>
                    <div class="modal_md_body modal-body">
                        <form action="{{ route('courses.quiz.save.question', $course->id) }}" id="addQuestion form" name="questionForm" method="post">
                            @csrf
                            <input type="hidden" name="date" value="{{ $date ?? '' }}">
                            <div class="course-list">
                                <div class="shadow mb-3">
                                    <div class="row">
                                        {{-- <div class="col-md-12 inputLabel">
                                            <button type="button" class="btn-primary btn btn-sm my-2" onclick="addNewRow()">Add new row</button>
                                        </div> --}}
                                        <div class="col-md-12">
                                            Question
                                        </div>
                                        <div class="col-md-12 tinymce_container">
                                            <textarea class="tinymce" name="question" required>
                                                
                                            </textarea>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Answer</div>
                                            <input type="text" class="input" autocomplete="off" name="answer" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Option 1</div>
                                            <input type="text" class="input" autocomplete="off" name="option1" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Option 2</div>
                                            <input type="text" class="input" autocomplete="off" name="option2" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Option 3</div>
                                            <input type="text" class="input" autocomplete="off" name="option3" required>
                                        </div>
                                    </div>
                                </div>
                                    {{-- <div class="col-md-4 inputLabel">
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
                                    <div class="col-md-4"></div> --}}
                                <div class="col-md-8 submit_container">
                                    <div class="pull-right">
                                        <button type="submit" id="createBtn" style="margin-top: 20px;">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                                
                </div>
    
            </div>
        </div>
      </div>
    {{-- add question modal ends --}}

    {{-- edit question modal begins --}}
    <div class="modal fade modal_md in" id="EditCourseQuizQuestionModal" tabindex="-1" role="dialog" aria-labelledby="modal_md_Label" aria-hidden="false">
        <div class="modal-dialog  modal-dialog-scrollable">
            <div class="modal_header" style="">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
    
            <div class="modal-content">
                <div id="modal_md_header" class="modal_content_header">Edit Question</div>
                    <div class="modal_md_body modal-body">
                        <form action="{{ route('courses.quiz.edit.question', $course->id) }}" id="addQuestion form" name="questionForm" method="post">
                            @csrf
                            <input type="hidden" name="question_id" >
                            <div class="course-list">
                                <div class="shadow mb-3">
                                    <div class="row">
                                        {{-- <div class="col-md-12 inputLabel">
                                            <button type="button" class="btn-primary btn btn-sm my-2" onclick="addNewRow()">Add new row</button>
                                        </div> --}}
                                        <div class="col-md-12">
                                            Question
                                        </div>
                                        <div class="col-md-12 tinymce_container">
                                            <textarea class="tinymce" id="edit" name="question" required>
                                                
                                            </textarea>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Answer</div>
                                            <input type="text" class="input" autocomplete="off" name="answer" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Option 1</div>
                                            <input type="text" class="input" autocomplete="off" name="option1" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Option 2</div>
                                            <input type="text" class="input" autocomplete="off" name="option2" required>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Option 3</div>
                                            <input type="text" class="input" autocomplete="off" name="option3" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 submit_container">
                                    <div class="pull-right">
                                        <button type="submit" id="createBtn" style="margin-top: 20px;">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                                
                </div>
    
            </div>
        </div>
      </div>
    {{-- edit question modal ends --}}
    <x-slot name="footer">
        <script src="https://cdn.tiny.cloud/1/zsas5lu2daasop6m83zrnsy0jfirw1qnzwage39n2nz1bd42/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            function filter(inputFilter) {
                let tbody = document.getElementById('users');
                let keyword = inputFilter.toLowerCase();
                let trs = tbody.querySelectorAll('.user');
                trs.forEach((tr) => {
                    let status = false;
                    let tds = tr.querySelectorAll('td');
                    tds.forEach((td) => {
                        let text = td.textContent.toLowerCase();
                        if (text.indexOf(keyword) > -1) {
                            status = true
                        }
                    });
                    if (status) {
                        tr.style.display = ''
                    } else {
                        tr.style.display = 'none';
                    }
                });
            }

            function toggleForm() {
                /* Toggle between hiding and showing the active panel */
                let panel = document.querySelector('.panel');
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            };

            let arr = [];

            function setUsersInputValue(input) {
                var users_input = document.getElementById('users_id');
                if (input.checked == true) {
                    arr.unshift(input.value);
                } else if (input.checked == false && arr.indexOf(input.value) > -1) {
                    arr.splice(arr.indexOf(this.value), 1);
                }
                users_input.value = arr.join(',');
            }

            function addNewRow() {
                // let gdiv = document.createElement('div');
                // let panel = document.querySelector('.panel');
                // gdiv.setAttribute('class', 'grid');
                // let arr = ['question', 'answer', 'option1', 'option2', 'option3'];
                // arr.forEach((ele, index) => {
                //     let div = document.createElement('div');
                //     let label = document.createElement('label');
                //     label.innerHTML = ele.charAt(0).toUpperCase() + ele.slice(1) + ":";
                //     if (opt = ele.match(/option/g)) {
                //         label.innerHTML = opt.toString().charAt(0).toUpperCase() + opt.toString().slice(1) + ` ${index -1}:`;
                //     }
                //     if (index == 1 || index == 2 || index == 3) {
                //         label.setAttribute('class', 'ml-4');
                //     }
                //     let input = document.createElement('input');
                //     input.setAttribute('type', 'text');
                //     if (index == 0) {
                //         input.setAttribute('class', 'form-control form-control-sm mx-2 mb-2');
                //     } else {
                //         input.setAttribute('class', 'form-control form-control-sm mx-2');
                //     }
                //     input.setAttribute('placeholder', `Enter ${ele}`);
                //     input.setAttribute('name', `${ele}[]`);
                //     div.append(label);
                //     div.append(input);
                //     gdiv.append(div);
                // });
                let gdiv = $(`<div class="shadow mb-3">
                                    <div class="row">
                                        <div class="col-md-12 inputLabel">
                                            <button type="button" class="btn-primary btn btn-sm my-2" onclick="addNewRow()">Add new row</button>
                                        </div>
                                        <div class="col-md-12">
                                            Question
                                        </div>
                                        <div class="col-md-12 tinymce_container">
                                            <textarea class="tinymce" name="question[]">
                                                
                                            </textarea>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Answer</div>
                                            <input type="text" class="input" autocomplete="off" name="answer[]">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Option 1</div>
                                            <input type="text" class="input" autocomplete="off" name="option1[]">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Option 2</div>
                                            <input type="text" class="input" autocomplete="off" name="option2[]">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div>Option 3</div>
                                            <input type="text" class="input" autocomplete="off" name="option3[]">
                                        </div>
                                    </div>
                                </div>`)
                                gdiv.insertBefore($('form[name=questionForm] .course-list'))
                                // tinymce.execCommand('mceAddControl',false,'textarea');
                //       console.log(document.questionForm.querySelector('.course-list'))          
                // document.questionForm.querySelector('.course-list').insertBefore(gdiv, document.querySelector('.submit_container'));
                // panel.style.maxHeight = panel.scrollHeight + "px";
            }

            function addNewRowForCourse() {
                let form = document.forms[1];
                let gdiv = document.createElement('div');
                gdiv.setAttribute('class', 'grid');
                let arr = ['course', 'time_limit'];
                arr.forEach((element, index) => {
                    let div = document.createElement('div');
                    let label = document.createElement('label');
                    let input = document.createElement('input');
                    if (index == 0) {
                        label.innerHTML = element.charAt(0).toUpperCase() + element.slice(1) + " Title:";
                        input.setAttribute('type', 'text');
                    } else {
                        label.innerHTML = "Time Limit(mins):";
                        label.setAttribute('class', 'ml-4');
                        input.setAttribute('type', 'number');
                    }
                    input.setAttribute('class', 'form-control form-control-sm mx-2');
                    input.setAttribute('name', `${element}[]`);
                    input.setAttribute('placeholder', `Enter ${element}`);
                    div.append(label);
                    div.append(input);
                    gdiv.append(div);
                });
                form.insertBefore(gdiv, document.getElementById('create'));
                form.style.maxHeight = form.scrollHeight + "px";
            }

            function searchResult(keyword) {
                let divs = document.querySelectorAll('.grid');
                divs.forEach(div => {
                    let status = false;
                    if (div.textContent.toLowerCase().match(keyword.toLowerCase())) {
                        status = true;
                    }

                    if (!status) {
                        div.style.display = 'none';
                    } else {
                        div.style.display = '';
                    }
                });
            }
            tinymce.init({
                selector: 'textarea.tinymce',
                // plugins: 'charmap emoticons lists searchreplace visualblocks wordcount',
                // toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | align lineheight | numlist bullist indent',
                menubar: false,
                height : "180",
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | align lineheight'
            });

            // set edit questoin value for modal
            $('#EditCourseQuizQuestionModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var question_id = button.data('question_id') // Extract info from data-* attributes
                var question = button.data('question') // Extract info from data-* attributes
                var answer = button.data('answer') // Extract info from data-* attributes
                var option1 = button.data('option1') // Extract info from data-* attributes
                var option2 = button.data('option2') // Extract info from data-* attributes
                var option3 = button.data('option3') // Extract info from data-* attributes

                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                tinymce.activeEditor.dom.setHTML(tinymce.activeEditor.dom.select('p'), question);
                modal.find('.tinymce').val(question)
                // modal.find('.modal-body input').val(recipient)
                modal.find('input[name=question_id]').val(question_id)
                modal.find('input[name=answer]').val(answer)
                modal.find('input[name=option1]').val(option1)
                modal.find('input[name=option2]').val(option2)
                modal.find('input[name=option3]').val(option3)
            })
        </script>
    </x-slot>
</x-app-layout>