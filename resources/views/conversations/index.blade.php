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
    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 15px;
    }
    .login-section {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: space-between;
        align-items: stretch;
        margin-bottom: 2rem;
    }
    .login-content {
        flex: 1;
        min-width: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .card-style {
        background-color: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .oasis-container {
        position: relative;
        width: 100%;
        padding-bottom: 100%; /* これにより、高さが幅と同じになります */
        margin-bottom: 0.5rem;
    }
    .oasis-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain; /* これにより、画像が歪まずにコンテナ内に収まります */
        transition: opacity 0.5s ease-in-out;
    }
    .oasis-image.hidden {
        opacity: 0;
    }
    .points-display{
        font-size: 1rem;
        font-weight: bold;
        color: var(--primary-orange);
        margin-bottom: 1rem;
    }
    .streak-display{
        font-size: 1rem;
        font-weight: bold;
        color: var(--primary-orange);
        margin-bottom: 1rem;
        background-color: rgba(255, 255, 255, 0.6); /* 半透明の白色 */
        border-radius: 15px;
        padding: 1rem;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1); /* ふわふわさせる影 */
        margin-bottom: 1rem; /* 適宜調整 */
    }
    .points-display span, .streak-display span{
        display: block;
        font-size: 2rem;
    }
    .points-display small, .streak-display small{
        font-size: 1rem;
    }
    .login-bonus-button {
        background: linear-gradient(45deg, var(--primary-orange), var(--primary-green));
        border: none;
        color: white;
        font-weight: bold;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .login-bonus-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 7px 14px rgba(50, 50, 93, .1), 0 3px 6px rgba(0, 0, 0, .08);
    }
    .talk-button {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: linear-gradient(45deg, var(--primary-blue), var(--primary-green));
        border: none;
        color: white;
        font-weight: bold;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }
    .talk-button:hover {
        transform: scale(1.1);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    .conversations-section {
        width: 100%;
    }
    .conversations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        justify-content: center;
    }
    .card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: none;
    }
    .card-body {
        display: flex;
        flex-direction: column;
        padding: 1.5rem;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    .card-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        color: var(--primary-green);
    }
    .title-container {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .card-text{
        margin-bottom: 0.5rem;
    }
    .card-actions{
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .edit-button, .delete-button {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .edit-button:hover, .delete-button:hover {
        transform: scale(1.2);
    }
    .badge {
        font-size: 0.8rem;
        border-radius: 50px;
        padding: 0.3em 0.6em;
    }
    .btn {
        padding: 0.5rem 1rem;
    }
    h1, h2 {
        color: var(--primary-blue);
    }
    @media (min-width: 768px) {
        .login-section {
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .login-content {
            flex-basis: calc(33.333% - 1rem);
            max-width: calc(33.333% - 1rem);
        }
        .oasis-container, .talk-button-container, .login-bonus-container {
            width: calc(50% - 1rem);
        }
    }
    @media (min-width: 992px) {
    .login-section {
        flex-wrap: nowrap;
        }
    }
    
    @media (max-width: 767px) {
        .login-section {
            flex-direction: column;
        }
        .login-content {
            width: 100%;
            max-width: 300px; /* oasis-containerの最大幅を制限 */
            margin: 0 auto;
        }
    }
</style>

<div class="dashboard-container">
    <div class="login-section">
        <div class="login-content">
            <div class="oasis-container">
                <img src='{{ asset('storage/oasis-level1.png') }}' alt="Oasis Level 1" class="oasis-image" id="oasis-level1">
                <img src='{{ asset('storage/oasis-level2.png') }}' alt="Oasis Level 2" class="oasis-image hidden" id="oasis-level2">
                <img src='{{ asset('storage/oasis-level3.png') }}' alt="Oasis Level 3" class="oasis-image hidden" id="oasis-level3">
                <img src='{{ asset('storage/oasis-level4.png') }}' alt="Oasis Level 4" class="oasis-image hidden" id="oasis-level4">
            </div>
            <div class="points-display">
                累計ポイント：
                <span style="display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 2rem;">{{ $user->points ?? 0 }}</span><small style="font-size: 1rem; margin-left: 0.2rem;">pt</small>
                </span>
            </div>
            <button id="loginBonusBtn" class="login-bonus-button">ログインボーナスを獲得</button>
        </div>
        <div class="login-content">
            <a href="{{ route('conversations.start') }}" class="talk-button">
                話しかける
            </a>
        </div>
        <div class="login-content">
            <div class="streak-display">
                連続ログイン日数：
                <span style="display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 2rem;">{{ $user->login_streak ?? 0 }}</span><small style="font-size: 1rem; margin-left: 0.2rem;">日</small>
                </span>
            </div>
        </div>
    </div>
    <div class="conversations-section">
        <h2 class="text-center mb-4">これまでの対話</h2>
        <div class="conversations-grid">
            @foreach($conversations as $conversation)
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="title-container">
                                <h5 id="title-{{ $conversation->id }}">
                                    @php
                                        $summaryMessage = $conversation->messages()->where('summary', true)->first();
                                        $title = '';
                                        if ($summaryMessage) {
                                            preg_match('/タイトル：(.+?)(?=\s*要約：|$)/u', $summaryMessage->message, $matches);
                                            $title = $matches[1] ?? '';
                                        }
                                        $formattedDate = \Carbon\Carbon::parse($conversation->last_activity_at)->format('m月d日');
                                        echo $title ?: $formattedDate . 'の対話';
                                    @endphp
                                </h5>
                                <button class="edit-button" data-bs-toggle="modal" data-bs-target="#editTitleModal{{ $conversation->id }}" aria-label="編集">
                                    ️🖊️
                                </button>
                            </div>
                            <button type="button" class="delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $conversation->id }}" aria-label="削除">
                                ×️
                            </button>
                        </div>
                        <p class="card-text">
                            <i class="fas fa-clock mr-2" style="color: var(--primary-orange);"></i>
                            {{ \Carbon\Carbon::parse($conversation->last_activity_at)->format('Y年m月d日 H:i') }}
                        </p>
                        <p class="card-text">
                            @if($conversation->status === App\Models\Conversation::STATUS_IN_PROGRESS)
                                <span class="badge bg-primary" style="background-color: var(--primary-blue) !important;">進行中</span>
                            @elseif($conversation->status === App\Models\Conversation::STATUS_COMPLETED)
                                <span class="badge bg-success" style="background-color: var(--primary-green) !important;">完了</span>
                            @elseif($conversation->status === App\Models\Conversation::STATUS_CANCELED)
                                <span class="badge bg-cancel" style="background-color: var(--primary-orange) !important;">キャンセル</span>
                            @else
                                <span class="badge bg-secondary">{{ $conversation->status }}</span>
                            @endif
                        </p>
                        <div class="card-actions">
                            <a href="{{ route('conversations.show', $conversation->id) }}" class="btn btn-outline-primary rounded-pill" style="color: var(--primary-blue); border-color: var(--primary-blue);">詳細を見る</a>
                            @if($conversation->status === App\Models\Conversation::STATUS_IN_PROGRESS)
                                <a href="{{ route('conversations.listen', $conversation->id) }}" class="gradient-button btn rounded-pill">対話を続ける</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @foreach($conversations as $conversation)
    <!-- 編集モーダル -->
    <div class="modal fade" id="editTitleModal{{ $conversation->id }}" tabindex="-1" aria-labelledby="editTitleModalLabel{{ $conversation->id }}" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTitleModalLabel{{ $conversation->id }}">タイトルの編集</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-form-{{ $conversation->id }}" onsubmit="updateTitle(event, {{ $conversation->id }})">
                            <div class="mb-3">
                                <label for="new-title-{{ $conversation->id }}" class="form-label">新しいタイトル</label>
                                <input type="text" class="form-control" id="new-title-{{ $conversation->id }}" value="{{ $summaryMessage ? ($matches[1] ?? '') : '対話 #' . $conversation->id }}">
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!-- 削除確認モーダル -->
    <div class="modal fade" id="deleteModal{{ $conversation->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $conversation->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $conversation->id }}">削除確認</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>本当にこの対話を削除しますか？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <form action="{{ route('conversations.destroy', $conversation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- オンボーディングモーダル -->
    @if($showOnboarding)
    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .modal-content {
            background-color: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        .progress-container {
            display: flex;
            justify-content: center;
            margin: 2rem 0;
        }
        .progress-step {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #E0E0E0;
            margin: 0 5px;
            transition: background-color 0.3s ease;
        }
        .progress-step.active {
            background-color: #4A90E2;
        }
        .content {
            margin-bottom: 2rem;
        }
        .icon {
            font-size: 3rem;
            color: #4A90E2;
            margin-bottom: 1rem;
        }
        .navigation-buttons {
            display: flex;
            justify-content: space-between;
        }
        .nav-button {
            background-color: #4A90E2;
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            font-size: 1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .nav-button:hover {
            background-color: #3570B2;
        }
        .nav-button:disabled {
            background-color: #A0A0A0;
            cursor: not-allowed;
        }
        #start-button {
            background-color: #2ECC71;
        }
        #start-button:hover {
            background-color: #25A25A;
        }
    </style>
    
    <div id="onboardingModal" class="modal-overlay">
        <div class="modal-content">
            <h1>LuminaMindへようこそ</h1>
            <div class="progress-container">
                <div class="progress-step active"></div>
                <div class="progress-step"></div>
                <div class="progress-step"></div>
                <div class="progress-step"></div>
            </div>
            <div class="content">
                <div class="icon">💬</div>
                <h2>自由な対話</h2>
                <p>ポジティブなこと、ネガティブなこと、今日起こったことなど、どんなトピックでも自由に話しかけてください。</p>
            </div>
            <div class="navigation-buttons">
                <button id="back-button" class="nav-button" disabled>戻る</button>
                <button id="next-button" class="nav-button">次へ</button>
            </div>
        </div>
    </div>
    @endif
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loginBonusBtn = document.getElementById('loginBonusBtn');

    function checkLoginStatus() {
        fetch('{{ route("check.login.status") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.streak-display span').textContent = data.loginStreak;
                document.querySelector('.points-display span').textContent = data.totalPoints;
                updateOasisImage(data.totalPoints);
                
                if (data.canClaimBonus) {
                    loginBonusBtn.classList.add('animate-float');
                    loginBonusBtn.textContent = 'ログインボーナスを獲得';
                    loginBonusBtn.disabled = false;
                } else {
                    loginBonusBtn.classList.remove('animate-float');
                    loginBonusBtn.textContent = 'ログインボーナスを獲得済';
                    loginBonusBtn.disabled = true;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('エラーが発生しました: ' + error.message);
        });
    }

    checkLoginStatus();

    loginBonusBtn.addEventListener('click', function() {
        fetch('{{ route("login.bonus") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                document.querySelector('.points-display span').textContent = data.totalPoints;
                updateOasisImage(data.totalPoints);
                this.classList.remove('animate-float');
                this.textContent = 'ログインボーナスを獲得済';
                this.disabled = true;
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('エラーが発生しました。');
        });
    });

    function updateOasisImage(points) {
        const oasisImages = document.querySelectorAll('.oasis-image');
        oasisImages.forEach(img => img.classList.add('hidden'));

        if (points < 100) {
            document.getElementById('oasis-level1').classList.remove('hidden');
        } else if (points < 200) {
            document.getElementById('oasis-level2').classList.remove('hidden');
        } else if (points < 500) {
            document.getElementById('oasis-level3').classList.remove('hidden');
        } else {
            document.getElementById('oasis-level4').classList.remove('hidden');
        }
    }

    // タイトル編集機能
    function updateTitle(event, id) {
        event.preventDefault();
        var newTitle = document.getElementById('new-title-' + id).value;
        
        fetch('{{ route("conversations.updateTitle", ":id") }}'.replace(':id', id), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ title: newTitle })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('HTTP status ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                document.getElementById('title-' + id).textContent = newTitle;
                var modal = bootstrap.Modal.getInstance(document.getElementById('editTitleModal' + id));
                modal.hide();
            } else {
                alert('タイトルの更新に失敗しました。');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('エラーが発生しました: ' + error.message);
        });
    }

    // モーダル起動
    var editModals = document.querySelectorAll('[id^="editTitleModal"]');
    editModals.forEach(function(modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var conversationId = button.closest('.card').querySelector('[id^="title-"]').id.split('-')[1];
            var currentTitle = document.getElementById('title-' + conversationId).textContent.trim();
            document.getElementById('new-title-' + conversationId).value = currentTitle;
        });
    });

    // フォームのsubmitイベントリスナーを設定
    document.querySelectorAll('[id^="edit-form-"]').forEach(function(form) {
        form.addEventListener('submit', function(event) {
            var id = this.id.split('-')[2];
            updateTitle(event, id);
        });
    });

    // 初期Oasis画像の設定
    updateOasisImage({{ $user->points ?? 0 }});
    
    // 新しいオンボーディングモーダル関連のコード
    const steps = [
        {
            icon: '💬',
            title: '自由な対話',
            description: 'ポジティブなこと、ネガティブなこと、今日起こったことなど、どんなトピックでも自由に話しかけてください。'
        },
        {
            icon: '🕒',
            title: 'いつでも利用可能',
            description: '24時間365日いつでも話しかけられますが、毎日少しずつ対話を続けることが大切です。'
        },
        {
            icon: '🤔',
            title: 'ありのままの気持ちを',
            description: '「えーっと...」「うーん...」など、悩んでいる言葉もそのまま伝えてください。納得するまで話し、満足したら「対話を終了」ボタンを押してください。'
        },
        {
            icon: '🔒',
            title: 'プライバシー保護',
            description: 'あなたのプライバシーは完全に守られます。会社や産業医には許可なく情報を開示することはありません。'
        }
    ];

    let currentStep = 0;
    const onboardingModal = document.getElementById('onboardingModal');
    const content = onboardingModal.querySelector('.content');
    const nextButton = document.getElementById('next-button');
    const backButton = document.getElementById('back-button');
    const progressSteps = onboardingModal.querySelectorAll('.progress-step');

    function updateContent() {
        const step = steps[currentStep];
        content.innerHTML = `
            <div class="icon">${step.icon}</div>
            <h2>${step.title}</h2>
            <p>${step.description}</p>
        `;

        progressSteps.forEach((stepEl, index) => {
            stepEl.classList.toggle('active', index <= currentStep);
        });

        backButton.disabled = currentStep === 0;

        if (currentStep === steps.length - 1) {
            nextButton.textContent = '始める';
            nextButton.id = 'start-button';
        } else {
            nextButton.textContent = '次へ';
            nextButton.id = 'next-button';
        }
    }

    nextButton.addEventListener('click', () => {
        if (currentStep < steps.length - 1) {
            currentStep++;
            updateContent();
        } else {
            onboardingModal.style.display = 'none';
            fetch('{{ route("mark.onboarding.seen") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('オンボーディングが完了しました');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });

    backButton.addEventListener('click', () => {
        if (currentStep > 0) {
            currentStep--;
            updateContent();
        }
    });

    // 初期コンテンツの設定
    updateContent();

    // オンボーディングモーダルを表示
    onboardingModal.style.display = 'flex';
});
</script>
@endsection
