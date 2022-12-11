<x-app-layout>
    <x-slot name="styles">
        <style>
                * {
                /* font-size: 16px; */
                    box-sizing: border-box;
                }

                .section {
                    margin-top: 4em;
                    margin-left: 2em;
                    /* width: 100%; */
                }
        </style>
    </x-slot>
    <div class="course">
        @include("components/course_nav")
		<div class="body">
            <div class="row">
                <section class="section">
                    <div class="section-body">
                        @foreach ($questions as $key => $row)
                            <div style="display: flex; column-gap: 1em;">
                                <span>{{ $key + $questions->currentPage() }}.</span> 
                                {!! $row->question !!}
                            </div>
                            @php
                                $options = collect([
                                    $row->answer,
                                    $row->option1,
                                    $row->option2,
                                    $row->option3,
                                ])->shuffle();
                            @endphp
                            @foreach ($options as $key => $option)
                                <div style="display: flex;column-gap: 1em;align-items: center;">
                                    <input type="radio" id="question_{{ $key }}" name="question_{{ $row->id }}" value="{{ $option }}" data-id="{{ $row->id }}">
                                    <label for="question_{{ $key }}">{{ $option }}</label>
                                </div>
                            @endforeach
                        @endforeach
                        <div style="margin-top: 1em">
                            {{ $questions->links() }}
                        </div>
                        <form action="{{ route('quiz.start', [$course->id, $date]) }}" method="post" style="margin-top: 1em">
                            @csrf
                            <input type='hidden' name='selections'>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <script>
            let answer = JSON.parse(window.localStorage.getItem('answer')) || [];
            $('input[type=radio]').each(function(){
                let input = $(this)
                let solved = answer.findIndex(function(b){
                    return b.id == input.data('id') && b.choice == input.val();
                });
                if (solved > -1) {
                    input.prop("checked", true)
                }
                input.on('change', function(){
                    if(input.is(':checked')){
                        let solved = answer.findIndex(function(b){
                            return b.id == input.data('id')
                        });
                        // console.log('solved', solved)
                        if (solved > -1) {
                            answer = answer.filter(c =>  c.id != input.data('id'))
                            // console.log('sorting', answer)
                        }
                        // console.log('before', answer)
                        answer.push({
                            id: input.data('id'),
                            choice: input.val()
                        })
                        // console.log('after', answer)
                        window.localStorage.setItem('answer', JSON.stringify(answer))
                        
                        document.querySelector('input[name=selections]').value = window.localStorage.getItem('answer')
                    }
                })
            })
            document.querySelector('input[name=selections]').value = window.localStorage.getItem('answer')
        </script>
    </x-slot>
</x-app-layout>