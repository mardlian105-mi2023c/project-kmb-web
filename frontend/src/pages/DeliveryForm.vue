<template>
  <div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
      <h2 class="text-xl font-bold mb-4">
        {{ isEdit ? "Edit" : "Tambah" }} Delivery
      </h2>

      <form @submit.prevent="save" class="space-y-4">
        <input
          v-model="form.deliv_id"
          placeholder="Delivery ID"
          class="w-full border p-2 rounded"
        />

        <input
          v-model="form.customer_name"
          placeholder="Customer Name"
          class="w-full border p-2 rounded"
        />

        <input
          v-model="form.customer_phone"
          placeholder="Phone"
          class="w-full border p-2 rounded"
        />

        <input
          type="date"
          v-model="form.ship_date"
          class="w-full border p-2 rounded"
        />

        <button class="w-full bg-blue-600 text-white py-2 rounded">
          Simpan
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../services/api";

const route = useRoute();
const router = useRouter();

const form = ref({
  deliv_id: "",
  customer_name: "",
  customer_phone: "",
  ship_date: "",
});

const isEdit = computed(() => route.params.id);

onMounted(async () => {
  if (isEdit.value) {
    const res = await api.get(`/deliveries/${route.params.id}`);
    form.value = res.data;
  }
});

const save = async () => {
  if (isEdit.value) {
    await api.put(`/deliveries/${route.params.id}`, form.value);
  } else {
    await api.post("/deliveries", form.value);
  }
  router.push("/");
};
</script>
