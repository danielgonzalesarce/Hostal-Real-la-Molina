@extends('layouts.app')

@section('title', 'Términos y Condiciones - Hostal Real La Molina')

@section('content')
<div class="bg-white min-h-screen py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-display font-bold text-[#0F0F0F] mb-4">
                Términos y <span class="text-[#C9A24D]">Condiciones</span>
            </h1>
            <p class="text-gray-500">Última actualización: {{ date('d/m/Y') }}</p>
        </div>

        <div class="card-premium p-8 md:p-10 prose prose-lg max-w-none">
            <div class="space-y-8">
                <!-- Introducción -->
                <section>
                    <p class="text-lg text-[#2C2C2C] leading-relaxed italic bg-gradient-to-r from-[#F5EFE6] to-transparent p-6 rounded-xl border-l-4 border-[#C9A24D]">
                        El Hostal Real La Molina le ofrece una cordial bienvenida y una placentera estadía. 
                        Para su mayor comodidad, debe tener en cuenta lo siguiente:
                    </p>
                </section>

                <!-- Reglamento Interno -->
                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-6 flex items-center">
                        <span class="w-2 h-8 bg-gradient-to-b from-[#C9A24D] to-[#B8943F] rounded-full mr-4"></span>
                        Reglamento Interno
                    </h2>
                    
                    <div class="space-y-6">
                        <!-- 1. Documento de Identidad -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">1.</span>
                                Documento de Identidad
                            </h3>
                            <p class="text-[#2C2C2C] leading-relaxed">
                                El huésped debe presentar su documento de identidad (DNI, Carné de Extranjería, Pasaporte, etc.) 
                                al momento del check-in. Este documento es obligatorio para el registro de la estadía.
                            </p>
                        </div>

                        <!-- 2. Check-in y Check-out -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">2.</span>
                                Check-in y Check-out
                            </h3>
                            <div class="space-y-3">
                                <p class="text-[#2C2C2C] leading-relaxed">
                                    <strong>Check-in:</strong> A las <strong class="text-[#C9A24D]">12:00 p.m.</strong> (mediodía)
                                </p>
                                <p class="text-[#2C2C2C] leading-relaxed">
                                    <strong>Check-out:</strong> A las <strong class="text-[#C9A24D]">12:00 p.m.</strong> del día siguiente
                                </p>
                                <p class="text-[#2C2C2C] leading-relaxed">
                                    <strong>Check-in anticipado:</strong> Si desea hacer check-in antes de las 12:00 p.m., 
                                    se aplicará un cargo adicional proporcional a las horas de anticipación.
                                </p>
                            </div>
                        </div>

                        <!-- 3. Objetos de Valor -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">3.</span>
                                Objetos de Valor
                            </h3>
                            <p class="text-[#2C2C2C] leading-relaxed">
                                Todos los objetos de valor deben ser declarados en recepción. De lo contrario, 
                                el Hostal <strong>no se hace responsable</strong> por su pérdida o daño. 
                                Se recomienda utilizar la caja fuerte disponible en recepción.
                            </p>
                        </div>

                        <!-- 4. Aparatos Eléctricos -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">4.</span>
                                Aparatos Eléctricos
                            </h3>
                            <p class="text-[#2C2C2C] leading-relaxed">
                                Está <strong>prohibido</strong> el uso de aparatos eléctricos (planchas, hervidores, etc.) 
                                dentro de las habitaciones por razones de seguridad.
                            </p>
                        </div>

                        <!-- 5. Daños a Propiedad del Hostal -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">5.</span>
                                Daños a Propiedad del Hostal
                            </h3>
                            <p class="text-[#2C2C2C] leading-relaxed">
                                Si se daña alguna propiedad del Hostal, se cobrará el <strong>valor completo</strong> del artículo 
                                o el costo de reparación correspondiente.
                            </p>
                        </div>

                        <!-- 6. Personas No Registradas -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">6.</span>
                                Personas No Registradas
                            </h3>
                            <p class="text-[#2C2C2C] leading-relaxed">
                                Por razones de seguridad, está <strong>prohibido</strong> el ingreso de personas no registradas 
                                a las habitaciones. Si el huésped permite el ingreso de visitantes, debe informarlo a recepción 
                                previamente.
                            </p>
                        </div>

                        <!-- 7. Horario de Visitas -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">7.</span>
                                Horario de Visitas
                            </h3>
                            <div class="space-y-3">
                                <p class="text-[#2C2C2C] leading-relaxed">
                                    El horario de visitas es de <strong class="text-[#C9A24D]">8:00 a.m. a 11:00 p.m.</strong>
                                </p>
                                <p class="text-[#2C2C2C] leading-relaxed">
                                    Después de las 11:00 p.m., se aplicará un cargo adicional de 
                                    <strong class="text-[#C9A24D]">S/ 30.00 por persona</strong> que permanezca en la habitación.
                                </p>
                            </div>
                        </div>

                        <!-- 8. Horario de Limpieza -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">8.</span>
                                Horario de Limpieza
                            </h3>
                            <div class="space-y-3">
                                <p class="text-[#2C2C2C] leading-relaxed">
                                    El horario de limpieza es de <strong class="text-[#C9A24D]">8:00 a.m. a 3:00 p.m.</strong>
                                </p>
                                <p class="text-[#2C2C2C] leading-relaxed">
                                    Después de las 3:00 p.m., <strong>no se realizará</strong> la limpieza de la habitación.
                                </p>
                            </div>
                        </div>

                        <!-- 9. Ruidos -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">9.</span>
                                Ruidos
                            </h3>
                            <p class="text-[#2C2C2C] leading-relaxed">
                                Está <strong>estrictamente prohibido</strong> hacer ruidos que perturben la tranquilidad 
                                de otros huéspedes. Se solicita mantener un ambiente de respeto y consideración.
                            </p>
                        </div>

                        <!-- 10. Personas en Estado de Ebriedad -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">10.</span>
                                Personas en Estado de Ebriedad
                            </h3>
                            <p class="text-[#2C2C2C] leading-relaxed">
                                Está <strong>prohibido</strong> el ingreso de personas en estado de ebriedad al establecimiento. 
                                El Hostal se reserva el derecho de negar el acceso o solicitar la salida de personas 
                                que no cumplan con esta norma.
                            </p>
                        </div>

                        <!-- 11. Fumar -->
                        <div class="bg-[#F5EFE6]/30 p-6 rounded-xl border border-[#C9A24D]/20">
                            <h3 class="text-xl font-display font-bold text-[#0F0F0F] mb-3 flex items-center">
                                <span class="text-[#C9A24D] mr-3">11.</span>
                                Fumar
                            </h3>
                            <div class="space-y-3">
                                <p class="text-[#2C2C2C] leading-relaxed">
                                    Está <strong>prohibido</strong> fumar dentro de las habitaciones y/o pasillos debido a 
                                    sensores de humo instalados en el establecimiento.
                                </p>
                                <p class="text-[#2C2C2C] leading-relaxed">
                                    <strong>Excepción:</strong> Se permite fumar únicamente en la <strong class="text-[#C9A24D]">terraza del 4to piso</strong>.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Reservas -->
                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">Reservas</h2>
                    <div class="space-y-4">
                        <p class="text-[#2C2C2C] leading-relaxed">
                            <strong>•</strong> Todas las reservas están sujetas a disponibilidad y confirmación por parte del establecimiento.
                        </p>
                        <p class="text-[#2C2C2C] leading-relaxed">
                            <strong>•</strong> Los precios mostrados están en soles peruanos (PEN) e incluyen impuestos aplicables.
                        </p>
                        <p class="text-[#2C2C2C] leading-relaxed">
                            <strong>•</strong> El pago puede requerirse al momento de la reserva o a la llegada, según el tipo de reserva.
                        </p>
                    </div>
                </section>

                <!-- Política de Cancelación -->
                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">Política de Cancelación</h2>
                    <div class="space-y-4">
                        <p class="text-[#2C2C2C] leading-relaxed">
                            <strong>•</strong> Cancelaciones realizadas con más de 48 horas de anticipación: reembolso completo.
                        </p>
                        <p class="text-[#2C2C2C] leading-relaxed">
                            <strong>•</strong> Cancelaciones realizadas entre 24 y 48 horas antes: reembolso del 50%.
                        </p>
                        <p class="text-[#2C2C2C] leading-relaxed">
                            <strong>•</strong> Cancelaciones realizadas con menos de 24 horas o no presentación: sin reembolso.
                        </p>
                    </div>
                </section>

                <!-- Responsabilidades -->
                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">Responsabilidades</h2>
                    <div class="space-y-4">
                        <p class="text-[#2C2C2C] leading-relaxed">
                            El huésped es responsable de cualquier daño causado a las instalaciones o equipamiento del establecimiento. 
                            El establecimiento no se hace responsable por interrupciones en los servicios debido a causas de fuerza mayor.
                        </p>
                    </div>
                </section>

                <!-- Modificaciones -->
                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">Modificaciones</h2>
                    <p class="text-[#2C2C2C] leading-relaxed">
                        Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. 
                        Las modificaciones entrarán en vigor al ser publicadas en el sitio web.
                    </p>
                </section>

                <!-- Ley Aplicable -->
                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">Ley Aplicable</h2>
                    <p class="text-[#2C2C2C] leading-relaxed">
                        Estos términos y condiciones se rigen por las leyes de la República del Perú. 
                        Cualquier disputa será resuelta en los tribunales competentes de Lima, Perú.
                    </p>
                </section>

                <!-- Contacto -->
                <section>
                    <h2 class="text-2xl font-display font-bold text-[#0F0F0F] mb-4">Contacto</h2>
                    <p class="text-[#2C2C2C] leading-relaxed mb-4">
                        Para consultas sobre estos términos y condiciones, puede contactarnos:
                    </p>
                    <div class="bg-gradient-to-br from-[#F5EFE6] to-[#C9A24D]/10 p-6 rounded-xl border-2 border-[#C9A24D]/30">
                        <p class="font-display font-bold text-xl text-[#0F0F0F] mb-3">Hostal Real La Molina</p>
                        <div class="space-y-2 text-[#2C2C2C]">
                            <p class="flex items-center">
                                <svg class="w-5 h-5 text-[#C9A24D] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
-                                hostalreallamolina@hotmail.com
                            </p>
                            <p class="flex items-center">
                                <svg class="w-5 h-5 text-[#C9A24D] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                +51 948 070 603
                            </p>
                            <p class="flex items-center">
                                <svg class="w-5 h-5 text-[#C9A24D] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Av. La Molina 688, La Molina, Lima, Perú
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Mensaje Final -->
                <section class="text-center pt-8 border-t-2 border-[#C9A24D]/20">
                    <p class="text-2xl font-display font-bold text-[#C9A24D] italic">
                        ¡Gracias por visitarnos!
                    </p>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection
