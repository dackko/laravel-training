<div class="form-group">
  <label>Select User Type</label>
  <select class="form-control" name="type_id">
    @foreach($userTypes as $userType)
      <option value="{{ $userType->id }}">{{ $userType->name }}</option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" placeholder="Name"
         value="{{ old('name') }}">
  @if($errors->has('name'))
    <span class="alert alert-danger">{{ $errors->first('name') }}</span>
  @endif
</div>

<div class="form-group">
  <label for="name">Email Address</label>
  <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid': '' }}" name="email"
         placeholder="Your email" value="{{ old('email') }}">
  @if($errors->has('email'))
    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
  @endif
</div>
<div class="form-group">
  <label for="password">Password</label>
  <input type="password" class="form-control" name="password" placeholder="Password">
</div>

<div class="form-group">
  <label for="password">Password Confirmation</label>
  <input type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation">
  @if($errors->has('password'))
    <div class="alert alert-danger">{{ $errors->first('password') }}</div>
  @endif
</div>
