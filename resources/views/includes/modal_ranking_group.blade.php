<link rel="stylesheet" href="{{ asset('css/page/ranking.css') }}" />
<div class="modal fade" id="rankingModal" tabindex="-1" aria-labelledby="rankingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rankingModalLabel">Ranking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table border="0" cellpadding="0" cellspacing="0" class="rankings-table" width="100%">
                    <thead>
                        <tr height="54">
                            <th align="center" class="text-center">{{ __('RANK') }}</th>
                            <th class="rank-col_no3 text-left">{{ __('PLAYER') }}</th>
                            <th align="center" class="text-center">{{ __('POINTS') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listRankings as $index => $rank)
                        <tr>
                            <td align="center">
                                {{ $index + 1 }}
                            </td>
                            <td align="center">
                                {{ $rank->users->name }}
                            </td>
                            <td align="center">
                                {{ $rank->points }}
                            </td>

                            <td align="center" class="breakdown">
                                <div class="showPopup" id="61628">
                                    <i aria-hidden="true" class="fa fa-bar-chart"></i>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
