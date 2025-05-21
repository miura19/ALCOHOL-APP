import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export const useQuestionsStore = defineStore('useQuestionsStore', () => {

    const questionNumber = ref(0)
    const totalScore = ref(0)
    const resultData = ref(null)

    const nextQuestion = async (id: number, score: number, genreId: number, questionsLength: number) => {
        console.log(id + "問目", "スコア", score);
        totalScore.value += score;
        console.log("合計スコア", totalScore.value);
        questionNumber.value++;
        if (id >= questionsLength) {
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
                resultData.value = response.data;
                return true;
            } catch (error) {
                console.error('結果取得失敗:', error);
                return false;
            }
        }
        return false;
    }

    return { nextQuestion, questionNumber, totalScore, resultData }
})