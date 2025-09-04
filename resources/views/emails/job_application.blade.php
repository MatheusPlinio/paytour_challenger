<x-mail::message>
    Nova Candidatura Recebida

    Nome: {{ $jobApplication->name }}
    E-mail: {{ $jobApplication->email }}
    Telefone: {{ $jobApplication->phone }}
    Cargo Desejado: {{ $jobApplication->desired_position }}
    Escolaridade: {{ $jobApplication->education_level }}
    Observações: {{ $jobApplication->observations ?? '-' }}
    IP de envio: {{ $jobApplication->ip_address }}
    Data e hora: {{ $jobApplication->submitted_at->format('d/m/Y H:i') }}

    Obrigado,
    {{ config('app.name') }}
</x-mail::message>
