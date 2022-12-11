<x-app-layout>
    <x-slot name="styles">
        <style type="text/css">
            

            .box {
                background-color: #ffffff;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #e1e4e8;
                margin-bottom: 10px;
            }

            .courseBody {
                padding: 20px;
            }

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

            .course .cover img {
                border-radius: 10px;
                width: 100%;
                height: 250px;
            }

            .course .cover .body {
                margin-top: -215px;
                color: #000000;
                margin-left: 15px;
                position: relative;
                border-radius: 5px;
                padding-top: 0px;
                color: #ffffff;
                width: 100%;
                overflow: hidden;
            }

            .course .cover .body .td1 {
                font-size: 13px;
                font-weight: bold;
                border: 1px solid rgba(1, 1, 1, 0.1);
                background-color: rgba(1, 1, 1, 0.1);
                padding: 7px;
                width: 110px;
                color: #dcdde1;
                text-align: right;
            }

            .course .cover .body .td2 {
                font-size: 13px;
                padding: 7px;
                border: 1px solid rgba(1, 1, 1, 0.1);
                background-color: rgba(1, 1, 1, 0.1);
                color: #f5f6fa;
            }

            .commnets-area {
                padding: 10px 30px;
                margin-left: 80px;
                margin-right: 30px;
                margin-top: -48px;
                overflow: hidden;
                box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
                background: #fff;
                position: relative;
                border-radius: 10px;
                border: 6px #000000;
                width: (100% - 80px);
            }

            .comment .middle-area .a .button {
                margin-left: 555px;
                margin-top: -55px;
            }

            .comment {
                padding-bottom: 8px;
                margin-bottom: 8px;
                border-bottom: 1px solid #eee;
                font-size: 14px;
                width: 100%;
            }

            .comment .post-info {
                position: relative;
            }

            .comment .post-info .middle-area {
                margin-left: -22px;
                color: solid #000000;
                font-size: 15px;
            }

            .comment .post-info .date {
                margin-left: -5px;
                display: inline-block;
                color: #999;
            }

            .comment-box .send-btn button {
                margin-top: -57px;
                position: relative;
                left: 230px;
                display: inline-block;
            }

            .comment-box .form-control {
                padding: 5px 30px;
                margin-left: 45px;
                margin-top: -40px;
                border-radius: 25px;
                border: 1px solid #eee;
                width: 120%;
                display: inline-block;
                resize: none;
                overflow: hidden;
            }

            .card-body {
                padding: 8px 25px;
                margin-left: 80px;
                margin-right: 30px;
                overflow: hidden;
                box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
                background: #fff;
                position: relative;
                border-radius: 10px;
                border: 6px #000000;
                width: (100% - 80px);
            }

            .card-body .form-control {
                margin-top: 20px;
                border: 1px solid #eee;
                width: 100%;
                resize: none;
            }

            .card-body .send-btn button {
                margin-left: 780px;
                position: relative;
                display: inline-block;
            }

            .reply {
                padding-bottom: 5px;
                margin-bottom: 8px;
                border-bottom: 1px solid #eee;
                font-size: 12px;
                width: 100%;
            }

            .reply .post-info .middle-area {
                margin-left: 55px;
                margin-top: -40px;
                color: solid #000000;
                font-size: 15px;
            }

            .reply .post-info .date {
                margin-left: -5px;
                display: inline-block;
                color: #999;
            }

            .reply .post-info {
                position: relative;
            }

            .reply .get-reply {
                margin-left: 80px;
                font-size: 14px;
                text-align: justify;
                display: inline-block;
            }

            .delete-update a {
                padding: 3px 5px 0 5px;
            }

            .delete-update #floated {
                display: inline-block;
                background-color: #535b99;
                color: red;
                cursor: pointer;
            }

            .reply-delete-update a {
                padding: 3px 5px 0 5px;
            }

            .reply-delete-update #floated {
                display: inline-block;
                background-color: #535b99;
                color: red;
                cursor: pointer;
            }

            .ck-editor__editable_inline {
                min-height: 200px;
            }
        </style>
    </x-slot>
    <div class="container-fluid">
        <div id="body">
            <div class="course" id="course">
                @include('components/course_nav')
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cover">
                                <img src="{{ asset('/img/course_theme/img_read.jpg') }}" style="" />
                                <div class="body">
                                    <font style="font-size: 30px"><b>{{ $course->name }}</b></font>
                                    <table style="width: 300px; margin-top: 10px">
                                        <tbody>
                                            <tr>
                                                <td class="td1">
                                                    <b>Section: </b>
                                                </td>
                                                <td class="td2">{{ $course->section }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td1">
                                                    <b>Subject: </b>
                                                </td>
                                                <td class="td2">{{ $course->subject }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td1">
                                                    <b>Room: </b>
                                                </td>
                                                <td class="td2">{{ $course->room }}</td>
                                            </tr>
                                            <tr>
                                                <td class="td1">
                                                    <b>Course Code: </b>
                                                </td>
                                                <td class="td2">{{ $course->code }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <br />
                    <!-- comment/post send section start-->

                    <script>
                        ClassicEditor.create(document.querySelector("#editor"))
                            .then((editor) => {
                                postEditor = editor; // Save for later use.
                            })
                            .catch((error) => {
                                console.error(error);
                            });
                    </script>

                    <!-- comment/post send section end-->

                    <!-- comment/post display section start -->
                    <a class="avatar" href="#">
                        <img style="
                                border-radius: 100%;
                                border: 1px solid #eeeeee;
                                " width="50" hieght="50"
                            src="{{ asset('/upload/avatars/default_avatar.png') }}" />
                    </a>
                    <div class="commnets-area">
                        @foreach ($course->comments as $comment)  
                            <div class="comment">
                                <div class="post-info">
                                    <div class="middle-area">
                                        <a style="
                                                color: #241571;
                                                font-weight: bolder;
                                            " class="name" href="#"><b>{{ $comment->user->name }}</b></a>
                                        <h6 style="color: #555b57; margin-left: 2px" class="date">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </h6>
                                        <!-- update -->
                                        <div style="float: right" class="delete-update">
                                            <!-- delete -->
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="ck-content" style="
                                            word-break: break-all;
                                            white-space: normal;
                                        ">
                                        <p>
                                            {!! $comment->comment !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- comment/post display section end -->

                        <!-- comment reply display section start-->

                        <div class="btn btn-link">
                            <li data-toggle="collapse" data-target=".multi-collapse_3" aria-expanded="false"
                                aria-controls="commentbox">
                                {{ $course->comments->count() }} class comment
                            </li>
                        </div>
                        <div class="collapse multi-collapse_3" id="commentbox">
                            <a class="profle" href="#">
                                <img style="
                                        border-radius: 100%;
                                        border: 1px solid #eeeeee;
                                    " width="40" hieght="40"
                                    src="{{ asset('/upload/avatars/default_avatar.png') }}" /></a>

                            <div class="reply">
                                <div class="post-info">
                                    <div class="middle-area">
                                        <div style="float: right" class="reply-delete-update">
                                            <!-- update -->
                                        </div>

                                        <a style="
                                                color: #151e3d;
                                                font-weight: 900;
                                            " class="name" href="#"><b>Sylvester Mike</b></a>
                                        <h6 style="
                                                color: #555b57;
                                                margin-left: 2px;
                                            " class="date">
                                            8 months ago
                                        </h6>
                                    </div>
                                </div>
                                <div class="get-reply">
                                    <p id="converted_url">now?</p>
                                </div>
                            </div>
                        </div>
                        <!-- comment reply display section end -->

                        <!-- comment reply send section start -->
                        <div class="reply-section">
                            <img style="
                                    border-radius: 100%;
                                    border: 1px solid #eeeeee;
                                " width="40" hieght="40"
                                src="http://classrooom.test/upload/avatars/default_avatar.png" />
                            <div class="row comment-box-main p-3 rounded-bottom">
                                <div class="col-md-9 col-sm-9 col-9 pr-0 comment-box">
                                    <form id='reply_comment' method="post" action="{{ route('courses.comment.store', $course->id) }}" >
                                        <div class="form-group">
                                            @csrf
                                            <textarea id="comment_reply_3" name="comment" cols="10" wrap="pysical"
                                                class="text-area-messge form-control" placeholder="comment..."
                                                aria-required="true" aria-invalid="false"></textarea>
                                        </div>
                                        <div style="float: right" class="text-center send-btn">
                                            <button class="btn btn-info" type="submit">
                                                Send
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- comment reply section end-->
                    </div>
                    <!-- commnets-area -->
                    <br />
                    <br />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>