@component('mail::message')

# Olá  {{ $name }}, seja bem vindo ao {{config('app.name')}}!

Seu cadastro foi realizado com sucesso.

Esperamos que você se divirta bastante em nosso servidor.

Atenciosamente,<br>
<strong>Equipe {{ config('app.name') }}</strong>
@endcomponent
