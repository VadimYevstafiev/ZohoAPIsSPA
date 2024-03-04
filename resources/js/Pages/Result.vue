<script setup>
import Layout from '@layouts/Layout.vue'
import { Head } from '@inertiajs/vue3'
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

defineProps({output: Object})


function submit() {
  router.red
}
</script>

<template>
  <Layout>
    <Head title="Result" />
    <div class="flex-1 h-screen overflow-y-auto">
        <div class="w-full max-w-[50%] mx-auto my-4 bg-white p-8 rounded-md shadow-md">
            <h1 class= "text-2xl font-bold mb-6 text-center">Result</h1>

            <div class="block text-gray-700 text-sm font-bold mb-2">
                <span v-if="output.account">Account</span>
                <span v-else>Deal</span>
                 created 
                <span v-if="output.ok" class="text-green-500">successfully</span>
                <span v-else class="text-red-500">unsuccessfully</span>
            </div>

            <div v-if="output.code" class="block text-gray-700 text-sm font-bold mb-2">
                Operation code: {{ output.code }}
            </div>

            <div v-if="output.ok" class="block text-gray-700 text-sm font-bold mb-2">
                <span v-if="output.account">Account</span>
                <span v-else>Deal</span>
                's ID:  {{ output.id}}
            </div>
        </div>
    </div>
  </Layout>
</template>

