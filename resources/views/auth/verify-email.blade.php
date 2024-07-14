<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LuminaMind') }} - @yield('title', 'メール認証')</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4A90E2;
            --secondary-color: #50E3C2;
            --accent-color: #F5A623;
            --text-color: #333333;
            --background-color: #FFFFFF;
            --light-gray: #F8F8F8;
        }

        body {
            font-family: 'Noto Sans JP', 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        .container-fluid {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
        }

        .card-body {
            padding: 2rem;
        }

        .gradient-button {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            font-weight: bold;
            transition: background 0.3s ease-in-out;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
        }

        .gradient-button:hover {
            background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
        }

        .btn-link {
            color: var(--primary-color);
            font-weight: 600;
        }

        .btn-link:hover {
            color: #357ABD;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row w-100">
            <div class="col-md-6 d-flex align-items-center justify-content-center bg-white">
                <div class="card w-75">
                    <div class="card-body">
                        <h2 class="card-title mb-4">メール認証</h2>
                        
                        <p class="mb-4">
                            {{ __('ご登録ありがとうございます。送信したメールのリンクから、メールアドレスを認証してください。メールの再送をご希望の場合は、以下からお願いいたします。') }}
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success mb-4" role="alert">
                                {{ __('ご登録時に入力されたメールアドレスに新しい認証リンクが送信されました。') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn gradient-button">
                                    {{ __('認証メールを再送信') }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link">
                                    {{ __('ログアウト') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('storage/0710demo_top_V1.3.png') }}" alt="メール認証イメージ画像" style="width: 100%; height: auto; border-radius: 20px;">
            </div>
        </div>
    </div>
</body>
</html>