<template>
  <div class="min-h-screen bg-gray-100">
    <div class="bg-red-600 px-4 py-3 flex items-center justify-between">
      <img src="@/assets/logo.svg" class="h-8 object-contain" />

      <div class="space-y-1">
        <div class="w-6 h-0.5 bg-white"></div>
        <div class="w-6 h-0.5 bg-white"></div>
        <div class="w-6 h-0.5 bg-white"></div>
      </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-6">
      <div class="text-center max-w-xl mx-auto">
        <h2 class="font-semibold">Customer yang terhormat,</h2>
        <p class="text-gray-600 text-sm mt-2">
          Terima kasih telah membuka dokumen Anda Dokumen resmi dari PT Kencana
          Maju Bersama dapat Anda lihat di bawah ini :
        </p>
      </div>

      <div class="flex justify-center gap-8 mt-6 text-xs">
        <p class="bg-red-100 text-red-600 m-3 px-3 py-1 rounded-full">
          Dokumen Resmi dari PT Kencana Maju Bersama
        </p>
      </div>

      <div class="w-full px-6 xl:px-12 2xl:px-20">
        <slot />
      </div>
    </div>
  </div>
</template>
