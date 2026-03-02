<script setup>
import { ref } from "vue";

const emit = defineEmits(["submit"]);

const confirmStatus = ref("");
const selectedDate = ref("");
const note = ref("");
const success = ref(false);

const submit = () => {
  if (!confirmStatus.value) return;

  emit("submit", {
    status: confirmStatus.value,
    date: selectedDate.value,
    note: note.value,
  });

  success.value = true;
};
</script>

<template>
  <div class="bg-white rounded-xl shadow p-6 sticky top-6">
    <h3 class="font-semibold mb-4">Konfirmasi Pengiriman Barang</h3>

    <div v-if="success" class="text-green-600 font-semibold text-center py-6">
      Terima kasih, konfirmasi terkirim
    </div>

    <div v-else class="space-y-4">
      <label
        class="flex gap-3 items-center border rounded-xl p-3 cursor-pointer hover:bg-gray-50"
      >
        <input type="radio" value="ready" v-model="confirmStatus" />
        <span>Barang siap diterima</span>
      </label>

      <div v-if="confirmStatus === 'ready'">
        <p class="text-xs mb-1">Pilih tanggal</p>
        <input
          type="date"
          v-model="selectedDate"
          class="w-full border rounded-lg px-3 py-2"
        />
      </div>

      <label
        class="flex gap-3 items-center border rounded-xl p-3 cursor-pointer hover:bg-gray-50"
      >
        <input type="radio" value="not_ready" v-model="confirmStatus" />
        <span>Tidak siap diterima</span>
      </label>

      <div v-if="confirmStatus === 'not_ready'">
        <p class="text-xs mb-1">Pilih tanggal</p>
        <input
          type="date"
          v-model="selectedDate"
          class="w-full border rounded-lg px-3 py-2"
        />
      </div>

      <textarea
        v-model="note"
        rows="3"
        placeholder="Catatan"
        class="w-full border rounded-lg px-3 py-2"
      ></textarea>

      <button
        @click="submit"
        :disabled="!confirmStatus"
        class="w-full bg-green-500 disabled:bg-gray-300 text-white py-2 rounded-full font-semibold"
      >
        Submit
      </button>
    </div>
  </div>
</template>
