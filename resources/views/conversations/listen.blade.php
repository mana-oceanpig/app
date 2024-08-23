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
        max-width: 150px;
        margin-bottom: 1rem;
    }
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .assistant-button {
        background-color: var(--primary-blue);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .assistant-button:hover {
        background-color: #2980b9;
    }
    .gradient-button {
        background: linear-gradient(45deg, var(--primary-blue), var(--primary-green));
        border: none;
        color: white;
        font-weight: bold;
        transition: all 0.3s ease;
        border-radius: 25px;
        padding: 0.5rem 1rem;
        cursor: pointer;
    }
    .gradient-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 10px rgba(50, 50, 93, .1), 0 2px 4px rgba(0, 0, 0, .08);
    }
    .btn-group {
        display: flex;
        justify-content: space-between;
        gap: 0.5rem
    }

    .btn {
        flex: 1;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        white-space: nowrap;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .input-group {
        display: flex;
        align-items: flex-end;
        background-color: white;
        border-radius: 25px;
        padding: 0.5rem;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .input-group-append {
        display: flex;
        align-items: center;
        margin-left: 0.5rem;
    }
    
    .input-group-append .btn {
        margin-left: 0.5rem;
    }
    
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 3px solid #f3f3f3;
        border-top: 3px solid #3498db;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    /*モーダル*/
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .theme-group {
        margin-bottom: 20px;
    }

    .theme-group h3 {
        color: var(--primary-blue);
        margin-bottom: 10px;
    }

    .theme-group label {
        display: block;
        margin-bottom: 10px;
        cursor: pointer;
    }

    .theme-group input[type="checkbox"] {
        margin-right: 10px;
    }

    .theme-group input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    #themeForm button[type="submit"] {
        background: linear-gradient(45deg, var(--primary-blue), var(--primary-green));
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    #themeForm button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .skip-button {
        background-color: #f1f1f1;
        color: #333;
        padding: 10px 20px;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .skip-button:hover {
        background-color: #e1e1e1;
    }
    /*フィードバックモーダル*/
    .feedback-scale {
    width: 100%;
    margin: 20px 0;
    position: relative;
    padding: 0 10px;
    }
    .feedback-scale input[type="range"] {
        width: 100%;
        margin: 0;
    }
    .scale-labels {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        position: relative;
        height: 20px; /* ラベルの高さを固定 */
    }
    .scale-labels span {
        position: absolute;
        transform: translateX(-50%);
    }
    .scale-labels span:first-child {
        left: 0;
    }
    .scale-labels span:nth-child(2) {
        left: 50%;
    }
    .scale-labels span:last-child {
        right: 0;
        transform: translateX(50%);
    }
    #selectedScore {
        text-align: center;
        margin: 20px 0;
        font-weight: bold;
    }
    
    #voice-button,
    .btn-primary {
        color: var(--primary-blue);
        padding: 0.75rem;
        font-size: 1.2rem;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    #voice-button:hover,
    .btn-primary:hover {
        background-color: rgba(52, 152, 219, 0.1);
    }
    
    #voice-button.active {
        background-color: var(--primary-blue);
        color: white;
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
    #messages-container {
        max-height: 400px;
        overflow-y: auto;
        padding: 1rem;
        background-color: white;
        border-radius: 15px;
    }
    .message {
        margin-bottom: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        max-width: 80%;
    }
    #message-input {
        border: none;
        outline: none;
        flex: 1;
        min-height: 40px;
        max-height: 120px;
        resize: none;
        padding: 0.5rem;
        font-size: 1rem;
        line-height: 1.5;
        overflow-y: auto;
    }
    
    #thinking-message {
        max-width: 30%;
        background-color: #f1f1f1;
        color: #333;
        align-self: flex-start;
        padding: 0.5rem 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
    }
    .message-user {
        background-color: var(--primary-blue);
        color: white;
        align-self: flex-end;
    }
    .message-counselor {
        max-width: 50%;
        background-color: #f1f1f1;
        color: #333;
        align-self: flex-start;
    }
    .btn-end {
        background: linear-gradient(45deg, var(--primary-green), #27ae60);
        border: none;
        color: white;
    }
    .btn-cancel {
        background: linear-gradient(45deg, var(--primary-orange), #e67e22);
        border: none;
        color: white;
    }
    @media (max-width: 768px) {
        .btn-group {
            flex-direction: column;
        }
        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        .modal-content {
            width: 95%;
            margin: 10% auto;
        }
        .header-container {
            flex-direction: column;
            align-items: center;
        }
        .assistant-button {
            margin-top: 1rem;
        }
    }
</style>

<div class="container py-4">
    <div class="header-container">
        <h1 class="mb-3">今日の対話 - {{ now()->format('m月d日') }}</h1>
        <button id="assistantButton" class="assistant-button">アシスタント</button>
    </div>
    <!-- トークテーマモーダル -->
        <div id="themeModal" class="modal">
            <div class="modal-content">
                <button id="closeThemeModal" class="close-button">✖️</button>
                <h2>今日はどんなことについて話したいですか？</h2>
                <form id="themeForm">
                    <div class="theme-group">
                        <h3>テーマ1</h3>
                        <label><input type="checkbox" name="theme" value="自分とうまく付き合う"> 自分とうまく付き合う（認知の癖や体調面の心配）</label>
                        <label><input type="checkbox" name="theme" value="他者とうまく付き合う"> 他者とうまく付き合う（パートナーシップや人間関係）</label>
                        <label><input type="checkbox" name="theme" value="仕事とうまく付き合う"> 仕事とうまく付き合う（働き方やパフォーマンス）</label>
                        <label><input type="checkbox" name="theme" value="その他1" id="otherTheme1"> その他（自分でテーマを言語化する）</label>
                        <input type="text" id="customTheme1" style="display: none;" placeholder="テーマを入力してください">
                    </div>
                    <div class="theme-group">
                        <h3>テーマ2</h3>
                        <label><input type="checkbox" name="theme" value="感情のコントロール"> 感情のコントロール</label>
                        <label><input type="checkbox" name="theme" value="認知のコントロール"> 認知のコントロール</label>
                        <label><input type="checkbox" name="theme" value="行動のコントロール"> 行動のコントロール</label>
                        <label><input type="checkbox" name="theme" value="その他2" id="otherTheme2"> その他（自分でテーマを言語化する）</label>
                        <input type="text" id="customTheme2" style="display: none;" placeholder="テーマを入力してください">
                    </div>
                    <div class="button-group">
                        <button type="submit" class="gradient-button">選択完了</button>
                        <button type="button" id="skipThemeSelection" class="skip-button">スキップ</button>
                    </div>
                </form>
            </div>
        </div>
    <!-- フィードバックモーダル -->
        <div id="feedbackModal" class="modal" style="display: none;">
            <div class="modal-content">
                <h2>今回のトークテーマに関する感情は何点でしたか？</h2>
                <div class="feedback-scale">
                    <input type="range" id="emotionScore" name="emotionScore" min="-5" max="5" value="0" step="1">
                    <div class="scale-labels">
                        <span>-5</span>
                        <span>0</span>
                        <span>+5</span>
                    </div>
                </div>
                <div id="selectedScore">選択された点数: 0</div>
                <button id="submitFeedback" class="gradient-button">送信</button>
            </div>
        </div>
    
    <div class="card mb-4">
        <div class="card-body">
            <div id="messages-container" class="d-flex flex-column">
                @foreach($messages->reverse() as $message)
                    <div class="message {{ $message->role_id == 1 ? 'message-user' : 'message-counselor' }}">
                        <div><strong>{{ $message->role_id == 1 ? $conversation->user->name : 'Lumina' }}</strong></div>
                        <div>{{ $message->message }}</div>
                        <small class="text-muted">{{ $message->created_at->format('Y-m-d H:i:s') }}</small>
                    </div>
                @endforeach
            </div>
            <div id="thinking-message" class="message message-counselor" style="display: none;">
                <div><strong>Lumina</strong></div>
                <div>...考え中</div>
            </div>
        </div>
    </div>

    <form id="message-form" class="mb-4">
        @csrf
        <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
        <div class="input-group">
            <textarea name="message" id="message-input" class="form-control rounded-pill" required placeholder="メッセージを入力..."></textarea>
            <div class="input-group-append">
                <button type="button" id="voice-button" class="btn btn-outline-primary rounded-pill">
                    <i class="bi bi-mic">️️</i>🎙
                </button>
                <button type="submit" class="btn btn-primary rounded-pill">
                    <i class="bi bi-send"></i>📤️
                </button>
            </div>
        </div>
    </form>

    <div class="btn-group">
        <button id="end-conversation" class="btn btn-end rounded-pill">対話を終了</button>
        <button id="cancel-conversation" class="btn btn-cancel rounded-pill">対話をキャンセル</button>
        <a href="{{ route('conversations.index') }}" class="btn btn-outline-secondary rounded-pill">対話一覧に戻る</a>
    </div>
</div>

<div id="loading-overlay" class="loading-overlay" style="display: none;">
    <div class="loading-spinner"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // DOM要素の取得
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const messagesContainer = document.getElementById('messages-container');
    const thinkingMessage = document.getElementById('thinking-message');
    const endConversationButton = document.getElementById('end-conversation');
    const cancelConversationButton = document.getElementById('cancel-conversation');
    const voiceButton = document.getElementById('voice-button');
    const loadingOverlay = document.getElementById('loading-overlay');
    const emotionScoreInput = document.getElementById('emotionScore');
    const selectedScoreDisplay = document.getElementById('selectedScore');
    const submitFeedbackButton = document.getElementById('submitFeedback');
    const assistantButton = document.getElementById('assistantButton');
    const themeModal = document.getElementById('themeModal');
    const themeForm = document.getElementById('themeForm');
    const closeThemeModal = document.getElementById('closeThemeModal');
    
    let currentConversationId = {{ $conversation->id ?? 'null' }};
    let recognition = null;

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function addMessage(message, isUser = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${isUser ? 'message-user' : 'message-counselor'}`;
        messageDiv.innerHTML = `
            <div><strong>${isUser ? '{{ $conversation->user->name }}' : 'Lumina'}</strong></div>
            <div>${message}</div>
            <small class="text-muted">${new Date().toLocaleString()}</small>
        `;
        messagesContainer.appendChild(messageDiv);
        scrollToBottom();
    }

    function submitMessage(message = null) {
        const messageToSend = message || messageInput.value.trim();
        if (!messageToSend) return;

        if (!message) {
            addMessage(messageToSend, true);
            messageInput.value = '';
            messageInput.style.height = 'auto';
        }
        thinkingMessage.style.display = 'block';
        scrollToBottom();

        sendMessageToServer(messageToSend);
    }

    function sendMessageToServer(message) {
        fetch('{{ route('conversationMessages.store', ['conversation' => $conversation->id]) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                conversation_id: currentConversationId,
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            thinkingMessage.style.display = 'none';
            addMessage(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
            thinkingMessage.style.display = 'none';
            addMessage('エラーが発生しました。もう一度お試しください。');
        });
    }

    function showLoading() {
        loadingOverlay.style.display = 'flex';
    }

    function hideLoading() {
        loadingOverlay.style.display = 'none';
    }

    function showFeedbackModal() {
        document.getElementById('feedbackModal').style.display = 'block';
    }
    
    function hideFeedbackModal() {
        document.getElementById('feedbackModal').style.display = 'none';
    }

    function showThemeModal() {
        themeModal.style.display = 'block';
    }

    function hideThemeModal() {
        themeModal.style.display = 'none';
    }

    messageForm.addEventListener('submit', function(event) {
        event.preventDefault();
        submitMessage();
    });

    messageInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    messageInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && e.ctrlKey) {
            e.preventDefault();
            submitMessage();
        }
    });

    voiceButton.addEventListener('click', function() {
        if (recognition && recognition.running) {
            recognition.stop();
            return;
        }

        if ('webkitSpeechRecognition' in window) {
            recognition = new webkitSpeechRecognition();

            recognition.onstart = function() {
                voiceButton.classList.add('active');
            };

            recognition.onresult = function(event) {
                const transcript = event.results[0][0].transcript;
                messageInput.value = transcript;
            };

            recognition.onend = function() {
                voiceButton.classList.remove('active');
            };

            recognition.onerror = function(event) {
                console.error('音声認識中にエラーが発生しました:', event.error);
                voiceButton.classList.remove('active');
            };

            recognition.start();
        } else {
            alert('ご使用のブラウザは音声入力をサポートしていません。');
        }
    });

    endConversationButton.addEventListener('click', function() {
        if (confirm('対話を終了してもよろしいですか？')) {
            showLoading();
            fetch('{{ route("conversations.complete", $conversation->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                alert(data.message);
                showFeedbackModal();
            })
            .catch(error => {
                hideLoading();
                console.error('Error:', error);
                alert('対話の終了中にエラーが発生しました。');
            });
        }
    });

    cancelConversationButton.addEventListener('click', function() {
        if (confirm('対話をキャンセルしてもよろしいですか？')) {
            showLoading();
            fetch('{{ route('conversations.cancel', $conversation->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                alert(data.message);
                window.location.href = '{{ route("conversations.show", $conversation->id) }}';
            })
            .catch(error => {
                hideLoading();
                console.error('Error:', error);
                alert('対話のキャンセル中にエラーが発生しました。');
            });
        }
    });

    emotionScoreInput.addEventListener('input', function() {
        selectedScoreDisplay.textContent = '選択された点数: ' + this.value;
    });

    submitFeedbackButton.addEventListener('click', function() {
        const score = emotionScoreInput.value;
        showLoading();
        fetch('{{ route("conversations.feedback", $conversation->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ score: score })
        })
        .then(response => response.json())
        .then(data => {
            hideLoading();
            if (data.success) {
                alert('フィードバックありがとうございます！');
                hideFeedbackModal();
                window.location.href = '{{ route("conversations.show", $conversation->id) }}';
            } else {
                throw new Error('フィードバックの送信に失敗しました。');
            }
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            alert('エラーが発生しました。もう一度お試しください。');
        });
    });

    assistantButton.addEventListener('click', showThemeModal);
    closeThemeModal.addEventListener('click', hideThemeModal);

    themeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const selectedThemes = Array.from(themeForm.querySelectorAll('input[name="theme"]:checked'))
            .map(checkbox => checkbox.value)
            .filter(theme => theme !== 'その他1' && theme !== 'その他2');

        const customTheme1 = document.getElementById('customTheme1').value;
        const customTheme2 = document.getElementById('customTheme2').value;

        if (customTheme1) selectedThemes.push(customTheme1);
        if (customTheme2) selectedThemes.push(customTheme2);

        if (selectedThemes.length > 0) {
            const themeMessage = "今回のテーマ: " + selectedThemes.join(", ");
            submitMessage(themeMessage);
            hideThemeModal();
        } else {
            alert('少なくとも1つのテーマを選択してください。');
        }
    });

    scrollToBottom();
});
</script>
@endsection

