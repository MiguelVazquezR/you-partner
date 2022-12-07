<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";

const regions = [
  "Ciudad de México",
  "Aguascalientes",
  "Baja California",
  "Baja California Sur",
  "Campeche",
  "Coahuila de Zaragoza",
  "Colima",
  "Chiapas",
  "Chihuahua",
  "Durango",
  "Guanajuato",
  "Guerrero",
  "Hidalgo",
  "Jalisco",
  "México",
  "Michoacán de Ocampo",
  "Morelos",
  "Nayarit",
  "Nuevo León",
  "Oaxaca",
  "Puebla",
  "Querétaro",
  "Quintana Roo",
  "San Luis Potosí",
  "Sinaloa",
  "Sonora",
  "Tabasco",
  "Tamaulipas",
  "Tlaxcala",
  "Veracruz de Ignacio de la Llave",
  "Yucatán",
  "Zacatecas",
];

const grades = [
  "Aeroespacial",
  "Administración y negocios",
  "Ambiental",
  "Artes y humanidades",
  "Automotríz",
  "Electromecánica",
  "Sistemas",
  "Industrial",
  "Agroindustrial",
  "Aeronáutica",
  "Alimentos",
  "Arquitectura",
  "Biomédica",
  "Biónica",
  "Bioquímica",
  "Civil",
  "Ciencias sociales",
  "Ciencias de la salud",
  "Ciencias naturales, matemáticas y/o estadística",
  "Computación",
  "Comercial",
  "Derecho",
  "Eléctrica y/o Electrónica",
  "Educación",
  "Física",
  "Farmacéutica",
  "Geofísica",
  "Geológica",
  "Informática",
  "Materiales",
  "Manufactura",
  "Mecatrónica",
  "Mecánica",
  "Negocios",
  "Programador web",
  "Programador apps móviles",
  "Química",
  "Robótica",
  "Recursos Humanos",
  "Transporte",
  "Telecomunicaciones",
  "Textil",
  "Tecnologías de la información y la comunicación",
  "Software",
  "Servicios",
  "Otro",
];

const form = useForm({
  name: "",
  birthdate: "",
  email: "",
  state: "",
  academic_grade: "",
  school_name: "",
  password: "",
  password_confirmation: "",
  terms: false,
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <Head title="Register" />

  <JetAuthenticationCard>
    <template #logo> </template>

    <JetValidationErrors class="mb-2" />

    <form @submit.prevent="submit">
      <div>
        <JetLabel for="name" value="Nombre" is_required />
        <JetInput
          id="name"
          v-model="form.name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="name"
        />
      </div>

      <div class="mt-1">
        <JetLabel for="birthdate" value="Fecha de Nacimiento" is_required />
        <JetInput
          id="birthdate"
          v-model="form.birthdate"
          type="date"
          class="mt-1 block w-full"
          required
          autofocus
        />
      </div>

      <div class="mt-1">
        <JetLabel for="email" value="Email" is_required />
        <JetInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
        />
      </div>

      <div class="mt-1">
        <JetLabel for="state" value="Estado" is_required />
        <select
          name="state"
          v-model="form.state"
          class="
            h-[2.5rem]
            mt-1
            block
            w-full
            border-gray-300
            focus:border-indigo-300
            focus:ring
            focus:ring-indigo-200
            focus:ring-opacity-50
            rounded-md
            shadow-sm
            placeholder:text-gray-400 placeholder:text-sm
            input
          "
          required
        >
          <option value="" disabled>-- Selecciona --</option>
          <option v-for="(region, index) in regions" :key="index">
            {{ region }}
          </option>
        </select>
      </div>

      <div class="mt-1">
        <JetLabel for="academic_grade" value="Área de Especialidad" is_required />
        <select
          name="academic_grade"
          v-model="form.academic_grade"
          class="
            h-[2.5rem]
            mt-1
            block
            w-full
            border-gray-300
            focus:border-indigo-300
            focus:ring
            focus:ring-indigo-200
            focus:ring-opacity-50
            rounded-md
            shadow-sm
            placeholder:text-gray-400 placeholder:text-sm
            input
          "
          required
        >
          <option value="" disabled>-- Selecciona --</option>
          <option v-for="(grade, index) in grades" :key="index">
            {{ grade }}
          </option>
        </select>
      </div>

      <div class="mt-1">
        <JetLabel for="school_name" value="Nombre de Escuela" />
        <input
          name="school_name"
          type="text"
          v-model="form.school_name"
          class="
            h-[2.5rem]
            mt-1
            block
            w-full
            border-gray-300
            focus:border-indigo-300
            focus:ring
            focus:ring-indigo-200
            focus:ring-opacity-50
            rounded-md
            shadow-sm
            placeholder:text-gray-400 placeholder:text-sm
            input
          "
          placeholder="¿En qué escuela estás o de cual egresaste?"
        />
      </div>

      <div class="mt-1">
        <JetLabel for="password" value="Password" is_required />
        <JetInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />
      </div>

      <div class="mt-1">
        <JetLabel for="password_confirmation" value="Confirmar Password" is_required />
        <JetInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />
      </div>

      <div
        v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
        class="mt-4"
      >
        <JetLabel for="terms">
          <div class="flex items-center">
            <JetCheckbox id="terms" v-model:checked="form.terms" name="terms" />

            <div class="ml-1">
              Estoy de acuerdo con los
              <a
                target="_blank"
                :href="route('terms-of-service')"
                class="underline text-sm text-gray-600 hover:text-gray-300"
                >Terminos de servicio</a
              >
              y
              <a
                target="_blank"
                :href="route('privacy-policy')"
                class="underline text-sm text-gray-600 hover:text-gray-300"
                >Politicas de privacidad</a
              >
            </div>
          </div>
        </JetLabel>
      </div>

      <div class="flex items-center justify-end mt-2">
        <Link
          :href="route('login')"
          class="underline text-sm text-gray-600 hover:text-gray-300"
        >
          ¿Ya tienes una cuenta?
        </Link>

        <JetButton
          class="ml-2"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Registrar
        </JetButton>
      </div>
    </form>
  </JetAuthenticationCard>
</template>
