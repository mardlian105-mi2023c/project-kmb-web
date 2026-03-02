<script setup>
defineProps({
  items: Array,
});
</script>

<template>
  <div class="mt-7 overflow-x-auto">
    <table class="w-full text-sm min-w-[320px]">
      <thead class="bg-red-50">
        <tr>
          <th class="text-left p-3 font-semibold">Barang</th>
          <th class="text-center p-3 font-semibold">Qty</th>
        </tr>
      </thead>

      <tbody>
        <tr
          v-for="(item, i) in items"
          :key="i"
          class="border-b last:border-none"
        >
          <td class="p-3">{{ item.nama }}</td>
          <td class="p-3 text-center">{{ item.qty }} {{ item.satuan }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
