<script setup>
import Layout from '@layouts/Layout.vue'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({errors: Object})


const form = reactive({
  name: null,
  website: null,
  phone: null,
})

function submit() {
  router.post('/account/store', form)
}
</script>

<template>
  <Layout>
    <Head title="Account" />
    <div class="flex-1 h-screen overflow-y-auto">

      <div class="w-full max-w-[50%] mx-auto my-4 bg-white p-8 rounded-md shadow-md">
          <form @submit.prevent="submit">
            <h1 class= "text-2xl font-bold mb-6 text-center">Create new account</h1>

            {{ console.log(errors) }}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Account name</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                type="text" id="name" v-model="account_id" placeholder="Account name">
                <div v-if="errors.name" class="text-sm text-red-600 space-y-1">
                  {{ errors.name }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Account website</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                type="text" id="website" v-model="form.website" placeholder="Account website">
                <div v-if="errors.website" class="text-sm text-red-600 space-y-1">
                  {{ errors.website }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Account phone</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                type="text" id="phone" v-model="form.phone" placeholder="Account phone">
                <div v-if="errors.phone" class="text-sm text-red-600 space-y-1">
                  {{ errors.phone }}
                </div>
            </div>

            <div class="w-full flex items-center">
                <button type="submit"
                    class="w-full px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white text-center uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2 transition ease-in-out duration-150 mr-4">
                    Create
                </button>
            </div>
          </form>
      </div>
    </div>
  </Layout>
</template>
