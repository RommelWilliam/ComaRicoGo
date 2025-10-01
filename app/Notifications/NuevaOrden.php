<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaOrden extends Notification
{
    use Queueable;

    protected $orden;

    public function __construct($orden)
    {
        $this->orden = $orden;
    }

    public function via($notifiable)
    {
        
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'orden_id' => $this->orden->id,
            'total' => $this->orden->total,
            'mensaje' => "Se ha asignado una nueva orden con ID {$this->orden->id}",
        ];
    }
}
