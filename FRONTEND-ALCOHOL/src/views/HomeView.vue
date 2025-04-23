<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'
import { RouterLink, useRouter } from 'vue-router'

const router = useRouter();

type User = {
	id: number
	name: string
	email: string
	created_at: string
}

type Genre = {
	id: number
	name: string
	image: string
	created_at: string
	updated_at: string
}

const genres = ref<Genre[]>([])
const user = ref<User | null>(null)

//認証済みならユーザーデータを取得
const fetchAuthUserData = async () => {
	try {
		const res = await axios.get('http://localhost/api/user', {
			withCredentials: true,
			withXSRFToken: true,
			headers: {
				Accept: 'application/json',
			}
		})
		console.log('ユーザーデータ:', res.data)
		user.value = res.data;
	} catch (error) {
		console.error('ユーザーデータ取得失敗:', error)
	}
}
fetchAuthUserData()

const fetchAllUserData = async () => {
	try {
		const res = await axios.get('http://localhost/api/users', {
			withCredentials: true,
			withXSRFToken: true,
			headers: {
				Accept: 'application/json',
			}
		})
		console.log('登録済みユーザーデータ一覧:', res.data)
	} catch (error) {
		console.error('登録済みユーザーデータ一覧取得失敗:', error)
	}
}
fetchAllUserData()

const fetchAlcoholGenreMaster = async () => {
	try {
		const res = await axios.get('http://localhost/api/genre', {
			withCredentials: true,
			withXSRFToken: true,
			headers: {
				Accept: 'application/json',
			}
		})
		console.log('アルコールジャンル:', res.data)
		genres.value = res.data;
	} catch (error) {
		console.error('アルコールジャンル取得失敗:', error)
	}
}
fetchAlcoholGenreMaster()

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
				<div class="font-medium text-gray-900 text-xl">{{ user?.name }}</div>
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
					<div class="space-y-4" v-for="genre in genres" :key="genre.id">
						<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
							:src="genre.image">
						<div class="flex flex-col items-center">
							<h4 class="text-xl font-semibold">{{ genre.name }}</h4>
						</div>
					</div>
					<!-- <div class="space-y-4">
						<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
							src="https://source.unsplash.com/240x320/?portrait?1">
						<div class="flex flex-col items-center">
							<h4 class="text-xl font-semibold">Leroy Jenkins</h4>
						</div>
					</div>
					<div class="space-y-4">
						<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
							src="https://source.unsplash.com/240x320/?portrait?2">
						<div class="flex flex-col items-center">
							<h4 class="text-xl font-semibold">Leroy Jenkins</h4>
						</div>
					</div>
					<div class="space-y-4">
						<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
							src="https://source.unsplash.com/240x320/?portrait?3">
						<div class="flex flex-col items-center">
							<h4 class="text-xl font-semibold">Leroy Jenkins</h4>
						</div>
					</div>
					<div class="space-y-4">
						<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
							src="https://source.unsplash.com/240x320/?portrait?4">
						<div class="flex flex-col items-center">
							<h4 class="text-xl font-semibold">Leroy Jenkins</h4>
						</div>
					</div>
					<div class="space-y-4">
						<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
							src="https://source.unsplash.com/240x320/?portrait?5">
						<div class="flex flex-col items-center">
							<h4 class="text-xl font-semibold">Leroy Jenkins</h4>
						</div>
					</div>
					<div class="space-y-4">
						<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
							src="https://source.unsplash.com/240x320/?portrait?6">
						<div class="flex flex-col items-center">
							<h4 class="text-xl font-semibold">Leroy Jenkins</h4>
						</div>
					</div>
					<div class="space-y-4">
						<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
							src="https://source.unsplash.com/240x320/?portrait?7">
						<div class="flex flex-col items-center">
							<h4 class="text-xl font-semibold">Leroy Jenkins</h4>
						</div>
					</div> -->
				</div>
			</div>
		</section>
	</main>
</template>
