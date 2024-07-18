@extends('layouts.app')

@section('content')
<style>
    :root {
        --primary-color: #4A90E2;
        --secondary-color: #2ECC71;
        --background-color: #F8F9FA;
        --text-color: #333333;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    body {
        background-color: var(--background-color);
        color: var(--text-color);
    }

    .usage-guide {
        max-width: 800px;
        margin: 3rem auto;
        padding: 2rem;
        background-color: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
    }

    .usage-guide h1 {
        color: var(--primary-color);
        font-size: 2.5rem;
        margin-bottom: 2rem;
        text-align: center;
        font-weight: bold;
    }

    .steps-container {
        display: grid;
        gap: 2rem;
    }

    .step {
        background-color: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .step:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .step .icon {
        font-size: 3.5rem;
        color: var(--primary-color);
        margin-bottom: 1rem;
        text-align: center;
    }

    .step h2 {
        color: var(--secondary-color);
        font-size: 1.8rem;
        margin-bottom: 1rem;
        font-weight: bold;
    }

    .step p {
        font-size: 1.1rem;
        line-height: 1.6;
        color: var(--text-color);
    }

    @media (min-width: 768px) {
        .steps-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="usage-guide">
    <h1>LuminaMindの使い方</h1>
    
    <div class="steps-container">
        <div class="step">
            <div class="icon">💬</div>
            <h2>1. 自由な対話</h2>
            <p>ポジティブなこと、ネガティブなこと、今日起こったことなど、どんなトピックでも自由に話しかけてください。</p>
        </div>

        <div class="step">
            <div class="icon">🕒</div>
            <h2>2. いつでも利用可能</h2>
            <p>24時間365日いつでも話しかけられますが、毎日少しずつ対話を続けることが大切です。</p>
        </div>

        <div class="step">
            <div class="icon">🤔</div>
            <h2>3. ありのままの気持ちを</h2>
            <p>「えーっと...」「うーん...」など、悩んでいる言葉もそのまま伝えてください。納得するまで話し、満足したら「対話を終了」ボタンを押してください。</p>
        </div>

        <div class="step">
            <div class="icon">🔒</div>
            <h2>4. プライバシー保護</h2>
            <p>あなたのプライバシーは安全に守られます。会社や産業医には許可なく情報を開示することはありません。</p>
        </div>
    </div>
</div>
@endsection