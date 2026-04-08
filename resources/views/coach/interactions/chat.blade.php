<x-coach-layout title="Chat with {{ $seeker->name }} | BestBusinessCoach">
    <style>
        /* ==================== Page Container ==================== */
        .chat-page-container {
            padding: 2rem;
            background-color: #f9fafb;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ==================== Chat Card ==================== */
        .chat-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 1rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: all 250ms ease-in-out;
        }

        /* ==================== Chat Header ==================== */
        .chat-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
        }

        .seeker-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
        }

        .seeker-avatar {
            position: relative;
            flex-shrink: 0;
        }

        .seeker-avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e0e7ff;
            transition: all 250ms ease-in-out;
        }

        .seeker-info:hover .seeker-avatar img {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px #e0e7ff;
        }

        .seeker-details h5 {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
            margin-bottom: 0.25rem;
        }

        .seeker-details p {
            font-size: 12px;
            color: #6b7280;
            margin: 0;
        }

        .chat-header-actions {
            display: flex;
            gap: 0.5rem;
            flex-shrink: 0;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem;
            background-color: #f3f4f6;
            color: #1f2937;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 250ms ease-in-out;
        }

        .btn-back:hover {
            background-color: #e5e7eb;
            border-color: #d1d5db;
        }

        .btn-back i {
            font-size: 14px;
        }

        /* ==================== Chat Messages Viewport ==================== */
        .chat-viewport {
            flex: 1 1 auto;
            overflow-y: auto;
            padding: 1.5rem;
            background-color: #f9fafb;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .chat-viewport::-webkit-scrollbar {
            width: 6px;
        }

        .chat-viewport::-webkit-scrollbar-track {
            background-color: transparent;
        }

        .chat-viewport::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 3px;
        }

        .chat-viewport::-webkit-scrollbar-thumb:hover {
            background-color: #9ca3af;
        }

        /* ==================== Message Container ==================== */
        .message-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        /* ==================== Chat Message ==================== */
        .chat-message {
            display: flex;
            align-items: flex-end;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
            animation: slideIn 250ms ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .chat-message--sent {
            justify-content: flex-end;
        }

        .chat-message__content {
            max-width: 65%;
            word-wrap: break-word;
        }

        .chat-message__bubble {
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            font-size: 13px;
            line-height: 1.5;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .chat-message__bubble--received {
            background-color: #ffffff;
            color: #1f2937;
            border: 1px solid #e5e7eb;
        }

        .chat-message__bubble--sent {
            background-color: #6366f1;
            color: #ffffff;
        }

        .chat-message__time {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 0.25rem;
        }

        /* ==================== Chat Footer ==================== */
        .chat-footer {
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
            background-color: #ffffff;
            flex-shrink: 0;
        }

        .chat-form {
            display: flex;
            gap: 0.75rem;
            align-items: flex-end;
        }

        .chat-input-wrapper {
            flex: 1;
            position: relative;
        }

        .chat-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 13px;
            background-color: #f9fafb;
            color: #1f2937;
            transition: all 250ms ease-in-out;
            font-family: inherit;
            resize: none;
            max-height: 120px;
        }

        .chat-input:focus {
            outline: none;
            border-color: #6366f1;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px #e0e7ff;
        }

        .chat-input::placeholder {
            color: #9ca3af;
        }

        .btn-send {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            background-color: #6366f1;
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-size: 18px;
            cursor: pointer;
            transition: all 250ms ease-in-out;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            flex-shrink: 0;
        }

        .btn-send:hover:not(:disabled) {
            background-color: #4f46e5;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        .btn-send:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* ==================== Loading State ==================== */
        .message-loading {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            background-color: #f3f4f6;
            border-radius: 0.75rem;
            font-size: 12px;
            color: #6b7280;
        }

        .message-loading span {
            display: inline-block;
            width: 6px;
            height: 6px;
            background-color: #6366f1;
            border-radius: 50%;
            animation: bounce 1.4s infinite;
        }

        .message-loading span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .message-loading span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes bounce {
            0%, 80%, 100% {
                opacity: 0.5;
                transform: scale(0.8);
            }
            40% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* ==================== Empty Chat ==================== */
        .empty-chat {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            text-align: center;
            color: #6b7280;
        }

        .empty-chat__icon {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .empty-chat__title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .empty-chat__text {
            font-size: 13px;
            color: #6b7280;
        }

        /* ==================== Responsive Design ==================== */
        @media (max-width: 1200px) {
            .chat-message__content {
                max-width: 75%;
            }
        }

        @media (max-width: 768px) {
            .chat-page-container {
                padding: 1rem;
                height: auto;
            }

            .chat-card {
                height: calc(100vh - 120px);
            }

            .chat-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .seeker-info {
                width: 100%;
            }

            .chat-header-actions {
                width: 100%;
            }

            .btn-back {
                width: 100%;
                justify-content: center;
            }

            .chat-viewport {
                padding: 1rem;
            }

            .chat-message__content {
                max-width: 85%;
            }

            .chat-input {
                padding: 0.6rem 0.8rem;
                font-size: 12px;
            }

            .btn-send {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .chat-footer {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .chat-page-container {
                padding: 0.5rem;
            }

            .chat-card {
                border-radius: 0.5rem;
            }

            .chat-header {
                padding: 1rem;
            }

            .seeker-details h5 {
                font-size: 14px;
            }

            .seeker-details p {
                font-size: 11px;
            }

            .chat-viewport {
                padding: 0.75rem;
            }

            .chat-message__content {
                max-width: 90%;
            }

            .chat-message__bubble {
                padding: 0.6rem 0.8rem;
                font-size: 12px;
            }

            .chat-footer {
                padding: 0.75rem;
            }

            .chat-form {
                gap: 0.5rem;
            }
        }
    </style>

    <div class="chat-page-container">
        <!-- Chat Card -->
        <div class="chat-card">
            <!-- Chat Header -->
            <div class="chat-header">
                <div class="seeker-info">
                    <div class="seeker-avatar">
                        <img src="{{ asset($seeker->profile_image) ?? asset('assets/images/users/user.avif') }}"
                            alt="{{ $seeker->name }}">
                    </div>
                    <div class="seeker-details">
                        <h5>{{ $seeker->name }}</h5>
                        <p>Connected Seeker</p>
                    </div>
                </div>

                <div class="chat-header-actions">
                    <a href="{{ route('coach.interactions.index') }}" class="btn-back">
                        <i class="mdi mdi-arrow-left"></i>
                        <span>Back to Inbox</span>
                    </a>
                </div>
            </div>

            <!-- Messages Viewport -->
            <div id="coach-chat-viewport" class="chat-viewport">
                <div id="message-container">
                    @include('coach.interactions._messages')
                </div>
            </div>

            <!-- Chat Footer -->
            <div class="chat-footer">
                <form action="{{ route('coach.interactions.store') }}" method="POST" id="coach-chat-form"
                    class="chat-form">
                    @csrf
                    <input type="hidden" name="seeker_id" value="{{ $seeker->id }}">

                    <div class="chat-input-wrapper">
                        <input type="text" name="message" id="chat-input" class="chat-input"
                            placeholder="Type your reply..." required autocomplete="off">
                    </div>

                    <button type="submit" id="send-btn" class="btn-send" title="Send Message">
                        <i class="mdi mdi-send"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                const viewport = document.getElementById('coach-chat-viewport');
                const fetchUrl = "{{ route('coach.interactions.fetch', $seeker->id) }}";

                // Function to scroll to the bottom of the chat
                function scrollToBottom() {
                    viewport.scrollTop = viewport.scrollHeight;
                }

                // Initial scroll to bottom on page load
                setTimeout(scrollToBottom, 100);

                // Dynamic Polling: Fetch new messages every 3 seconds
                function refreshChat() {
                    $.ajax({
                        url: fetchUrl,
                        type: 'GET',
                        success: function(html) {
                            // Check if the user is currently at the bottom before updating
                            const isAtBottom = viewport.scrollTop + viewport.clientHeight >= viewport
                                .scrollHeight - 50;

                            $('#message-container').html(html);

                            if (isAtBottom) {
                                scrollToBottom();
                            }
                        }
                    });
                }

                setInterval(refreshChat, 3000);

                // AJAX Form Submission: Prevent page refresh on send
                $('#coach-chat-form').on('submit', function(e) {
                    e.preventDefault();

                    const form = $(this);
                    const btn = $('#send-btn');
                    const input = $('#chat-input');

                    if (input.val().trim() === '') return false;

                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        beforeSend: function() {
                            btn.prop('disabled', true);
                        },
                        success: function() {
                            input.val(''); // Clear the input field
                            refreshChat(); // Immediately refresh chat to show new message
                            btn.prop('disabled', false);
                            scrollToBottom();
                        },
                        error: function() {
                            btn.prop('disabled', false);
                            alert('Message failed to send. Please try again.');
                        }
                    });
                });

                // Auto-resize textarea as user types (optional enhancement)
                $('#chat-input').on('input', function() {
                    this.style.height = 'auto';
                    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
                });
            });
        </script>
    @endpush
</x-coach-layout>