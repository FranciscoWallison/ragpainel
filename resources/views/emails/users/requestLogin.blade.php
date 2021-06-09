@component('mail::message')

# Olá!

Entramos em contato por você solicitou uma recuperação do seu login, lembre-se de deletar esse e-mail e salvar o seu login em um lugar seguro.

Login: <strong>{{ $name }}</strong>

Atenciosamente,<br>
<strong>Equipe {{ config('app.name') }}</strong>
@endcomponent
