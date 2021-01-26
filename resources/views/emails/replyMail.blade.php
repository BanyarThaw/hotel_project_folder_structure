<body>
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" width="600">
            @component('mail::panel')
                <div class="content">
                    <div style="background-color: #1ab394;height: 150px;padding: 10px;text-align:center;">
                        <h2>Hotel</h2>
                        <small style="color: black;">Email message from hotel</small>
                    </div>
                    <table class="main" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-wrap">
                            <table  cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td class="content-block">
                                            <h3>Mail Replying</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Dear,{{ $contact_mail->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            {!! $replymessage->reply !!} 
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="footer">
                        <table width="100%">
                            <tr>
                                <td class="aligncenter content-block">Follow <a href="#">@Hotel</a> on Twitter.</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endcomponent
        </td>
        <td></td>
    </tr>
</table>

