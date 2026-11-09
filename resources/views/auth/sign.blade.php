@php
    $company = session('company');
    $brand = $company && $company->abrv ? $company->abrv : ($company->name ?? '');
    $legal = $company && $company->name ? $company->name : $brand;
    $line1 = $legal;
    $line2 = '';
    if (preg_match('/^(.*)\s+(LIMITED)$/i', trim($legal), $nameLines)) {
        $line1 = $nameLines[1];
        $line2 = $nameLines[2];
    }
    $logo = $company && $company->logo ? \App\Support\Media::url('classified/company/'.$company->logo) : null;
    $address = $company->comp_add ?? ($company->location ?? '');
    $phone = $company->contact ?? '';
    $mail = $company->email ?? '';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title'){{ $brand ? ' · '.$brand : '' }}</title>
    <style>
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            color: #1c1c1c;
            background: #111;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
        }
        .sign {
            min-height: 100%;
            display: grid;
            grid-template-columns: minmax(320px, 1.05fr) minmax(360px, 0.95fr);
        }
        .sign_aside {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 40px;
            min-height: 100vh;
            padding: 48px 56px 40px;
            overflow: hidden;
            color: #fff;
            background:
                radial-gradient(640px 380px at -8% -10%, rgba(255, 76, 31, 0.42), transparent 62%),
                radial-gradient(420px 280px at 110% 110%, rgba(255, 76, 31, 0.16), transparent 60%),
                #141414;
        }
        .sign_aside::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                repeating-linear-gradient(-28deg, rgba(255, 255, 255, 0.045) 0 1px, transparent 1px 18px);
            mask-image: linear-gradient(180deg, #000 0%, transparent 78%);
            pointer-events: none;
        }
        .sign_brand,
        .sign_meta {
            position: relative;
            z-index: 1;
        }
        .sign_kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 0 0 28px;
            color: #ff8a66;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }
        .sign_kicker::before {
            content: "";
            width: 18px;
            height: 2px;
            background: rgb(255, 76, 31);
        }
        .sign_lockup {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .sign_mark {
            display: grid;
            place-items: center;
            width: 72px;
            height: 72px;
            flex: none;
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.06);
            box-shadow: inset 0 0 0 6px rgba(255, 76, 31, 0.12);
        }
        .sign_mark img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }
        .sign_lockup strong {
            display: block;
            max-width: 16ch;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.035em;
            line-height: 1.05;
            text-transform: uppercase;
        }
        .sign_note {
            max-width: 28ch;
            margin: 28px 0 0;
            color: #c8c9ce;
            font-size: 16px;
            line-height: 1.55;
        }
        .sign_meta {
            display: grid;
            gap: 14px;
            margin: 0;
        }
        .sign_meta div {
            display: grid;
            grid-template-columns: 72px minmax(0, 1fr);
            gap: 12px;
            align-items: baseline;
        }
        .sign_meta dt {
            margin: 0;
            color: rgb(255, 76, 31);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }
        .sign_meta dd {
            margin: 0;
            color: #ececef;
            font-size: 14px;
            line-height: 1.45;
        }
        .sign_panel {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px 28px;
            background:
                linear-gradient(180deg, #fff 0%, #f6f7f8 100%);
        }
        .sign_form {
            width: min(400px, 100%);
        }
        .sign_form h1 {
            margin: 0;
            font-size: 40px;
            font-weight: 800;
            letter-spacing: -0.045em;
        }
        .sign_lead {
            margin: 8px 0 28px;
            color: #6b7280;
            font-size: 15px;
        }
        .sign_field {
            display: block;
            margin: 0 0 16px;
        }
        .sign_field span {
            display: block;
            margin: 0 0 7px;
            font-size: 13px;
            font-weight: 700;
        }
        .sign_control {
            position: relative;
        }
        .sign_control svg {
            position: absolute;
            top: 50%;
            left: 14px;
            width: 18px;
            height: 18px;
            transform: translateY(-50%);
            color: #9aa0a8;
            pointer-events: none;
        }
        .sign_form input {
            width: 100%;
            height: 52px;
            padding: 0 16px 0 44px;
            border: 1px solid #e4e6eb;
            border-radius: 14px;
            background: #fff;
            color: #1c1c1c;
            font-size: 15px;
            font-weight: 500;
            box-shadow: 0 1px 0 rgba(20, 20, 20, 0.02);
        }
        .sign_control.has_reveal input { padding-right: 72px; }
        .sign_form input:focus {
            border-color: rgb(255, 76, 31);
            outline: none;
            box-shadow: 0 0 0 4px rgba(255, 76, 31, 0.12);
        }
        .sign_control:focus-within svg {
            color: rgb(255, 76, 31);
        }
        .sign_reveal {
            position: absolute;
            top: 50%;
            right: 8px;
            height: 34px;
            padding: 0 10px;
            border: 0;
            border-radius: 9px;
            background: transparent;
            color: #6b7280;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .sign_reveal:hover {
            color: #1c1c1c;
            background: #f3f4f6;
        }
        .sign_form button[type="submit"] {
            width: 100%;
            height: 52px;
            margin-top: 6px;
            border: 0;
            border-radius: 14px;
            background: #1c1c1c;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.01em;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(20, 20, 20, 0.16);
        }
        .sign_form button[type="submit"]:hover {
            background: rgb(255, 76, 31);
        }
        .sign_links {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin-top: 18px;
        }
        .sign_links a {
            color: #4b5563;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }
        .sign_links a:hover {
            color: rgb(255, 76, 31);
        }
        .sign_error,
        .sign_ok {
            margin: 0 0 16px;
            padding: 12px 14px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
        }
        .sign_error {
            background: #fff1f0;
            color: #b42318;
        }
        .sign_ok {
            background: #f0fdf4;
            color: #166534;
        }
        @media (max-width: 860px) {
            .sign {
                grid-template-columns: 1fr;
            }
            .sign_aside,
            .sign_panel {
                min-height: 0;
            }
            .sign_aside {
                gap: 28px;
                padding: 32px 24px 28px;
            }
            .sign_lockup strong {
                font-size: 22px;
            }
            .sign_note {
                margin-top: 18px;
            }
            .sign_panel {
                padding: 32px 20px 40px;
            }
            .sign_form h1 {
                font-size: 32px;
            }
        }
    </style>
</head>
<body>
    <main class="sign">
        <aside class="sign_aside">
            <div class="sign_brand">
                <p class="sign_kicker">Staff desk</p>
                <div class="sign_lockup">
                    @if ($logo)
                        <span class="sign_mark"><img src="{{ $logo }}" alt=""></span>
                    @endif
                    @if ($legal)
                        <strong>{{ $line1 }}@if ($line2)<br>{{ $line2 }}@endif</strong>
                    @endif
                </div>
                <p class="sign_note">Vehicles, parts, and customer messages, in one place.</p>
            </div>
            @if ($address || $phone || $mail)
                <dl class="sign_meta">
                    @if ($address)
                        <div>
                            <dt>Address</dt>
                            <dd>{{ $address }}</dd>
                        </div>
                    @endif
                    @if ($phone)
                        <div>
                            <dt>Phone</dt>
                            <dd>{{ $phone }}</dd>
                        </div>
                    @endif
                    @if ($mail)
                        <div>
                            <dt>Email</dt>
                            <dd>{{ $mail }}</dd>
                        </div>
                    @endif
                </dl>
            @endif
        </aside>
        <section class="sign_panel">
            <div class="sign_form">
                <h1>@yield('heading')</h1>
                <p class="sign_lead">@yield('lead')</p>
                @yield('body')
            </div>
        </section>
    </main>
    <script>
        document.querySelectorAll('.sign_reveal').forEach(function (button) {
            button.addEventListener('click', function () {
                var field = this.parentElement.querySelector('input');
                var shown = field.type === 'text';
                field.type = shown ? 'password' : 'text';
                this.textContent = shown ? 'Show' : 'Hide';
            });
        });
    </script>
</body>
</html>
