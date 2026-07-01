<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Book Purchase</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        h2 { color: #b8860b; border-bottom: 1px solid #eee; padding-bottom: 8px; }
        .field { margin-bottom: 12px; }
        .label { font-weight: bold; display: inline-block; min-width: 140px; }
        .value { margin-left: 8px; }
    </style>
</head>
<body>
    <h2>New Book Purchase</h2>
    <p>A reader has purchased a book on the Patrick Okeke website:</p>

    <div class="field"><span class="label">Book:</span><span class="value">{{ $order->book->title ?? 'Unknown' }}</span></div>
    <div class="field"><span class="label">Customer:</span><span class="value">{{ $order->customer_name ?: 'Not provided' }}</span></div>
    <div class="field"><span class="label">Email:</span><span class="value">{{ $order->customer_email }}</span></div>
    <div class="field"><span class="label">Amount paid:</span><span class="value">{{ strtoupper($order->currency) }} {{ number_format((float) $order->amount_paid, 2) }}</span></div>
    <div class="field"><span class="label">Order ID:</span><span class="value">#{{ $order->id }}</span></div>
    <div class="field"><span class="label">Purchased at:</span><span class="value">{{ $order->updated_at?->format('M j, Y g:i A') }}</span></div>

    <p style="margin-top: 24px; font-size: 12px; color: #666;">Sent from Patrick Okeke website book checkout.</p>
</body>
</html>
