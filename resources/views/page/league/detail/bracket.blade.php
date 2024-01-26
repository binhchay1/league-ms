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
        $count = 1;
        $number = 1;
        @endphp
        @for($i = 0; $i < $totalRow; $i++)
        <tr id="{{ $count }}" style="height: 35px;">
            @if($i % 2 == 0)
            <td class="bb">
                <div class="draw-order">{{ $number }}</div>
            </td>
            <?php $number++; ?>
            @else
            <td></td>
            @endif
            @for($x = 0; $x < $totalColumn; $x++)
            <td></td>
            <td></td>
            @endfor
            <td></td>;
            <td></td>
        </tr>
        <?php $count++; ?>
        @endfor
        </tbody>
    </table>
</div>
