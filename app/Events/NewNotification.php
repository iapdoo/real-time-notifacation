<?php

namespace App\Events;

use Carbon\Carbon;

use Illuminate\Broadcasting\InteractsWithSockets;

use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $post_id;
    public $user_id;
    public $comment;
    public $date;
    public $time;
    public $user_name;

    public function __construct($data)
    {
        $this->post_id = $data['post_id'];
        $this->user_id = $data['user_id'];
        $this->comment = $data['comment'];
        $this->user_name = $data['user_name'];
        $this->date = date("Y-m-d", strtotime(Carbon::now()));
        $this->time = date("h:i A", strtotime(Carbon::now()));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['new-notification'];
    }
}
