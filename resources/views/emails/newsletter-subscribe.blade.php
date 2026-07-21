<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Newsletter Subscriber</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        h2 { color: #b8860b; border-bottom: 1px solid #eee; padding-bottom: 8px; }
        .field { margin-bottom: 12px; }
        .label { font-weight: bold; display: inline-block; min-width: 120px; }
        .value { margin-left: 8px; }
    </style>
</head>
<body>
    <h2>New Newsletter Subscriber</h2>
    <p>Someone joined the mailing list on the Baeze Publishing website:</p>

    <div class="field"><span class="label">Email:</span><span class="value">{{ $subscriberEmail }}</span></div>

    <p style="margin-top: 24px; font-size: 12px; color: #666;">Sent from the website newsletter form.</p>
</body>
</html>
