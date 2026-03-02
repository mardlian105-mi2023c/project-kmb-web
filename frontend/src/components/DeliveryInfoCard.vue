<script setup>
defineProps({
  delivery: Object,
});
</script>

<template>
  <div class="bg-white rounded-2xl p-6 shadow-sm">
    <h2 class="font-bold text-red-600 mb-5">Informasi Pengiriman</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">
      <div>
        <p class="text-gray-400 text-xs">No Delivery</p>
        <p class="font-semibold">{{ delivery.deliv_id.trim() }}</p>
      </div>

      <div>
        <p class="text-gray-400 text-xs">Order</p>
        <p class="font-semibold">{{ delivery.order_id.trim() }}</p>
      </div>

      <div>
        <p class="text-gray-400 text-xs">Tanggal Kirim</p>
        <p class="font-semibold">{{ delivery.ship_date.split(" ")[0] }}</p>
      </div>

      <div>
        <p class="text-gray-400 text-xs">Gudang</p>
        <p class="font-semibold">{{ delivery.mill_name }}</p>
      </div>

      <div class="sm:col-span-2">
        <p class="text-gray-400 text-xs">Customer</p>
        <p class="font-semibold">{{ delivery.NamaCustomer }}</p>
      </div>

      <div class="sm:col-span-2">
        <p class="text-gray-400 text-xs">Alamat</p>
        <p class="font-semibold">{{ delivery.Alamat }}</p>
      </div>
    </div>

    <slot />
  </div>
</template>
