<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\MovContaMovimentacao;

class NovaTransferenciaMail extends Mailable
{
    use Queueable, SerializesModels;
    private $transferencia;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MovContaMovimentacao $transferencia)
    {
        $this->transferencia = $transferencia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('PagamentoDesafioIXC')
        ->view('transferencia.mail.index')->with(['transferencia' => $this->transferencia]);
    }
}
