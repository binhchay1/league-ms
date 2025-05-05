
<div class="d-flex flex-wrap gap-2 mb-3">
    <span class="badge bg-primary px-3 py-2">
        {{'Inactive'}}: {{ $pendingCount }}
    </span>
    <span class="badge bg-success px-3 py-2">
        {{'Active'}}: {{ $acceptedCount }}
    </span>
</div>
<table class="table table-bordered align-middle text-center">
    <thead class="table-light fw-bold">
    <tr>
        <th>#</th>
        <th>{{'Player'}}</th>
        <th>{{'Phone'}}</th>
        <th>{{'Time Register'}}</th>
        <th>{{'Status'}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($registrations as $index => $registration)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td class="d-flex align-items-center gap-2">
                <img src="{{asset($registration->user->profile_photo_path ?? '/images/default-avatar.png')  }}"
                     alt="avatar" class="rounded-circle" width="40">
                <div>
                    <span class="fw-bold text-success">{{ $registration->user->name }}</span>
                    @if ($registration->partner)
                        <span class="fw-bold text-success">+ {{ $registration->partner->name }}</span>
                    @endif
                </div>
            </td>
            <td>
                <span class="text-success fst-italic">{{$registration->phone ?? 'updating'}}</span>
            </td>
            <td>
                {{ $registration->created_at->format('d/m/Y') }} <br>
                {{ $registration->created_at->format('H:i:s') }}
            </td>
            <td>
                <span class="badge bg-{{$registration->status == 0 ? 'primary' : 'success' }}">{{$registration->status ? "Active " : "Inactive "}}</span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
