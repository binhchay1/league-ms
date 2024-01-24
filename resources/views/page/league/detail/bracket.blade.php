<div class="item draws">
    <table border="0" cellpadding="0" cellspacing="0" class="tblDrawsSingle">
        <tr>
            <th height="35"></th>
            @foreach($displayRound as $round)
            <th colspan="2">{{ strtoupper($round) }}</th>
            @endforeach
            <th colspan="2">WINNER</th>
        </tr>
        <tr>
            <td width="50px" height="15"></td>
            @for($i = 0; $i < count($displayRound); $i++)
            <td width="180px"></td>
            <td width="10px"></td>
            @endfor
            <td width="180px"></td>
            <td width="20px"></td>
        </tr>
        @for($i = 0; $i < count($listSchedules) * 2; $i++)
        @if($i % 2 == 0)
        <tr id="{{ $i }}" style="height: 35px;">
            <td class="bb">
                <div class="draw-order">{{ $i }}</div>
            </td>
            <td id="col" class="">
                <div class="draw-player-wrap">
                    <div class="line"></div>
                    <div class="draw-player-details-wrap">
                        <div class="draw-player1-wrap">
                            <div class="draw-flag"> <img src="https://extranet.bwf.sport/docs/flags/denmark.png" class=" b-error"> </div>
                            <div class="draw-name"> <a href="https://bwfworldtour.bwfbadminton.com/player/25831/viktor-axelsen" target="_self"> {{ $listSchedules[$i / 2]->player1Team1->name }} [1] </a> </div>
                        </div>
                    </div>
                </div>
            </td>
            <td class="bottomright" id="1">
                <div>&nbsp;</div>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endif
        @endfor
        </tbody>
    </table>
</div>
