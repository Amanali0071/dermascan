<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The message instance.
     *
     * @var \App\Models\PatientDoctorChat
     */
    public $message;
    public $recipientId;
    public $senderId;
    public $imagePath;
    /**
     * Create a new event instance.
     */
    public function __construct($message, $recipientId, $senderId, $imagePath = null)
    {
        $this->message = $message;
        $this->recipientId = $recipientId;
        $this->senderId = $senderId;
        $this->imagePath = $imagePath;
    }
    public function broadcastOn()
    {
        return new Channel('user.' . $this->recipientId); 
    }
    public function broadcastAs()
    {
        return 'new-message';
    }
    public function broadcastWith()
    {
        $sendername = User::where('id', $this->senderId)->first();
        return [
            'message' => $this->message,
            'sender_id' => $this->senderId,
            'recipient_id' => $this->recipientId,
            'sender_name' => $sendername->first_name,
            'image_path' => $this->imagePath ?? null,
        ];
    }
}
