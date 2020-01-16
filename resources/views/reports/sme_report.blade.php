@foreach($userPan as $key=>$value)
   @if($value != NULL)
        <table width='75%' border='1' cellpadding='10' cellspacing='0' style="margin-left: 12%;">
            <tbody>
            <tr>
                <th width='50%'>Attribute</th>
                <th width='50%'>Description</th>
            </tr>

            <tr>
                <td width='50%'>User Name</td>
                <td width='50%'>{!! $userPan[$key] !!}</td>
            </tr>

            <tr>
                <td width='50%'>Name of Firm</td>
                <td width='50%'>{!! $companyNature[$key] !!}</td>
            </tr>
            <tr>
                <td width='50%'>Email Id</td>
                <td width='50%'>{!! $emailId[$key] !!}</td>
            </tr>

            <tr>
                <td width='50%'>Type of Entity</td>
                <td width='50%'>{!! $entityType[$key] !!}</td>
            </tr>
            <tr>
                <td width='50%'>Registered Address</td>
                <td width='50%'>{!! $address[$key] !!}</td>
            </tr>
            <tr>
                <td width='50%'>Registered City</td>
                <td width='50%'>{!! $city[$key] !!}</td>
            </tr>
            <tr>
                <td width='50%'>Registered state</td>
                <td width='50%'>{!! $state[$key] !!}</td>
            </tr>
            <tr>
                <td width='50%'>Registered Pin code</td>
                <td width='50%'>{!! $pincode[$key] !!}</td>
            </tr>
            <tr>
                <td width='50%'>Contact details - Mobile Number</td>
                <td width='50%'>{!! $phone[$key] !!}</td>
            </tr>

            <tr>
                <td width='50%'>Latest Turnover Of Firm</td>
                <td width='50%'>{!! $latestTurnover[$key] !!}</td>
            </tr>
            <tr>
                <td width='50%'>Req. Amount of Loan</td>
                <td width='50%'>{!! $requiredAmount[$key] !!}</td>
            </tr>
            </tbody>
        </table>
   @endif
@endforeach










