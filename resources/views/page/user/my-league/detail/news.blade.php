<style>
    .stat-card {
        padding: 1rem;
        color: white;
        border-radius: 0.5rem;
    }
    .stat-card .icon {
        font-size: 2rem;
    }
    .bg-purple { background-color: #6f42c1; }
    .bg-teal { background-color: #20c997; }
    .bg-orange { background-color: #fd7e14; }
    .bg-red { background-color: #dc3545; }
    .map-container {
        height: 250px;
        border-radius: 0.5rem;
        overflow: hidden;
    }
</style>
<div class="container py-4">

    <div class="row g-4">
        <!-- Left Column -->
        <div class="col-lg-3">
            <!-- Top Teams -->
            <div class="card mb-3">
                <div class="card-header bg-secondary text-white fw-bold">{{'Ranking'}}</div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">🥇 ĐÌNH HẢO - HOÀI BẢO <span class="float-end">2 điểm</span></li>
                    <li class="list-group-item">🥈 CƯỜNG - BƠM <span class="float-end">1 điểm</span></li>
                    <li class="list-group-item">🥉 A TUẤN PHAN - CON <span class="float-end">0 điểm</span></li>
                    <div class="card-footer text-center"><a href="">{{'View all'}}</a></div>
                </ul>
            </div>

            <!-- Rounds -->
            <div class="card mb-3">
                <div class="card-header bg-secondary text-white fw-bold">{{'Schedule'}}</div>
                @foreach($firstThreeSchedules as $item)
                 <div class="card-body" style="font-size: 17px">
                     <strong>	⚔️</strong>
                     {{$item->player1Team1->name ?? "" }} - {{$item->player1Team2->name ?? ""}}
                 </div>
                @endforeach
                <div class="card-footer text-center"><a href="{{route('leagueSchedule.info', $leagueInfor->slug)}}">{{'View all'}}</a></div>
            </div>


            <!-- Map -->
            <div class="card">
                <div class="card-header">{{'Location'}}</div>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?..." width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-9">
            <div class="text-center mb-4">
                <img src="{{asset('/images/bg-league.png')}}" alt="Banner" class="img-fluid">
            </div>
            <!-- Stats -->
            <h4 class="fw-bold">📈 {{'General statistics'}}</h4>
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="stat-card bg-secondary">
                        <div class="fw-bold">{{'Total Matches'}}</div>
                        <div class="display-6">🎮 <h5 class="card-title text-white">{{$countMatch. " matches"}}</h5></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-teal">
                        <div class="fw-bold">{{'Total Players'}}</div>
                        <div class="display-6 row">
                            👥
                            <h5 class="card-title text-white">{{$countPlayer . " players"}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-red">
                        <div class="fw-bold">{{'Highest Ranked Team'}}</div>
                        <div class="display-6">🔥<h5 class="card-title text-white">Đình Hảo - Hoài Bảo (62)</h5></div>

                    </div>
                </div>
            </div>

            <!-- Extra Stats -->
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <p class="fw-bold">{{'Lowest Ranked Team'}}</p>
                            <div class="display-6">🔻
                                <h5 class="card-title text-white">Đình Hảo - Hoài Bảo (62)</h5></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
