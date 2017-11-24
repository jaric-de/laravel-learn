<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewGameMarkdown extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $title)
    {
        $this->user = $user;
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.new_game_markdown');
    }
}
