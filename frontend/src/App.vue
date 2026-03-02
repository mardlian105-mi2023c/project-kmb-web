<template>
  <div class="min-h-screen bg-gray-100">
    <router-view v-if="!isAdminRoute" />

    <div v-else class="flex">
      <!-- Sidebar -->
      <aside class="w-64 bg-slate-900 text-white min-h-screen p-5">
        <h1 class="text-2xl font-bold mb-8">KMB Steel System</h1>

        <nav class="space-y-3">
          <router-link
            to="/admin"
            class="block px-3 py-2 rounded hover:bg-slate-700"
            active-class="bg-slate-700"
          >
            📊 Dashboard
          </router-link>

          <router-link
            to="/admin/deliveries"
            class="block px-3 py-2 rounded hover:bg-slate-700"
            active-class="bg-slate-700"
          >
            📦 Data Delivery
          </router-link>
        </nav>
      </aside>

      <!-- Main Content -->
      <main class="flex-1 p-8">
        <div class="bg-white shadow rounded-xl p-6 min-h-[80vh]">
          <router-view />
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();

const isAdminRoute = computed(() => {
  return route.path.startsWith("/admin");
});
</script>
