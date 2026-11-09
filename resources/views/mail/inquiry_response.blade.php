@php
    $who = session('mailTo');
    $note = (string) session('mailMsg');
    $company = session('company');
    $brand = $company && $company->abrv ? $company->abrv : ($company->name ?? '');
    $legal = $company && $company->name ? $company->name : $brand;
    $line1 = $legal;
    $line2 = '';
    if (preg_match('/^(.*)\s+(LIMITED)$/i', trim($legal), $nameLines)) {
        $line1 = $nameLines[1];
        $line2 = $nameLines[2];
    }
    $logo = null;
    if ($company && $company->logo) {
        $logo = \App\Support\Media::url('classified/company/'.$company->logo);
        if ($logo && strpos($logo, '/') === 0) {
            $logo = rtrim(config('app.url'), '/').$logo;
        }
    }
    $site = $company && $company->website ? $company->website : '';
    $phones = $company && $company->contact ? preg_split('/\s*\/\s*/', $company->contact) : [];
@endphp
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>{{ $brand }}</title>
    <style>
        :root { color-scheme: light dark; supported-color-schemes: light dark; }
        body { margin: 0; padding: 0; }
        a { color: #ff4c1f; }
        @media (prefers-color-scheme: dark) {
            .email-bg { background: #111111 !important; }
            .email-card { background: #1c1c1c !important; border-color: #2c2c2c !important; }
            .email-text, .email-text p, .email-text strong { color: #f4f4f5 !important; }
            .email-muted, .email-muted p { color: #a1a1aa !important; }
            .email-rule { background: #2c2c2c !important; }
            .email-link { color: #ff8a66 !important; }
        }
        [data-ogsc] .email-bg { background: #111111 !important; }
        [data-ogsc] .email-card { background: #1c1c1c !important; }
        [data-ogsc] .email-text, [data-ogsc] .email-text p { color: #f4f4f5 !important; }
        [data-ogsc] .email-muted, [data-ogsc] .email-muted p { color: #a1a1aa !important; }
    </style>
</head>
<body class="email-bg" style="margin:0;padding:0;background:#f3f4f6;">
    <div style="display:none;max-height:0;overflow:hidden;mso-hide:all;">{{ \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', $note)), 90) }}</div>
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" class="email-bg" style="background:#f3f4f6;margin:0;padding:0;">
        <tr>
            <td align="center" style="padding:32px 16px;">
                <table role="presentation" width="560" cellpadding="0" cellspacing="0" class="email-card" style="width:560px;max-width:560px;background:#ffffff;border:1px solid #e7e9ee;border-radius:16px;border-collapse:separate;">
                    <tr>
                        <td style="height:4px;background:#ff4c1f;border-radius:16px 16px 0 0;font-size:0;line-height:0;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding:22px 32px 0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Helvetica,Arial,sans-serif;">
                            <table role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    @if ($logo)
                                        <td width="36" valign="middle" style="width:36px;padding:0 12px 0 0;">
                                            <img src="{{ $logo }}" alt="" width="36" height="36" style="display:block;width:36px;height:36px;border:0;">
                                        </td>
                                    @endif
                                    <td valign="middle" class="email-muted" style="color:#5c6570;font-size:13px;font-weight:700;letter-spacing:0.06em;line-height:1.35;text-transform:uppercase;">
                                        {{ $line1 }}@if ($line2)<br>{{ $line2 }}@endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="email-text" style="padding:24px 32px 28px;color:#1c1c1c;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Helvetica,Arial,sans-serif;font-size:16px;line-height:1.65;">
                            <p style="margin:0 0 16px;">Hi {{ $who ?: 'there' }},</p>
                            <p style="margin:0 0 16px;">{!! nl2br(e($note)) !!}</p>
                            <p style="margin:0;">Best regards@if ($brand)<br><strong>{{ $brand }}</strong>@endif</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 32px;">
                            <div class="email-rule" style="height:1px;background:#e7e9ee;font-size:0;line-height:0;">&nbsp;</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="email-muted" style="padding:18px 32px 26px;color:#6b7280;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Helvetica,Arial,sans-serif;font-size:13px;line-height:1.6;">
                            @if ($company && $company->comp_add)
                                <p style="margin:0;">{{ $company->comp_add }}</p>
                            @endif
                            @foreach ($phones as $phone)
                                @if (trim($phone) !== '')
                                    <p style="margin:0;"><a class="email-link" href="tel:{{ preg_replace('/[^\d+]/', '', $phone) }}" style="color:#ff4c1f;text-decoration:none;">{{ trim($phone) }}</a></p>
                                @endif
                            @endforeach
                            @if ($company && $company->email)
                                <p style="margin:0;"><a class="email-link" href="mailto:{{ $company->email }}" style="color:#ff4c1f;text-decoration:none;">{{ $company->email }}</a></p>
                            @endif
                            @if ($site !== '')
                                <p style="margin:8px 0 0;"><a class="email-link" href="{{ $site }}" style="color:#ff4c1f;text-decoration:none;">{{ preg_replace('#^https?://#', '', rtrim($site, '/')) }}</a></p>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
