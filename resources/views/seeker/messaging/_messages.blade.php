@forelse($messages as $msg)
    @php
        $isMe = $msg->seeker_id === Auth::id() && $msg->subject !== 'Coach Reply';
    @endphp
    <style>
        .content-page{
            width:100%;
        }
      
        #send-btn{
                display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: #6366f1!important;
    color: white;
    border: none;
    border-radius: 0.75rem;
    font-size: 18px;
    cursor: pointer;
    transition: all 250ms ease-in-out;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    flex-shrink: 0;
    padding:0px!important;
        }
           @media (max-width: 768px) {
              #message-container .message-box{
            max-width:200px!important;
        }
            .content{
                padding:0px;
                margin-top:10px;
            }
            .btn-back{
                    width: fit-content;
    font-size: 11px;
    padding: 3px 10px;
    border-radius: 4px;
    /* display: block; */
    margin-left: auto;
            }
            .chat-header{
                gap:4px;
            }
            div#message-container .text-white {
    padding: 12px !important;
    width: max-content;
    display: block;
    margin-left: auto;
}
           }
           </style>
    <div class="d-flex mb-4 {{ $isMe ? 'justify-content-end' : 'justify-content-start' }}">
        <div class="message-wrapper {{ $isMe ? 'text-end' : '' }}" style="max-width: 70%;">
            <div class="message-box p-3 shadow-sm {{ $isMe ? 'bg-primary text-white' : 'bg-white text-dark' }}"
                style="border-radius: 15px; {{ $isMe ? 'border-bottom-right-radius: 0;' : 'border-bottom-left-radius: 0;' }}">
                <p class="mb-0 fs-14">{!! $msg->message !!}</p>
            </div>

            <small class="text-muted font-size-11 mt-1 d-block">
                {{ $msg->created_at->format('h:i A') }}
                @if ($isMe)
                    <i class="mdi mdi-check-all {{ $msg->status === 'read' ? 'text-primary' : 'text-muted' }} ms-1"></i>
                @endif
            </small>
        </div>
    </div>
@empty
    <div class="h-100 d-flex align-items-center justify-content-center flex-column">
        <div class="avatar-lg bg-soft-primary text-primary rounded-circle mb-3 d-flex align-items-center justify-content-center"
            style="width: 80px; height: 80px;">
            <iconify-icon icon="tabler:messages" class="display-5"></iconify-icon>
        </div>
        <h5 class="fw-bold">Start the Conversation</h5>
    </div>
@endforelse
