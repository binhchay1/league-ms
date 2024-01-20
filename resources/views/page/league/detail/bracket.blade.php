<div class="item draws">
    <table border="0" cellpadding="0" cellspacing="0" class="tblDrawsSingle">
        <tr>
            <th height="35"></th>
            <th colspan="2">ROUND 1</th>
            <th colspan="2">ROUND 2</th>
            <th colspan="2">QUARTER FINALS</th>
            <th colspan="2">SEMI FINALS</th>
            <th colspan="2">FINALS</th>
            <th colspan="2">WINNER</th>
        </tr>
        <tr>
            <td width="50px" height="15"></td>
            <td width="180px"></td>
            <td width="10px"></td>
            <td width="180px"></td>
            <td width="10px"></td>
            <td width="180px"></td>
            <td width="10px"></td>
            <td width="180px"></td>
            <td width="10px"></td>
            <td width="180px"></td>
            <td width="10px"></td>
            <td width="180px"></td>
            <td width="20px"></td>
        </tr>
        @foreach($listSchedules as $schedule)
        <tr id="1" style="height: 35px;">
            <td class="bb">
                <div class="draw-order">1</div>
            </td>
            <td id="col">
                <div class="draw-player-wrap">
                    <div class="line"></div>
                    <div class="draw-player-details-wrap">
                        <div class="draw-player1-wrap">
                            <div class="draw-flag"> <img src="https://extranet.bwf.sport/docs/flags/denmark.png" class=" b-error"> </div>
                            <div class="draw-name"> <a href="https://bwfworldtour.bwfbadminton.com/player/25831/viktor-axelsen" target="_self"> Viktor<br>AXELSEN [1] </a> </div>
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

        <tr id="2" style="height: 35px;">
            <td width="50px" align="center"> </td>
            <td></td>
            <td class="bg-right"></td>
            <td id="col-2" class="">
                <div class="draw-player-wrap">
                    <div class="line"></div>
                    <div class="draw-player-details-wrap">
                        <div class="draw-player1-wrap">
                            <div class="draw-flag"> <img src="https://extranet.bwf.sport/docs/flags/denmark.png" class=" b-error"> </div>
                            <div class="draw-name"> <a href="https://bwfworldtour.bwfbadminton.com/player/25831/viktor-axelsen" target="_self"> Viktor<br>AXELSEN [1] </a> </div>
                        </div>
                    </div>
                </div>
            </td>
            <td class="bottomright" id="2">
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
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
