<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PedidoCreado extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;

    public function __construct($pedido)
    {
        $this->pedido = $pedido;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                   ->subject('Nuevo Pedido Creado - ' . $this->pedido->id)
                   ->view('emails.pedido_creado');
    }
}
