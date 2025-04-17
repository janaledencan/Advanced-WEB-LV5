<x-app-layout>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <div>
        <h1>Manage Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>

                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <form action="{{ route('users.role.update', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="role" class="form-select">
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : ''}}>Admin</option>
                                <option value="professor" {{ $user->role === 'professor' ? 'selected' : ''}}>Professor</option>
                                <option value="student" {{ $user->role === 'student' ? 'selected' : ''}}>Student</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Update Role</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>