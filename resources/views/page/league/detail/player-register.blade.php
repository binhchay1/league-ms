@if($registrations->isNotEmpty())
    <div class="d-flex flex-wrap gap-2 mb-3">
    <span class="badge bg-primary px-3 py-2" style="font-size: 15px">
        {{'Inactive'}}: {{ $pendingCount }}
    </span>
        <span class="badge bg-success px-3 py-2" style="font-size: 15px">
        {{'Active'}}: {{ $acceptedCount }}
    </span>
    </div>

    @php $type = $leagueInfor->type_of_league ?? 'singles'; @endphp

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
        @foreach($registrations as $index => $registration)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="d-flex align-items-center gap-2">
                    <img src="{{ asset('/league/player-team.jpg')}}"
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
        @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-primary">{{"Tournament is updating data."}}</div>
@endif
