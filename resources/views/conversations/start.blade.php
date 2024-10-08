@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-blue: #3498db;
        --primary-green: #2ecc71;
        --primary-orange: #f39c12;
        --light-bg: #ecf0f1;
    }
    body {
        background-color: var(--light-bg);
    }
    .logo {
        max-width: 200px;
        margin-bottom: 2rem;
    }
    .gradient-button {
        background: linear-gradient(45deg, var(--primary-blue), var(--primary-green));
        border: none;
        color: white;
        font-weight: bold;
        transition: all 0.3s ease;
        white-space: nowrap;
        padding: 1rem 2rem;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }
    .gradient-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 14px rgba(50, 50, 93, .1), 0 3px 6px rgba(0, 0, 0, .08);
    }
    .card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        border: none;
    }
    h1 {
        color: var(--primary-blue);
    }
    @media (max-width: 992px) {
        .gradient-button {
            padding: 0.9rem 1.8rem;
            font-size: 1.1rem;
        }
        .btn-outline-secondary {
            padding: 0.7rem 1.4rem;
            font-size: 0.95rem;
        }
    }
    @media (max-width: 768px) {
        .gradient-button {
            padding: 0.8rem 1.6rem;
            font-size: 1rem;
        }
        .btn-outline-secondary {
            padding: 0.65rem 1.3rem;
            font-size: 0.9rem;
        }
    }
    
    @media (max-width: 576px) {
        .gradient-button {
            padding: 0.7rem 1.4rem;
            font-size: 0.9rem;
        }
        .btn-outline-secondary {
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
        }
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="mb-4">新しい対話を開始</h1>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body text-center p-5">
                    <p class="mb-4">新しい対話を開始しますか？</p>
                    <form action="{{ route('conversations.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="gradient-button btn rounded-pill">新しい対話を開始</button>
                    </form>
                    <a href="{{ route('conversations.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">対話一覧に戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection