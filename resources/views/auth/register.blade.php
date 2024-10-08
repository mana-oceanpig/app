<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LuminaMind') }} - @yield('title', 'AIカウンセラー')</title>

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')

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
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Noto Sans JP', 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
        }
        
        .container-fluid {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .card {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            margin: auto;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        .form-floating .form-control {
            border-radius: 10px;
            border: 1px solid var(--light-gray);
        }
        
        .form-floating .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
        }
        
        .form-floating label {
            color: var(--text-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: #357ABD;
            border-color: #357ABD;
        }
        
        .btn-link {
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .btn-link:hover {
            color: #357ABD;
        }
        
        .gradient-button {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            font-weight: bold;
            transition: background 0.3s ease-in-out;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            width: 100%;
        }
        
        .gradient-button:hover {
            background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
        }
        
        .image-container {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            height: 100%;
        }
        
        .image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        
        @media (max-width: 767px) {
            .container-fluid {
                padding: 10px;
            }
            
            .card {
                max-width: 100%;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .image-container {
                display: none;
            }
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row w-100">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="名前">
                                <label for="name">{{ __('呼ばれたい名前') }}</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">
                                <label for="email">{{ __('メールアドレス') }}</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワード">
                                <label for="password">{{ __('パスワード') }}</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="パスワード（確認）">
                                <label for="password-confirm">{{ __('パスワード（確認）') }}</label>
                            </div>
                            
                            <div class="form-check mb-4">
                                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    LuminaMindの<a href="/app/terms-of-service" target="_blank">{{ __('利用規約') }}</a>と<a href="/app/privacy-policy" target="_blank">{{ __('プライバシーポリシー') }}</a>に同意いたします
                                </label>
                                @error('terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg gradient-button">
                                    {{ __('登録') }}
                                </button>
                                <a class="btn btn-link mt-2" href="{{ route('login') }}">
                                    {{ __('既に登録済みの方：ログイン') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-flex bg-gradient align-items-center justify-content-center">
                <div class="image-container">
                    <img src="{{ asset('storage/0710demo_top_V1.3.png') }}" class="img-fluid" alt="Service Image">
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('header');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        
            const faqQuestions = document.querySelectorAll('.faq-question');
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    this.classList.toggle('active');
                    const answer = this.nextElementSibling;
                    if (this.classList.contains('active')) {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                    } else {
                        answer.style.maxHeight = '0';
                    }
                });
            });
        });
    </script>
</body>
</html>
