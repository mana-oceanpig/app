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
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
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
    }
</style>

<div class="container py-4">
    <div class="text-center mb-4">
        <h1 class="mb-3">今日の対話 - {{ now()->format('m月d日') }}</h1>
    </div>
    <!-- トークテーマモーダル -->
        <div id="themeModal" class="modal">
            <div class="modal-content">
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
                    <button type="submit">選択完了</button>
                </form>
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
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const messagesContainer = document.getElementById('messages-container');
    const thinkingMessage = document.getElementById('thinking-message');
    const summaryContent = document.getElementById('summary-content');
    const endConversationButton = document.getElementById('end-conversation');
    const cancelConversationButton = document.getElementById('cancel-conversation');
    const submitButton = messageForm.querySelector('button[type="submit"]');
    const voiceButton = document.getElementById('voice-button');
    const loadingOverlay = document.getElementById('loading-overlay');
    const themeModal = document.getElementById('themeModal');
    const themeForm = document.getElementById('themeForm');
    const otherTheme1 = document.getElementById('otherTheme1');
    const otherTheme2 = document.getElementById('otherTheme2');
    const customTheme1 = document.getElementById('customTheme1');
    const customTheme2 = document.getElementById('customTheme2');
    
    let currentConversationId = {{ $conversation->id }};

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

    let recognition = null;
    
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
    
    messageForm.addEventListener('submit', function(event) {
        event.preventDefault();
        submitMessage();
    });

    function submitMessage() {
        const message = messageInput.value.trim();
        if (!message) return;

        addMessage(message, true);
        messageInput.value = '';
        messageInput.style.height = 'auto';
        thinkingMessage.style.display = 'block';
        scrollToBottom();

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
            if (data.summary) {
                summaryContent.textContent = data.summary;
            } else {
                addMessage(data.message);
            }
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

    function performAction(url, actionName) {
        showLoading();
        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 10000); // 10秒タイムアウト

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            signal: controller.signal
        })
        .then(response => {
            clearTimeout(timeoutId);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            hideLoading();
            alert(data.message);
            window.location.href = '{{ route('conversations.show', $conversation->id) }}';
        })
        .catch(error => {
            hideLoading();
            console.error('Error:', error);
            if (error.name === 'AbortError') {
                alert(`${actionName}がタイムアウトしました。もう一度お試しください。`);
            } else {
                alert(`${actionName}中にエラーが発生しました。もう一度お試しください。`);
            }
        });
    }

    endConversationButton.addEventListener('click', function() {
        if (confirm('対話を終了してもよろしいですか？')) {
            performAction('{{ route('conversations.complete', $conversation->id) }}', '対話の終了');
        }
    });

    cancelConversationButton.addEventListener('click', function() {
        if (confirm('対話をキャンセルしてもよろしいですか？')) {
            performAction('{{ route('conversations.cancel', $conversation->id) }}', '対話のキャンセル');
        }
    });

    function showThemeModal() {
        themeModal.style.display = 'block';
    }
    
    function hideThemeModal() {
        themeModal.style.display = 'none';
    }
    
    function initiateConversation() {
        fetch('{{ route("conversations.initiate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.conversation_id) {
                currentConversationId = data.conversation_id;
                addMessage(data.message, false);
                setTimeout(() => {
                    showThemeModal();
                }, 1000); // 1秒後にモーダルを表示
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    otherTheme1.addEventListener('change', function() {
        customTheme1.style.display = this.checked ? 'block' : 'none';
    });
    
    otherTheme2.addEventListener('change', function() {
        customTheme2.style.display = this.checked ? 'block' : 'none';
    });
    
    themeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const selectedThemes = Array.from(themeForm.querySelectorAll('input[name="theme"]:checked'))
            .map(checkbox => {
                if (checkbox.value === 'その他1' && customTheme1.value) {
                    return customTheme1.value;
                } else if (checkbox.value === 'その他2' && customTheme2.value) {
                    return customTheme2.value;
                }
                return checkbox.value;
            })
            .filter(theme => theme !== 'その他1' && theme !== 'その他2');
    
        if (selectedThemes.length > 0) {
            sendThemesToOpenAI(selectedThemes);
            hideThemeModal();
        } else {
            alert('少なくとも1つのテーマを選択してください。');
        }
    });
    
    function sendThemesToOpenAI(themes) {
        const themesString = "選択されたテーマ: " + themes.join(", ");
        addMessage(themesString, true);
        
        fetch('{{ route("conversations.submit-themes") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                conversation_id: currentConversationId,
                themes: themes
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.ai_message) {
                addMessage(data.ai_message, false);
            }
        })
        .catch(error => console.error('Error:', error));
    }
    
    // ページロード時に会話を開始
    initiateConversation();
    scrollToBottom();
});
</script>
@endsection

