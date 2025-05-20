<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { RouterLink, useRouter } from 'vue-router'
import { useAlcoholGenreMasterStore } from '@/stores/alcoholGenreMaster'
import { useAuthUserStore } from '@/stores/authUser'

const alcohol_genre_master_store = useAlcoholGenreMasterStore()
const auth_user_data_store = useAuthUserStore()

onMounted(() => {
	alcohol_genre_master_store.fetchAlcoholGenreMaster()
	auth_user_data_store.fetchAuthUserData()
	auth_user_data_store.fetchAllUserData()
})

const router = useRouter();

const logout = async () => {
	try {
		await axios.post('http://localhost/api/logout', null, {
			withCredentials: true,
			withXSRFToken: true,
			headers: {
				Accept: 'application/json',
			}
		})
		router.push({ name: 'login' })
	} catch (error) {
		console.error('ログアウト失敗:', error)
	}
}
</script>

<template>
	<header class="text-gray-600 body-font">
		<div class="container mx-auto flex items-center justify-between p-5 flex-col md:flex-row">
			<div class="flex title-font font-medium items-center text-gray-900">
				<RouterLink to="/home">
					<div class="ml-3 text-xl">ALCOLE-RECOMMENDATION</div>
				</RouterLink>
			</div>
			<div class="flex items-center space-x-6">
				<div v-if="auth_user_data_store.user">
					<div class="font-medium text-gray-900 text-xl">{{ auth_user_data_store.user.name }}</div>
				</div>
				<button type="submit" @click="logout"
					class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">ログアウト</button>
			</div>
		</div>
	</header>
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
