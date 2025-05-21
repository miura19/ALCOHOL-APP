<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { RouterLink, useRouter, useRoute } from 'vue-router'
import { useAlcoholGenreMasterStore } from '@/stores/alcoholGenreMaster'
import { useAuthUserStore } from '@/stores/authUser'

const alcohol_genre_master_store = useAlcoholGenreMasterStore()
const auth_user_data_store = useAuthUserStore()

const router = useRouter();
const route = useRoute();
const genreId = Number(route.query.genre);
console.log('genreId:', genreId);

onMounted(() => {
	auth_user_data_store.fetchAuthUserData()
	auth_user_data_store.fetchAllUserData()
	alcohol_genre_master_store.fetchAlcoholGenreMasterDetail(genreId)
})

const questionNumber = ref(0)
const totalScore = ref(0)

const logout = async () => {
	await auth_user_data_store.logout()
	router.push({ name: 'login' })
}

const choiceClick = async (id: number, score: number) => {
	console.log("選択肢" , id, "スコア" , score);
	totalScore.value += score;
	console.log("合計スコア" , totalScore.value);
	questionNumber.value++;
	if (id >= alcohol_genre_master_store.questions.length) {
		// 最後の質問に到達した場合、結果画面に遷移
		try {
			const response = await axios.post('http://localhost/api/result', {
				genre_id: genreId,
				total_score: totalScore.value
			}, {
				withCredentials: true,
				withXSRFToken: true,
				headers: {
					Accept: 'application/json',
				}
			})
			console.log('結果:', response.data)
			router.push({ name: 'result'})
		} catch (error) {
			console.error('結果取得失敗:', error);
		}
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
				<div class="font-medium text-gray-900 text-xl">{{ auth_user_data_store.user?.name }}</div>
				<button type="submit" @click="logout"
					class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">ログアウト</button>
			</div>
		</div>
	</header>
	<main>
		<section class="dark:bg-gray-100 dark:text-gray-800">
			<div class="container p-4 mx-auto space-y-4 sm:p-6">
				<div class="space-y-4">
					<h3 class="text-2xl font-bold leading-none sm:text-5xl text-center">{{ alcohol_genre_master_store.questions[questionNumber]?.question_text }}</h3>
				</div>
				<div class="grid w-full grid-cols-1 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 p-8">
					<div class="space-y-4">
						<img alt="" class="object-cover h-56 mx-auto mb-4 bg-center rounded-sm dark:bg-gray-500"
							:src="alcohol_genre_master_store.genre?.image">
					</div>
				</div>
			</div>
		</section>
		<section class="text-gray-600 body-font">
			<div class="container px-5 py-4 mx-auto">
				<div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
					<div v-for="choice in alcohol_genre_master_store.questions[questionNumber]?.question_choices" :key="choice.id" class="p-2 sm:w-1/2 w-full">
						<div class="bg-gray-100 rounded flex p-4 h-full items-center" @click="choiceClick(alcohol_genre_master_store.questions[questionNumber].id, choice.score)">
							<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
								stroke-width="3" class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
								<path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
								<path d="M22 4L12 14.01l-3-3"></path>
							</svg>
							<span class="title-font font-medium">{{ choice.choice_text }}</span>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</template>
