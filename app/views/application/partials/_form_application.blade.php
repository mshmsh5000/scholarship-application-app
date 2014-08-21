  {{-- Accomplishments --}}
  <div>
    {{ Form::label('accomplishments', 'Accomplishments: ') }}
    {{ Form::textarea('accomplishments') }}
    {{ errorsFor('accomplishments', $errors); }}
  </div>

  {{-- GPA --}}
  <div>
    {{ Form::label('gpa', 'GPA: ') }}
    {{ Form::text('gpa') }}
    {{ errorsFor('gpa', $errors); }}
  </div>


    {{-- Test Type --}}
    <div>
      {{ Form::label('test_type', 'Test Type: ') }}
      {{ Form::select('test_type', array('SAT' => 'SAT', 'ACT' => 'ACT')); }}
      {{ errorsFor('test_type', $errors); }}
    </div>


  {{-- Test Score --}}
  <div>
    {{ Form::label('test_score', 'Test Score: ') }}
    {{ Form::text('test_score') }}
    {{ errorsFor('test_score', $errors); }}
  </div>

  {{-- Activities --}}
  <div>
    {{ Form::label('activities', 'Activities: ') }}
    {{ Form::textarea('activities') }}
    {{ errorsFor('activities', $errors); }}
  </div>

  {{-- Essay 1 --}}
  <div>
    {{ Form::label('essay1', 'Essay 1: ') }}
    {{ Form::textarea('essay1') }}
    {{ errorsFor('essay1', $errors); }}
  </div>


  {{-- Essay 2 --}}
  <div>
    {{ Form::label('essay2', 'Essay 2: ') }}
    {{ Form::textarea('essay2') }}
    {{ errorsFor('essay2', $errors); }}
  </div>
