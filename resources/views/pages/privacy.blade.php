@extends('layouts.app')

@section('title', 'Política de Privacidad - Hostal Real La Molina')

@section('content')
<div class="bg-white min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-[#0F0F0F] mb-4">
                Política de <span class="text-[#C9A24D]">Privacidad</span>
            </h1>
            <p class="text-gray-500">Última actualización: {{ date('d/m/Y') }}</p>
        </div>

        <div class="card-premium p-8 md:p-10 prose prose-lg max-w-none">
            <div class="space-y-8">
                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">1. Información que Recopilamos</h2>
                    <p class="text-[#2C2C2C] leading-relaxed">
                        En Hostal Real La Molina, recopilamos información que usted nos proporciona directamente cuando:
                    </p>
                    <ul class="list-disc list-inside text-[#2C2C2C] space-y-2 ml-4">
                        <li>Realiza una reserva en nuestro establecimiento</li>
                        <li>Se registra en nuestro sitio web</li>
                        <li>Hace check-in en nuestro hostal (incluyendo documento de identidad: DNI, CE, Pasaporte, etc.)</li>
                        <li>Se comunica con nosotros por correo electrónico, teléfono o formulario de contacto</li>
                        <li>Registra un reclamo en nuestro libro de reclamaciones</li>
                    </ul>
                    <p class="text-[#2C2C2C] leading-relaxed mt-4">
                        Esta información puede incluir: nombre completo, dirección de correo electrónico, número de teléfono, 
                        dirección postal, <strong>número de documento de identidad (DNI, CE, Pasaporte)</strong>, información de pago 
                        y preferencias de hospedaje.
                    </p>
                    <div class="bg-[#F5EFE6]/50 p-4 rounded-lg mt-4 border-l-4 border-[#C9A24D]">
                        <p class="text-sm text-[#2C2C2C]">
                            <strong>Nota importante:</strong> El documento de identidad es obligatorio para el registro de estadía 
                            según nuestro reglamento interno. Esta información se utiliza únicamente para fines de registro y seguridad.
                        </p>
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">2. Uso de la Información</h2>
                    <p class="text-[#2C2C2C] leading-relaxed">
                        Utilizamos la información recopilada para:
                    </p>
                    <ul class="list-disc list-inside text-[#2C2C2C] space-y-2 ml-4">
                        <li>Procesar y gestionar sus reservas</li>
                        <li>Comunicarnos con usted sobre su estadía</li>
                        <li>Mejorar nuestros servicios y experiencia del cliente</li>
                        <li>Enviar confirmaciones y actualizaciones de reserva</li>
                        <li>Responder a consultas y reclamos</li>
                        <li>Cumplir con obligaciones legales y regulatorias</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">3. Protección de Datos</h2>
                    <p class="text-[#2C2C2C] leading-relaxed">
                        Implementamos medidas de seguridad técnicas y organizativas apropiadas para proteger su información 
                        personal contra acceso no autorizado, alteración, divulgación o destrucción. Sin embargo, ningún método 
                        de transmisión por Internet o almacenamiento electrónico es 100% seguro.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">4. Compartir Información</h2>
                    <p class="text-[#2C2C2C] leading-relaxed">
                        No vendemos, alquilamos ni compartimos su información personal con terceros, excepto:
                    </p>
                    <ul class="list-disc list-inside text-[#2C2C2C] space-y-2 ml-4">
                        <li>Cuando sea necesario para proporcionar nuestros servicios (procesadores de pago, sistemas de reserva)</li>
                        <li>Cuando sea requerido por ley o por orden judicial</li>
                        <li>Con su consentimiento explícito</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">5. Sus Derechos</h2>
                    <p class="text-[#2C2C2C] leading-relaxed">
                        Usted tiene derecho a:
                    </p>
                    <ul class="list-disc list-inside text-[#2C2C2C] space-y-2 ml-4">
                        <li>Acceder a sus datos personales que tenemos en nuestro poder</li>
                        <li>Solicitar la corrección de datos inexactos</li>
                        <li>Solicitar la eliminación de sus datos personales</li>
                        <li>Oponerse al procesamiento de sus datos personales</li>
                        <li>Solicitar la portabilidad de sus datos</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">6. Cookies</h2>
                    <p class="text-[#2C2C2C] leading-relaxed">
                        Nuestro sitio web utiliza cookies para mejorar su experiencia. Las cookies son pequeños archivos de texto 
                        que se almacenan en su dispositivo. Puede configurar su navegador para rechazar cookies, aunque esto puede 
                        afectar algunas funcionalidades del sitio.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">7. Cambios a esta Política</h2>
                    <p class="text-[#2C2C2C] leading-relaxed">
                        Nos reservamos el derecho de actualizar esta política de privacidad en cualquier momento. Le notificaremos 
                        sobre cambios significativos publicando la nueva política en esta página y actualizando la fecha de 
                        "Última actualización".
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">8. Contacto</h2>
                    <p class="text-[#2C2C2C] leading-relaxed">
                        Si tiene preguntas sobre esta política de privacidad o desea ejercer sus derechos, puede contactarnos:
                    </p>
                    <div class="bg-[#F5EFE6] p-6 rounded-lg mt-4">
                        <p class="font-semibold text-[#0F0F0F] mb-2">Hostal Real La Molina</p>
                        <p class="text-[#2C2C2C]">Email: hostalreallamolina@hotmail.com</p>
                        <p class="text-[#2C2C2C]">Teléfono: +51 948 070 603</p>
                        <p class="text-[#2C2C2C]">Dirección: Av. La Molina 688, La Molina, Lima, Perú</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

