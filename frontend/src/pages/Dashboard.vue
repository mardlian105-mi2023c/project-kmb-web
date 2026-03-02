<template>
  <div class="min-h-screen bg-gray-100 p-8">
    <!-- HEADER -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-red-700 tracking-wide">
        Admin Dashboard
      </h1>
      <p class="text-gray-500 text-sm">
        Delivery Monitoring & Customer Confirmation
      </p>
    </div>

    <!-- FORM -->
    <div class="bg-white shadow-xl rounded-2xl p-6 mb-8">
      <form @submit.prevent="saveData" class="grid grid-cols-2 gap-4">
        <input
          v-model="form.deliv_id"
          placeholder="Delivery ID"
          class="input-style"
        />

        <input
          v-model="form.customer_name"
          placeholder="Customer Name"
          class="input-style"
        />

        <input
          v-model="form.customer_phone"
          placeholder="Phone"
          class="input-style"
        />

        <input type="date" v-model="form.ship_date" class="input-style" />

        <input
          v-model="form.address"
          placeholder="Address"
          class="input-style col-span-2"
        />

        <div class="col-span-2">
          <button
            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow-lg transition"
          >
            {{ form.id ? "Update Delivery" : "Save Delivery" }}
          </button>
        </div>
      </form>
    </div>

    <!-- TABLE -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-red-700 text-white">
          <tr>
            <th class="p-4 text-left">Delivery ID</th>
            <th class="p-4 text-left">Customer</th>
            <th class="p-4 text-center">Status</th>
            <th class="p-4 text-center">WA</th>
            <th class="p-4 text-center">Action</th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="d in deliveries"
            :key="d.id"
            class="border-b hover:bg-gray-50 transition"
          >
            <td class="p-4 font-semibold">
              {{ d.deliv_id }}
            </td>

            <td class="p-4">
              {{ d.customer_name }}
            </td>

            <td class="p-4 text-center">
              <span
                :class="statusBadge(d.status)"
                class="px-3 py-1 rounded-full text-xs font-semibold"
              >
                {{ d.status }}
              </span>
            </td>

            <td class="p-4 text-center">
              <span v-if="d.wa_sent" class="text-green-600 font-semibold">
                Sent
              </span>
              <span v-else class="text-gray-400"> Not Sent </span>
            </td>

            <td class="p-4 text-center space-x-2">
              <button
                @click="viewDetail(d)"
                class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded-lg"
              >
                Detail
              </button>

              <button
                @click="editData(d)"
                class="bg-yellow-400 px-3 py-1 rounded-lg"
              >
                Edit
              </button>

              <button
                @click="deleteData(d.id)"
                class="bg-red-500 text-white px-3 py-1 rounded-lg"
              >
                Delete
              </button>

              <button
                @click="sendWa(d.id)"
                class="bg-green-500 text-white px-3 py-1 rounded-lg"
              >
                WA
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- MODAL DETAIL -->
    <div
      v-if="selected"
      class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center"
    >
      <div class="bg-white rounded-2xl shadow-2xl w-[600px] p-8">
        <h2 class="text-xl font-bold text-red-700 mb-6">Delivery Detail</h2>

        <div class="space-y-2 text-sm">
          <p><b>Delivery ID:</b> {{ selected.deliv_id }}</p>
          <p><b>Customer:</b> {{ selected.customer_name }}</p>
          <p><b>Phone:</b> {{ selected.customer_phone }}</p>
          <p><b>Address:</b> {{ selected.address }}</p>
          <p><b>Ship Date:</b> {{ selected.ship_date }}</p>

          <hr class="my-4" />

          <p class="font-semibold text-red-600">Customer Confirmation</p>

          <p><b>Status:</b> {{ selected.status }}</p>
          <p>
            <b>Customer Add Ship Date:</b>
            {{ selected.customer_ship_date || "-" }}
          </p>

          <p>
            <b>Customer Note:</b>
            {{ selected.customer_note || "-" }}
          </p>

          <p>
            <b>Confirmed At:</b>
            {{ selected.confirmed_at || "-" }}
          </p>
        </div>

        <div class="text-right mt-6">
          <button
            @click="selected = null"
            class="bg-gray-600 text-white px-4 py-2 rounded-lg"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import api from "../services/api";

const deliveries = ref([]);
const form = ref({});
const selected = ref(null);

const fetchData = async () => {
  const res = await api.get("/deliveries");
  deliveries.value = res.data;
};

const saveData = async () => {
  if (form.value.id) {
    await api.put(`/deliveries/${form.value.id}`, form.value);
  } else {
    await api.post("/deliveries", form.value);
  }

  form.value = {};
  fetchData();
};

const editData = (data) => {
  form.value = { ...data };
};

const deleteData = async (id) => {
  await api.delete(`/deliveries/${id}`);
  fetchData();
};

const sendWa = async (id) => {
  const res = await api.get(`/admin/generate-wa-link/${id}`);
  window.open(res.data.wa_link, "_blank");
};

const viewDetail = (data) => {
  selected.value = data;
};

const statusBadge = (status) => {
  switch (status) {
    case "APPROVED":
      return "bg-green-100 text-green-700";
    case "REJECTED":
      return "bg-gray-200 text-gray-700";
    case "READY":
      return "bg-blue-100 text-blue-700";
    default:
      return "bg-yellow-100 text-yellow-700";
  }
};

onMounted(fetchData);
</script>
