<div class="item draws">
    <table border="0" cellpadding="0" cellspacing="0" class="tblDrawsSingle">
        <tr>
            <th height="35"></th>
            @foreach($groupRound as $key => $round)
            <th colspan="2">{{ strtoupper($key) }}</th>
            @endforeach
            <th colspan="2">WINNER</th>
        </tr>
        <tr>
            <td width="50px" height="15"></td>
            @foreach($groupRound as $group)
            <td width="180px"></td>
            <td width="10px"></td>
            @endforeach
            <td width="180px"></td>
            <td width="20px"></td>
        </tr>
        @php
        $count = 0;
        $number = 1;
        $listRate = \App\Enums\League::LIST_RATE[$totalColumn];
        @endphp
        @for($i = 0; $i < $totalRow; $i++) <tr id="{{ $count + 1 }}" style="height: 35px;">
            @if($i % 2 == 0)
            <td class="bb">
                <div class="draw-order">{{ $number }}</div>
            </td>
            <?php $number++; ?>
            @else
            <td></td>
            @endif
            @for($x = 0; $x < $totalColumn; $x++) <td id="col" class="">
                <div class="draw-player-wrap">
                    <div class="line"></div>
                    <div class="draw-player-details-wrap">
                        <div class="draw-player1-wrap">
                            <div class="draw-flag"> <img src="https://extranet.bwf.sport/docs/flags/denmark.png" class=" b-error"> </div>
                            <div class="draw-name"> <a href="https://bwfworldtour.bwfbadminton.com/player/25831/viktor-axelsen" target="_self"> [1] </a> </div>
                        </div>
                    </div>
                </div>
                </td>
                <td class="bottomright" id="{{ $count + 1 }}">
                    <div>&nbsp;</div>
                </td>
                @endfor
                <td></td>
                <td></td>
                </tr>
                <?php $count++; ?>
                @endfor
                </tbody>
    </table>
</div>
