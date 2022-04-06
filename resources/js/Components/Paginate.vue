<script setup>
  import { Link } from '@inertiajs/inertia-vue3';
</script>
<template>
  <nav
    class="border-t border-gray-200 px-4 flex items-center justify-between sm:px-0"
  >
    <div class="-mt-px w-0 flex-1 flex">
      <Link
        v-if="data.prev_page_url"
        :href="data.prev_page_url"
        class="border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300"
      >
        <i class="bi bi-arrow-left-short"></i>
        Anterior
      </Link>
    </div>
    <div class="hidden md:-mt-px md:flex">
      <Link
        v-for="link in cleanLinks"
        :key="link.label"
        :href="link.url"
        :class="{ 'border-zinc-800 text-zinc-800': link.active }"
        class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 border-t-2 pt-4 px-4 inline-flex items-center text-sm font-medium"
      >
        {{ link.label }}
      </Link>
    </div>
    <div class="-mt-px w-0 flex-1 flex justify-end">
      <Link
        v-if="data.next_page_url"
        :href="data.next_page_url"
        class="border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300"
      >
        Próxima
        <i class="bi bi-arrow-right-short"></i>
      </Link>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Pagination",
  props: {
    data: Object,
  },
  computed: {
    cleanLinks() {
      const cleanLinks = [...this.data.links];
      cleanLinks.shift();
      cleanLinks.pop();
      return cleanLinks;
    },
  },
};
</script>