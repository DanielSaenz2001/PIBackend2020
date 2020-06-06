@component('mail::message')
# Solicitud para Cambiar de contraseña

Presione en el boton para ir a cambiar se contraseña

@component('mail::button', ['url' => 'http://localhost:4200/CambiarContraseña?token='.$token])
Cambiar de Contraseña
@endcomponent

Gracias,<br>
Soporte Tecnico
@endcomponent
