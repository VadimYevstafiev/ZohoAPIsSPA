<script setup>
import NavLink from "@components/NavLink.vue";
</script>

<template>
  <main>
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex ">
          <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

            <NavLink href="/account/create" :active="$page.url === '/account/create'">Account</NavLink>
          </div>
          <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <NavLink href="/deal/create" :active="$page.url === '/deal/create'">Deal</NavLink>
          </div>
        </div>
      </div>

    </header>
    <article>
      <slot />
    </article>
  </main>
</template>