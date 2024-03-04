<script setup>
import Layout from '@layouts/Layout.vue'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
  accounts: Object,
  errors: Object
})

const form = reactive({
  account_id: null,
  name: null,
  stage: null,
})


function submit() {
  router.post('/deal/store', form)
}
</script>

<template>
  <Layout>
    <Head title="Deal" />
    <div class="flex-1 h-screen overflow-y-auto">

      <div class="w-full max-w-[50%] mx-auto my-4 bg-white p-8 rounded-md shadow-md">
          <form @submit.prevent="submit">
            <h1 class= "text-2xl font-bold mb-6 text-center">Create new deal</h1>

            <div class="mb-4">
              <label class="block text-gray-700 text-sm font-bold mb-2" for="account_id">Accounts</label>
                <select v-model="form.account_id"
                        id="account_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                >
                    <option value=""></option>
                    <option v-for="account in accounts" :value="account.id">
                      {{ account.name }}
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Deal name</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                type="text" id="name" v-model="form.name" placeholder="Deal name">
                <div v-if="errors.name" class="text-sm text-red-600 space-y-1">
                  {{ errors.name }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Deal stage</label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500"
                type="text" id="stage" v-model="form.stage" placeholder="Deal stage">
                <div v-if="errors.stage" class="text-sm text-red-600 space-y-1">
                  {{ errors.stage }}
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
