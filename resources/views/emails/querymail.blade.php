<!DOCTYPE html>
<html lang="en">
<body>
Welcome to SMENiwas!<br>
New Bank Query.<br><br>
-------------- Query Details ------------------<br><br>
<strong>From</strong>    : {{ $from }}<br>
    <strong>To</strong>      : {{ $to }}<br>
@if(isset($loanID) && $loanID != NULL)
        <strong>Loan ID</strong> : {{ $loanID }}<br>
        @endif
            <strong>Subject</strong> : {{ $subject }}<br>
                <strong>Message</strong> : {{ $bodyMessage }}<br>

<br>If you have any questions, please contact us at <a href="mailto:help@smeniwas.com?Subject=First Time User Help" target="_top">help@smeniwas.com</a> or call us on our toll-free number on 1800-1800-800

</body>
</html>
