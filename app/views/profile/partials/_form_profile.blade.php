
  {{-- Birthdate --}}
  <div class="field-group">
    {{ Form::label('birthdate', 'Birthdate: ') }}
    {{ Form::input('date', 'birthdate') }}
    {{ errorsFor('birthdate', $errors); }}
  </div>

  {{-- Phone Number --}}
  <div class="field-group">
    {{ Form::label('phone', 'Phone Number: ') }}
    {{ Form::text('phone') }}
    {{ errorsFor('phone', $errors); }}
  </div>

  {{-- Address Street --}}
  <div class="field-group">
    {{ Form::label('address_street', 'Address Street: ') }}
    {{ Form::text('address_street') }}
    {{ errorsFor('address_street', $errors); }}
  </div>

  {{-- Address Premise --}}
  <div class="field-group">
    {{ Form::label('address_premise', 'Apt, Suite or Floor: ') }}
    {{ Form::text('address_premise') }}
    {{ errorsFor('address_premise', $errors); }}
  </div>

  {{-- City --}}
  <div class="field-group">
    {{ Form::label('city', 'City: ') }}
    {{ Form::text('city') }}
    {{ errorsFor('city', $errors); }}
  </div>

  {{-- State --}}
  <div class="field-group">
    {{ Form::label('state', 'State: ') }}
    {{ Form::select('state', $states); }}
    {{ errorsFor('state', $errors); }}
  </div>

  {{-- Zip --}}
  <div class="field-group">
    {{ Form::label('zip', 'Zip: ') }}
    {{ Form::text('zip') }}
    {{ errorsFor('zip', $errors); }}
  </div>

  {{-- Gender --}}
  <div class="field-group">
    {{ Form::label('gender', 'Gender: ') }}
    {{ Form::select('gender', array('M' => 'Male', 'F' => 'Female')); }}
    {{ errorsFor('gender', $errors); }}
  </div>

  {{-- Race --}}
  <div class="field-group">
    {{ Form::label('race', 'Race: ') }}
    {{ Form::text('race') }}
    {{ errorsFor('race', $errors); }}
  </div>

  {{-- School --}}
  <div class="field-group">
    {{ Form::label('school', 'School: ') }}
    {{ Form::text('school') }}
    {{ errorsFor('school', $errors); }}
  </div>

  {{-- Grade --}}
  <div class="field-group">
    {{ Form::label('grade', 'Grade: ') }}
    {{ Form::selectRange('grade', 9, 12); }}
    {{ errorsFor('grade', $errors); }}
  </div>
