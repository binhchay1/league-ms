<?php

use App\Enums\Utility;
use App\Enums\Ranking as Ranking;

$utility = new Utility();
?>

<table>
    <tbody>
        <tr>
            <td colspan="50" style="text-align: center;">{{ __('Mẫu số ') }} {{ $schedule->match }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold">{{ __('Nội dung') }}:</td>
            <td></td>
            <td colspan="5" style="border-bottom: 1px solid black">{{ __(Ranking::TYPE_OF_LEAGUE[$league->type_of_league]) }}</td>
            @for($i = 1; $i <= 34; $i++) <td>
                </td>
                @endfor
                <td colspan="4" style="font-weight: bold">{{ __('Thời gian bắt đầu') }}</td>
                <td></td>
                <td colspan="4" style="border-bottom: 1px solid black">{{ $schedule->time }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold">{{ __('Vòng') }}:</td>
            <td></td>
            <td colspan="5" style="border-bottom: 1px solid black"> {{ $schedule->round }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="11" style="border: 1px solid black;"></td>
            @for($i = 1; $i <= 6; $i++) <td>
                </td>
                @endfor
                <td colspan="11" style="border: 1px solid black;" bgcolor="gray"></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="4" style="font-weight: bold">{{ __('Thời gian kết thúc') }}</td>
                <td></td>
                <td colspan="4" style="border-bottom: 1px solid black">{{ $schedule->time }}</td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold">{{ __('Mã số trận') }}:</td>
            <td></td>
            <td colspan="5" style="border-bottom: 1px solid black">{{ $utility->encode_hash_id($league->id) }}</td>
            <td></td>
            <td style="border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black"></td>
            <td style="border-top: 1px solid black; border-bottom: 1px solid black"></td>
            <td colspan="11" style="border: 1px solid black; text-align: center;">{{ isset($schedule->player1Team1) ? $schedule->player1Team1->name : '' }}</td>
            <td colspan="2" style="border: 1px solid black; text-align: center; font-weight: bold;">{{ isset($schedule->set_1_team_1) ? $schedule->set_1_team_1 : '' }}</td>
            <td colspan="2" rowspan="2" style="font-weight: bold;" valign="center" align="center">{{ __('V/S') }}</td>
            <td colspan="2" style="border: 1px solid black; text-align: center; font-weight: bold;">{{ isset($schedule->set_1_team_2) ? $schedule->set_1_team_2 : '' }}</td>
            <td colspan="11" style="border: 1px solid black; text-align: center;" bgcolor="gray">{{ isset($schedule->player1Team2) ? $schedule->player1Team2->name : '' }}</td>
            <td style="border-top: 1px solid black; border-bottom: 1px solid black"></td>
            <td style="border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black"></td>
            <td></td>
            <td colspan="5" style="font-weight: bold">{{ __('Tổng thời gian (p)') }}:</td>
            <td colspan="4" style="border-bottom: 1px solid black"></td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold">{{ __('Ngày') }}:</td>
            <td></td>
            <td colspan="5" style="border-bottom: 1px solid black">{{ $schedule->date }}</td>
            <td></td>
            <td style="border-left: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black;"></td>
            <td style="border-top: 1px solid black; border-bottom: 1px solid black;"></td>
            <td colspan="11" style="border: 1px solid black; text-align: center;">{{ isset($schedule->player2Team1) ? $schedule->player2Team1->name : '' }}</td>
            <td colspan="2" style="border: 1px solid black; font-weight: bold; text-align: center;">{{ isset($schedule->set_2_team_1) ? $schedule->set_2_team_1 : '' }}</td>
            <td colspan="2" style="border: 1px solid black; font-weight: bold; text-align: center;">{{ isset($schedule->set_2_team_2) ? $schedule->set_2_team_2 : '' }}</td>
            <td colspan="11" style="border: 1px solid black; text-align: center;" bgcolor="gray">{{ isset($schedule->player2Team2) ? $schedule->player2Team2->name : '' }}</td>
            <td style="border-top: 1px solid black; border-bottom: 1px solid black"></td>
            <td style="border-right: 1px solid black; border-top: 1px solid black; border-bottom: 1px solid black"></td>
            <td></td>
            <td colspan="4" style="font-weight: bold">{{ __('Trọng tài chính') }}:</td>
            <td></td>
            <td colspan="4" style="border-bottom: 1px solid black"></td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold">{{ __('Buổi thi đấu') }}:</td>
            <td></td>
            <td colspan="5" style="border-bottom: 1px solid black"> {{ $schedule->time }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="11" style="border: 1px solid black;"></td>
            <td colspan="2" style="border: 1px solid black; text-align: center; font-weight: bold;">{{ isset($schedule->set_3_team_1) ? $schedule->set_3_team_1 : '' }}</td>
            <td></td>
            <td></td>
            <td colspan="2" style="border: 1px solid black; text-align: center; font-weight: bold;">{{ isset($schedule->set_3_team_2) ? $schedule->set_3_team_2 : '' }}</td>
            <td colspan="11" style="border: 1px solid black;" bgcolor="gray"></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="5" style="font-weight: bold">{{ __('Trọng tài giao cầu') }}:</td>
            <td colspan="4" style="border-bottom: 1px solid black"></td>
        </tr>
        <tr>
            <td colspan="3" style="font-weight: bold">{{ __('Sân') }}:</td>
            <td></td>
            <td colspan="5" style="border-bottom: 1px solid black">{{ $schedule->stadium }}</td>
            @for($i = 1; $i <= 34; $i++)
            <td></td>
            @endfor
            <td colspan="5" style="font-weight: bold">{{ __('Số lượng cầu sử dụng') }}:</td>
            <td colspan="4" style="border-bottom: 1px solid black"></td>
        </tr>
        <tr></tr>
        @for($k = 1; $k <= 4; $k++)
        @php if($k == 2) { @endphp
        <tr style="border-bottom: 2px solid black;">
            <td colspan="9" style="border-bottom: 1px solid black; border-top: 1px double black; border-right: 1px solid black">{{ isset($schedule->player1Team1) ? $schedule->player1Team1->name : '' }}</td>
            <td colspan="2" style="border-bottom: 1px solid black; border-top: 1px double black;"></td>
            @for($i = 1; $i <= 41; $i++)
            <td style="border-top: 1px double black; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;"></td>
            @endfor
        </tr>
        @php } else { @endphp
        <tr>
            <td colspan="9" style="border-bottom: 1px solid black; border-top: 1px double black; border-right: 1px solid black">{{ isset($schedule->player1Team1) ? $schedule->player1Team1->name : '' }}</td>
            <td colspan="2" style="border-bottom: 1px solid black; border-top: 1px double black;"></td>
            @for($i = 1; $i <= 41; $i++)
            <td style="border-top: 1px double black; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;"></td>
            @endfor
        </tr>
        @php } @endphp
        @endfor
        <tr></tr>

        @for($t = 1; $t <= 4; $t++)
        @php if($t == 2) { @endphp
        <tr style="border-bottom: 2px solid black;">
            <td colspan="9" style="border-bottom: 1px solid black; border-top: 1px double black; border-right: 1px solid black">{{ isset($schedule->player1Team1) ? $schedule->player1Team1->name : '' }}</td>
            <td colspan="2" style="border-bottom: 1px solid black; border-top: 1px double black;"></td>
            @for($i = 1; $i <= 41; $i++)
            <td style="border-top: 1px double black; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;"></td>
            @endfor
        </tr>
        @php } else { @endphp
        <tr>
            <td colspan="9" style="border-bottom: 1px solid black; border-top: 1px double black; border-right: 1px solid black">{{ isset($schedule->player1Team1) ? $schedule->player1Team1->name : '' }}</td>
            <td colspan="2" style="border-bottom: 1px solid black; border-top: 1px double black;"></td>
            @for($i = 1; $i <= 41; $i++)
            <td style="border-top: 1px double black; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;"></td>
            @endfor
        </tr>
        @php } @endphp
        @endfor
        <tr></tr>

        @for($j = 1; $j <= 4; $j++)
        @php if($j == 2) { @endphp
        <tr style="border-bottom: 2px solid black;">
            <td colspan="9" style="border-bottom: 1px solid black; border-top: 1px double black; border-right: 1px solid black">{{ isset($schedule->player1Team1) ? $schedule->player1Team1->name : '' }}</td>
            <td colspan="2" style="border-bottom: 1px solid black; border-top: 1px double black;"></td>
            @for($i = 1; $i <= 41; $i++)
            <td style="border-top: 1px double black; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;"></td>
            @endfor
        </tr>
        @php } else { @endphp
        <tr>
            <td colspan="9" style="border-bottom: 1px solid black; border-top: 1px double black; border-right: 1px solid black">{{ isset($schedule->player1Team1) ? $schedule->player1Team1->name : '' }}</td>
            <td colspan="2" style="border-bottom: 1px solid black; border-top: 1px double black;"></td>
            @for($i = 1; $i <= 41; $i++)
            <td style="border-top: 1px double black; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;"></td>
            @endfor
        </tr>
        @php } @endphp
        @endfor
        <tr></tr>
    </tbody>
</table>
