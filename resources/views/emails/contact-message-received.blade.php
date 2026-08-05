<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Portfolio Enquiry</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111827; }
        .header { background: #800080; color: white; padding: 20px; }
        .content { padding: 20px; }
        .field { margin-bottom: 12px; }
        .label { font-weight: bold; color: #4B5563; font-size: 12px; text-transform: uppercase; }
        .value { margin-top: 4px; }
        .message-box { background: #F9FAFB; border-left: 4px solid #800080; padding: 16px; margin-top: 8px; }
        .footer { font-size: 12px; color: #9CA3AF; padding: 20px; border-top: 1px solid #E5E7EB; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin:0;">New Portfolio Enquiry</h2>
        <p style="margin:4px 0 0;">Received via markjohnnah.com</p>
    </div>
    <div class="content">
        <div class="field">
            <div class="label">From</div>
            <div class="value">{{ $contactMessage->name }} &lt;{{ $contactMessage->email }}&gt;</div>
        </div>
        @if($contactMessage->phone)
        <div class="field">
            <div class="label">Phone</div>
            <div class="value">{{ $contactMessage->phone }}</div>
        </div>
        @endif
        @if($contactMessage->organisation)
        <div class="field">
            <div class="label">Organisation</div>
            <div class="value">{{ $contactMessage->organisation }}</div>
        </div>
        @endif
        <div class="field">
            <div class="label">Subject</div>
            <div class="value">{{ $contactMessage->subject }}</div>
        </div>
        <div class="field">
            <div class="label">Enquiry Type</div>
            <div class="value">{{ $contactMessage->enquiry_type->label() }}</div>
        </div>
        <div class="field">
            <div class="label">Message</div>
            <div class="message-box">{{ $contactMessage->message }}</div>
        </div>
        <div class="field">
            <div class="label">Received</div>
            <div class="value">{{ $contactMessage->created_at->format('d M Y, H:i T') }}</div>
        </div>
    </div>
    <div class="footer">
        This email was sent from your portfolio contact form. Do not reply to this email — use the email address above to respond directly.
    </div>
</body>
</html>
