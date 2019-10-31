@foreach($userTypes as $userType)
  <h1>{{ $userType->name }}</h1>

  <table>
    <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Type</th>
      <th>Email</th>
      <th>Created At</th>
    </tr>
    </thead>

    <tbody>
    @foreach($userType->Users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->UserType->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at->format('H:i, d M Y') }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endforeach