<style>
    .hover-effect {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, background-color 0.3s ease-in-out;
        background-color: #fff;
    }

    .hover-effect:hover {
        transform: scale(1.05);
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.25);
        background-color: #f8f9fa;
    }
</style>

<div class="container mt-4">
    <div class="row">
        @php
            $type = $leagueInfor->type_of_league ?? 'singles';
        @endphp

        @forelse($leagueInfor->userLeagues as $player)
            <div class="col-md-3 mt-4">
                <div class="card text-center border rounded-3 shadow-sm p-3 transition hover-effect">
                    <div class="card-body">
                        <img src="{{ asset('/images/player-team.jpg') }}"
                             alt="Avatar"
                             class="rounded-circle border img-fluid mb-3"
                             style="width: 100px; height: 100px; object-fit: cover;">
                        <div>
                            <span class="fw-bold text-success">{{ getTeamNameFromUser($player, $type) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-primary">{{ "Tournament is updating data." }}</div>
        @endforelse
    </div>
</div>

