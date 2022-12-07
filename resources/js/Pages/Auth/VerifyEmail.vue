<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Email Verification" />

    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Antes de continuar, debes verificar tu correo electrónico haciendo click
            al link que te hemos enviado a la dirección que proporcionaste. Si no recibiste
            ningún correo, con gusto te enviaremos otro.
        </div>

        <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600">
            Un nuevo link de verificación ha sido enviado a la dirección que proporcionaste.
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Re-enviar link de verificación
                </JetButton>

                <div>
                    <Link
                        :href="route('profile.show')"
                        class="hover:text-gray-400 underline text-sm text-gray-600 ml-2"
                    >
                        Editar perfil</Link>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-400 ml-2"
                    >
                        Cerrar sesión
                    </Link>
                </div>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
