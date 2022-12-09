@component('mail::message')
# Hola {{$data['user_name']}}
@component('mail::panel')
Se ha realizado el pago de tu colaboración en la tarea "{{$data['homework_name']}}".
Dejamos adjunto el comprobante del depósito.
@endcomponent
¡Muchas gracias por tu colaboración!

Saludos de YouPartner.
@endcomponent