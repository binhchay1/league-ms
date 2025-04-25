<div class="container mt-4">
    <div class="row">
        @forelse($leagueInfor->userLeagues as $player)
            <div class="col-md-3 mt-4">
                <div class="card text-center border rounded-3 shadow-sm p-3 transition hover-effect">
                    <div class="card-body">
                        <img src="{{ asset($player->user->profile_photo_path ?? '/images/no-image.png') }}"
                             alt="Avatar"
                             class="rounded-circle border img-fluid mb-3"
                             style="width: 100px; height: 100px; object-fit: cover;">

                        <p class="text-success text-black">{{ $player->user->email }}</p>
                        <h5 class="text-success text-black">{{ $player->user->name }}</h5>
                    </div>
                </div>
            </div>
            @empty

            @endforelse
    </div>
</div>

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
