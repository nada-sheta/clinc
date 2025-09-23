@extends('site.app')
@section('title','Ask')
@section('content')

<div class="container py-5" style="max-width: 800px; min-height: 80vh;">
    <div class="card shadow rounded-4">
        <div class="card-header bg-blue text-white">
            <h4 class="m-0">Ask CliNC</h4>
        </div>
        <div class="card-body" id="chat-box" style="height: 500px; overflow-y: auto; width: 100%;">
            <!-- الرسائل هتظهر هنا -->
        </div>
        <div class="card-footer">
            <form id="chat-form" class="form" action="{{ route('ask.send') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" id="message-input" name="message" class="form-control" placeholder="Write your question here..." required autocomplete="off">
                    <button class="btn btn-primary" type="submit">Send Ask</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    #chat-box div {
        line-height: 1.5;
        word-wrap: break-word;
    }
</style>

@endsection

@push('script')
<script>
    let lastMessages = [];
    let shouldAutoScroll = true;
    let isSending = false;

    function fetchMessages() {
        const chatBox = document.getElementById('chat-box');
        chatBox.innerHTML = '';
        lastMessages.forEach(msg => {
            const div = document.createElement('div');
            div.className = `d-flex ${msg.is_from_user ? 'justify-content-end' : 'justify-content-start'} mb-3`;
            div.innerHTML = `
                <div class="px-3 py-2 rounded-4 text-white" style="max-width: 75%; background-color: ${msg.is_from_user ? '#0d6efd' : '#6c757d'};">
                    ${msg.message.replace(/\n/g, '<br>')}
                </div>
            `;
            chatBox.appendChild(div);
        });

        if (shouldAutoScroll) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }

    document.getElementById('chat-box').addEventListener('scroll', function () {
        const chatBox = this;
        const atBottom = chatBox.scrollTop + chatBox.clientHeight >= chatBox.scrollHeight - 10;
        shouldAutoScroll = atBottom;
    });

    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (isSending) return;

        const input = document.getElementById('message-input');
        const message = input.value.trim();
        if (message === '') return;

        isSending = true;
        lastMessages.push({ is_from_user: true, message: message });
        lastMessages.push({ is_from_user: false, message: '⏳ Thinking...' });
        fetchMessages();

        fetch("{{ route('ask.send') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message })
        })
        .then(res => res.json())
        .then(data => {
            // Remove the "Thinking..." message
            lastMessages = lastMessages.filter(m => m.message !== '⏳ Thinking...');
            lastMessages.push(...data);
            fetchMessages();
            input.value = '';
            isSending = false;
        })
        .catch(err => {
            console.error('Error sending message:', err);
            isSending = false;
        });
    });
</script>
@endpush
