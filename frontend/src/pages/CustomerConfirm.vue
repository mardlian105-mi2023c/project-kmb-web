<template>
  <div class="min-h-screen bg-gray-200">
    <!-- HEADER MERAH -->
    <div class="bg-red-600 text-white p-4">
      <h1 class="font-bold text-lg tracking-wide">KENCANA</h1>
      <p class="text-xs opacity-80">PT Kencana Maju Bersama</p>
    </div>

    <!-- CARD -->
    <div class="max-w-md mx-auto bg-gray-100 p-6">
      <!-- INTRO -->
      <div class="text-center mb-6">
        <h2 class="font-semibold text-gray-800">Customer yang terhormat,</h2>
        <p class="text-sm text-gray-600 mt-2">
          Thank you for opening your document. The official document from PT
          Kencana Maju Bersama can be viewed below.
        </p>
      </div>

      <!-- DELIVERY INFO -->
      <div v-if="delivery">
        <h3 class="font-bold text-gray-800 mb-2">Delivery Order</h3>

        <div class="text-sm space-y-1 mb-4">
          <p><b>No</b> : {{ delivery.deliv_id }}</p>
          <p><b>Date</b> : {{ delivery.ship_date }}</p>
          <p><b>Customer</b> : {{ delivery.customer_name }}</p>

          <p class="flex items-center gap-2">
            <b>Status</b> :
            <span
              class="px-3 py-1 rounded-full text-xs text-white"
              :class="statusBadge"
            >
              {{ delivery.status }}
            </span>
          </p>
        </div>

        <!-- TABLE -->
        <div class="border-t-2 border-red-500 pt-2">
          <div
            class="grid grid-cols-3 font-semibold text-sm border-b border-red-500 pb-1"
          >
            <div>Barang</div>
            <div class="text-center">Qty</div>
            <div class="text-center">UOM</div>
          </div>

          <div
            v-for="item in delivery.items"
            :key="item.id"
            class="grid grid-cols-3 text-sm py-2 border-b"
          >
            <div>{{ item.product_name }}</div>
            <div class="text-center">{{ item.qty }}</div>
            <div class="text-center">{{ item.uom }}</div>
          </div>
        </div>

        <!-- ADD DATE -->
        <div class="mt-6">
          <label class="block text-sm font-semibold mb-2">
            Tambah Tanggal Pengiriman
          </label>
          <input
            type="date"
            v-model="form.customer_ship_date"
            class="input-style"
          />
        </div>

        <!-- NOTE -->
        <div class="mt-6">
          <label class="block text-sm font-semibold mb-2">
            Berikan Masukkan
          </label>
          <textarea
            v-model="form.customer_note"
            rows="4"
            class="input-style"
            placeholder="Tulis masukkan anda..."
          ></textarea>
        </div>

        <!-- BUTTONS -->
        <div class="flex gap-4 mt-8">
          <button
            @click="submit('APPROVED')"
            class="flex-1 bg-green-500 hover:bg-green-600 text-white py-3 rounded-full font-semibold transition"
          >
            Setujui
          </button>

          <button
            @click="submit('REJECTED')"
            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-full font-semibold transition"
          >
            Tolak
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { useRoute } from "vue-router";
import api from "../services/api";

const route = useRoute();
const delivery = ref(null);

const form = ref({
  customer_ship_date: null,
  customer_note: null,
});

const fetchData = async () => {
  const res = await api.get(`/delivery/${route.params.token}`);
  delivery.value = res.data;
};

const submit = async (status) => {
  await api.post(`/delivery/confirm/${route.params.token}`, {
    status,
    customer_ship_date: form.value.customer_ship_date,
    customer_note: form.value.customer_note,
  });

  alert("Konfirmasi berhasil dikirim");
  fetchData();
};

const statusBadge = computed(() => {
  if (!delivery.value) return "bg-yellow-500";

  switch (delivery.value.status) {
    case "APPROVED":
      return "bg-green-500";
    case "REJECTED":
      return "bg-gray-600";
    default:
      return "bg-yellow-500";
  }
});

onMounted(fetchData);
</script>
