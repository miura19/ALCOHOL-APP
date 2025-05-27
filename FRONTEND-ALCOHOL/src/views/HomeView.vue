<script setup lang="ts">
import { onMounted } from 'vue'
import { RouterLink, useRouter } from 'vue-router'
import { useAlcoholGenreMasterStore } from '@/stores/alcoholGenreMaster'
import Header from '@/components/Header.vue'

const alcohol_genre_master_store = useAlcoholGenreMasterStore()

onMounted(() => {
	alcohol_genre_master_store.fetchAlcoholGenreMaster()
})

</script>

<template>
	<Header />
	<main>
		<section class="py-6 dark:bg-gray-100 dark:text-gray-800">
			<div class="container p-4 mx-auto space-y-16 sm:p-10">
				<div class="space-y-4">
					<h3 class="text-2xl font-bold leading-none sm:text-5xl text-center">どんな酒を求めてる？</h3>
				</div>
				<div class="grid w-full grid-cols-1 gap-x-6 gap-y-12 sm:grid-cols-2 lg:grid-cols-4">
					<div class="space-y-4" v-for="genre in alcohol_genre_master_store.genres" :key="genre.id">
						<RouterLink :to="{ path: '/questions', query: { genre: genre.id } }">
							<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
								:src="genre.image">
							<div class="flex flex-col items-center">
								<h4 class="text-xl font-semibold">{{ genre.name }}</h4>
							</div>
						</RouterLink>
					</div>
				</div>
			</div>
		</section>
	</main>
</template>
