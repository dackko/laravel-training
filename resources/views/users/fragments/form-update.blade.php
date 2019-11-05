<div class="form-group">
  <label>Select User Type</label>
  <select class="form-control" name="type_id">
    @foreach($userTypes as $userType)
      <option value="{{ $userType->id }}"
              @if($user->type_id === $userType->id) selected @endif >
        {{ $userType->name }}</option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" placeholder="Name"
         value="{{ old('name', $user->name) }}">
  @if($errors->has('name'))
    <span class="alert alert-danger">{{ $errors->first('name') }}</span>
  @endif
</div>
