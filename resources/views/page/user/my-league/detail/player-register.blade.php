
@forelse($registrations as $index => $registration)
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

    @php
        $type = $leagueInfor->type_of_league ?? 'singles';

        function getFullNameWithPartner($registration, $type = 'singles') {
            $name1 = $registration->user->name ?? '---';
            $name2 = $registration->partner->name ?? '';
            return $type === 'doubles' && $name2 ? $name1 . ' + ' . $name2 : $name1;
        }

        function getUserAvatar($registration) {
            return asset($registration->user->profile_photo_path ?? '/images/default-avatar.png');
        }
    @endphp

        <tr>
            <td>{{ $index + 1 }}</td>
            <td class="d-flex align-items-center gap-2">
                <img src="{{ getUserAvatar($registration) }}"
                     alt="avatar" class="rounded-circle" width="40">
                <div>
                    <span class="fw-bold text-success">{{ getFullNameWithPartner($registration, $type) }}</span>
                </div>
            </td>
            <td>
                <span class="text-success fst-italic">{{ $registration->phone ?? 'updating' }}</span>
            </td>
            <td>
                {{ $registration->created_at->format('d/m/Y') }} <br>
                {{ $registration->created_at->format('H:i:s') }}
            </td>
            <td>
            <span class="badge bg-{{ $registration->status == 0 ? 'primary' : 'success' }}">
                {{ $registration->status ? 'Active' : 'Inactive' }}
            </span>
            </td>
        </tr>

    </tbody>
</table>
@empty
    <div class="alert alert-primary">{{"Tournament is updating data."}}</div>

@endforelse
